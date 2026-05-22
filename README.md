# sbf – WordPress Dev Stack

WordPress + MySQL 8 + phpMyAdmin, managed via Docker Compose.

## Prerequisites

- Docker Desktop (WSL 2 backend enabled)

## First-time setup

```bash
cp .env.example .env
# Edit .env and set strong passwords before continuing
```

## Start the stack

```bash
docker compose up -d
```

Wait ~30 seconds for MySQL to finish initializing, then open:

| Service    | URL                       |
|------------|---------------------------|
| WordPress  | http://localhost:8080     |
| phpMyAdmin | http://localhost:8081     |

On a fresh start, WordPress will redirect to the install wizard at `/wp-admin/install.php`.

## Common commands

```bash
# Stop without deleting data
docker compose down

# Destroy everything including volumes (irreversible)
docker compose down -v

# Follow logs for all services
docker compose logs -f

# Follow logs for a single service
docker compose logs -f wordpress
docker compose logs -f db

# Open a MySQL shell
docker compose exec db mysql -u root -p
```

## Credentials

All credentials live in `.env` (not committed). See `.env.example` for required variables.

phpMyAdmin login: use `root` + `MYSQL_ROOT_PASSWORD` from your `.env`.

## Static export for GitHub Pages

The site can be exported to a static HTML snapshot via the **Simply Static** plugin (already installed and configured for `https://ferlerrorr.github.io/sbf/`).

```bash
./scripts/build-static.sh
```

Output lands in `./dist/` (~180 MB, ~37 HTML pages). The script handles the in-container localhost trick (port 8080 isn't reachable from inside the WP container, so it temporarily flips `siteurl` to `http://localhost` for the crawl, then restores it).

To deploy: push `./dist/` to a `gh-pages` branch, or wire up a GitHub Actions workflow. Forms (Quote/Contact) won't work without a third-party form service (Formspree, Netlify Forms, etc.).

If you change the destination URL (e.g. custom domain), update Simply Static's `destination_host`:

```bash
docker compose exec --user www-data wordpress wp eval \
  'update_option("simply-static", array_merge((array) get_option("simply-static"), ["destination_host" => "silsbeefleet.com"]));'
```
