# Concept Skeleton

Minimal starter application for [Concept Core](https://github.com/php-concept/concept-core) — a PHP framework built from proven libraries (League Container, League Route, Laminas PSR-7, Twig, Monolog, Illuminate DB) wired through service providers instead of magic.

This repository ships a working HTTP + Twig landing page, a component-oriented `src/App/` layout, and optional providers you can enable as the project grows.

## Requirements

- PHP **8.4+**
- Composer 2.x
- Extensions: `dom`, `pdo`, `pdo_mysql`, `mysqli`, `zip` (see `Dockerfile` for reference)

## Quick start

```bash
git clone https://github.com/php-concept/concept-skeleton.git app-name
cd app-name

cp .env.example .env
# Edit .env — set APP_ENV, database credentials, etc.

# Point your web server document root to public/
# Or use Docker (see below)
```

Open the app in a browser. The home route (`/`) renders the Concept Core landing page.

## Docker

```bash
cp docker-compose.yml.example docker-compose.yml
# Edit docker-compose.yml (setup container_name and volumes)
docker-compose up
```

Run `composer install` in the container:
```bash
docker exec -it container_name bash
composer install
```

Apache vhost config lives in `docker/apache/vhost.conf` (`DocumentRoot` → `public/`).

## Project layout

```
project/
├── public/              # Document root (index.php, assets, vendor libs)
├── bootstrap/           # app.php, paths.php, providers/
├── bin/                 # console.php
├── config/              # PHP config + config/{dev,production}/
├── routes/              # Route definitions
├── resources/views/     # Twig templates (@frontend/…)
├── database/            # Migrations and seeders
├── storage/             # Logs, cache (gitignored)
├── src/                 # Application code
└── tests/
```

Paths are configurable in `bootstrap/paths.php`. PSR-4 autoloading is defined in `composer.json`:

```json
"Concept\\": "src/"
```

### Application code (`src/`)

This skeleton uses a **component-ready** layout with shared code under `src/App/`:

```
src/App/
├── Controllers/
├── Extensions/Twig/
├── Models/
└── …
```

Alternative structures (layered MVC, modular components) are described in the [Concept Core directory guide](https://php-concept.github.io/concept-docs/en/directory-structure.html).

## Service providers

HTTP providers are registered in `bootstrap/providers/app.php`. Console commands use a separate stack in `bootstrap/providers/console.php`.

All twelve core providers are enabled by default in this skeleton:

| Provider | Role |
|----------|------|
| `ConfigServiceProvider` | Config dirs, `.env`, env overrides |
| `ErrorHandlerServiceProvider` | Whoops / production error pages |
| `EventServiceProvider` | Event dispatcher |
| `HttpServiceProvider` | PSR-7, router, middleware |
| `SessionServiceProvider` | Session handling |
| `LogServiceProvider` | Monolog |
| `ViewServiceProvider` | Twig |
| `MaskerServiceProvider` | Sensitive field redaction in logs |
| `ValidationServiceProvider` | Request validation |
| `DatabaseServiceProvider` | Illuminate DB / Eloquent |
| `CastingServiceProvider` | Valinor DTO mapping |
| `ComponentsServiceProvider` | Pluggable modules |

Comment out providers you do not need yet to keep boot lean.

## Routes & views

- Routes: `routes/web.php` (loaded via `config/routes.php`)
- Views: `resources/views/frontend/` — namespace `@frontend/` in `config/view.php`
- Layout: `resources/views/frontend/layouts/base.twig`

Example route:

```php
$router->get('/', [IndexController::class, 'index'])->setName('home');
```

Twig helpers (`path()`, `route()`, `base_url()`) come from `AppExtension`.

## Frontend assets

After `composer install`, Bootstrap and Bootstrap Icons are copied to `public/vendor/` via the `publish-assets` script.

Static frontend assets:

| Path | Purpose |
|------|---------|
| `public/assets/css/frontend.css` | Landing page styles |
| `public/assets/js/frontend.js` | Navbar, provider toggles, Highlight.js init |

The landing page uses **Highlight.js** (`github-dark` theme) for code samples. This is separate from Composer dependencies and lives under `public/libs/highlight/`.

## CLI

```bash
php bin/console route:list
php bin/console view:clear
php bin/console db:migrate      # when DatabaseServiceProvider is enabled
```

Available commands depend on which providers are registered in `bootstrap/providers/console.php`.

## Configuration

| File | Description |
|------|-------------|
| `.env` | Environment variables (not committed) |
| `config/app.php` | App name, timezone, locale, debug |
| `config/db.php` | Database connection |
| `config/view.php` | Twig paths, extensions, cache |
| `config/log.php` | Log level and retention |
| `config/dev/` / `config/production/` | Env-specific overrides |

## Static analysis

```bash
composer phpstan
```

Configuration: `phpstan.neon` (level 10).

## Documentation

- [Concept Core docs](https://php-concept.github.io/concept-docs/)
- [Directory structure](https://php-concept.github.io/concept-docs/en/directory-structure.html)
- [Core repository](https://github.com/php-concept/concept-core)

## License

Follow the license terms of [php-concept/core](https://github.com/php-concept/concept-core) and bundled dependencies.
