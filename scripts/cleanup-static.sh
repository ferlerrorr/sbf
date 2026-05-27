#!/usr/bin/env bash
set -euo pipefail

DIST_DIR="$(cd "$(dirname "$0")/.." && pwd)/dist"

echo "=== Cleaning WordPress artifacts from static HTML files ==="

find "$DIST_DIR" -name "index.html" -print0 | while IFS= read -r -d '' file; do
    # Remove RSS feed link tags
    sed -i '/<link rel="alternate".*application\/rss+xml/d' "$file"
    # Remove oEmbed link tags (JSON and XML)
    sed -i '/<link rel="alternate".*oembed/d' "$file"
    # Remove wp-json API discovery link, page JSON link, and EditURI/xmlrpc (all on one line)
    sed -i '/<link rel="https:\/\/api.w.org\//d' "$file"
    sed -i '/<link rel="EditURI"/d' "$file"
    # Remove WordPress generator meta tag
    sed -i '/<meta name="generator" content="WordPress/d' "$file"
    # Remove shortlink
    sed -i '/<link rel="shortlink"/d' "$file"
    # Handle the combined line with api.w.org + JSON alternate + EditURI
    sed -i '/api\.w\.org.*wp-json.*xmlrpc/d' "$file"

    echo "  Cleaned: $file"
done

echo "=== Done. Cleaned $(find "$DIST_DIR" -name "index.html" | wc -l) files ==="
