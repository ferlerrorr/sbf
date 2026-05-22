#!/usr/bin/env bash
# Build a static snapshot of the WordPress site for deployment to GitHub Pages.
#
# Output: ./dist/  (overwrites)
# Requires: docker compose stack running (docker compose up -d).
#
# What it does:
#   1. Temporarily flips WP siteurl/home to http://localhost so Simply Static
#      can crawl from inside the container (port 8080 is host-only).
#   2. Re-runs Simply Static synchronously via scripts/static-export.php.
#   3. Restores siteurl/home to http://localhost:8080.
#   4. Moves the export output to ./dist/ and drops a .nojekyll marker.

set -euo pipefail

REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$REPO_ROOT"

WP_EXPORT_DIR_CONTAINER="/var/www/html/wp-content/uploads/ss-export"
WP_EXPORT_DIR_HOST="./wordpress/wp-content/uploads/ss-export"
TMP_SCRIPT_CONTAINER="//tmp/static-export.php"

if ! docker compose ps --status running --services | grep -q '^wordpress$'; then
  echo "ERROR: wordpress container is not running. Start the stack first:" >&2
  echo "  docker compose up -d" >&2
  exit 1
fi

restore_urls() {
  echo ">> Restoring WP siteurl/home to http://localhost:8080"
  docker compose exec -T --user www-data wordpress wp option update siteurl 'http://localhost:8080' >/dev/null
  docker compose exec -T --user www-data wordpress wp option update home    'http://localhost:8080' >/dev/null
  docker compose exec -T --user www-data wordpress wp eval \
    'update_option("simply-static", array_merge((array) get_option("simply-static", array()), array("origin_url" => "http://localhost:8080")));' >/dev/null
}
trap restore_urls EXIT

echo ">> Flipping WP siteurl/home to http://localhost for in-container crawl"
docker compose exec -T --user www-data wordpress wp option update siteurl 'http://localhost' >/dev/null
docker compose exec -T --user www-data wordpress wp option update home    'http://localhost' >/dev/null
docker compose exec -T --user www-data wordpress wp eval \
  'update_option("simply-static", array_merge((array) get_option("simply-static", array()), array("origin_url" => "http://localhost")));' >/dev/null

echo ">> Clearing previous export dir and URL queue"
docker compose exec -T wordpress bash -c "rm -rf ${WP_EXPORT_DIR_CONTAINER}/* ${WP_EXPORT_DIR_CONTAINER}/.[!.]* 2>/dev/null || true"
docker compose exec -T --user www-data wordpress wp db query "TRUNCATE wp_simply_static_pages;" >/dev/null

echo ">> Copying driver script into container"
docker compose cp ./scripts/static-export.php wordpress:/tmp/static-export.php
docker compose exec -T wordpress chown www-data:www-data /tmp/static-export.php

echo ">> Running Simply Static (synchronous)"
docker compose exec -T --user www-data wordpress wp eval-file "$TMP_SCRIPT_CONTAINER"

echo ">> Moving export to ./dist/"
rm -rf ./dist
docker compose exec -T wordpress bash -c "rm -rf /var/www/html/dist && mv ${WP_EXPORT_DIR_CONTAINER} /var/www/html/dist && chown -R 1000:1000 /var/www/html/dist"
mv ./wordpress/dist ./dist
touch ./dist/.nojekyll

PAGE_COUNT=$(find ./dist -name 'index.html' | wc -l)
SIZE=$(du -sh ./dist | cut -f1)
echo
echo ">> Done. ./dist/ contains ${PAGE_COUNT} HTML pages (${SIZE})."
echo ">> Deploy by pushing ./dist to the gh-pages branch, or use a GH Actions workflow."
