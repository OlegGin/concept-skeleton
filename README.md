# Concept Skeleton

Minimal starter application for [Concept Core](https://github.com/php-concept/concept-core) — a PHP framework built from proven libraries (League Container, League Route, Laminas PSR-7, Twig, Monolog, Whoops, Illuminate DB) wired through service providers instead of magic.

This repository ships a working HTTP + Twig landing page, a component-oriented `src/App/` layout, and optional providers you can enable as the project grows.

## Requirements

- PHP **8.4+**
- Composer 2.x
- Extensions: `dom`, `pdo`, `pdo_mysql`, `mysqli`, `zip` (see `Dockerfile` for reference)

## Quick start

```bash
git clone https://github.com/php-concept/concept-skeleton.git app-name
cd app-name

composer install

cp .env.example .env
# Edit .env — set APP_ENV, database credentials, etc.

# Point your web server document root to public/
# Or use Docker (see below)
```

Open the app in a browser. The home route (`/`) renders the Concept Skeleton landing page.

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
└── …
```

Alternative structures (layered MVC, modular components) are described in the [Concept Core directory guide](https://php-concept.github.io/concept-docs/en/directory-structure.html).

## Service providers

HTTP providers are registered in `bootstrap/providers/app.php`. Console commands use a separate stack in `bootstrap/providers/console.php`.

Fifteen HTTP providers are enabled by default in this skeleton (`bootstrap/providers/app.php`):

| Provider | Role |
|----------|------|
| `ConfigServiceProvider` | Config dirs, `.env`, env overrides |
| `LocaleServiceProvider` | Locale resolution for validation messages |
| `TelemetryServiceProvider` | Bootstrap and request telemetry hooks |
| `ErrorHandlerServiceProvider` | Whoops / production error pages |
| `HttpServiceProvider` | PSR-7, router, middleware |
| `SessionServiceProvider` | Session handling |
| `DataMaskerServiceProvider` | Sensitive field redaction in logs |
| `LogServiceProvider` | Monolog |
| `ViewRegistryServiceProvider` | View paths, extensions, contexts |
| `TwigServiceProvider` | Twig engine |
| `ValidationServiceProvider` | Request validation |
| `DatabaseServiceProvider` | Illuminate DB / Eloquent |
| `CastingServiceProvider` | Valinor DTO mapping |
| `DebugLoggerServiceProvider` | In-memory debug log (dev tools) |
| `ComponentsServiceProvider` | Pluggable modules |

`ConsoleServiceProvider` is registered separately in `bootstrap/providers/console.php` (not part of the HTTP boot).

Comment out providers you do not need yet to keep boot lean.

## Routes & views

- Routes: `routes/web.php` (loaded via `config/routes.php`)
- Views: `resources/views/frontend/` — namespace `@frontend/` in `config/view.php`
- Layout: `resources/views/frontend/layouts/base.twig`

Example route:

```php
$router->get('/', [IndexController::class, 'index'])->setName('home');
```

Twig helpers (`uri()`, `url()`, `base_url()`) come from `AppExtension`.

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
php bin/console db:migrate
php bin/console db:rollback
php bin/console migration:list
php bin/console db:seed
php bin/console seeders:list
php bin/console component:list
php bin/console component:publish-assets
```

Available commands depend on which providers are registered in `bootstrap/providers/console.php`.

## Configuration

| File | Description                            |
|------|----------------------------------------|
| `.env` | Environment variables (not committed)  |
| `config/app.php` | App name, timezone, locale, debug      |
| `config/db.php` | Database connection                    |
| `config/view.php` | Twig (Plates) paths, extensions, cache |
| `config/log.php` | Log level and retention                |
| `config/dev/` / `config/production/` | Env-specific overrides                 |

## Static analysis

```bash
composer phpstan
```

Configuration: `phpstan.neon` (level 10).

## Documentation

- [Concept Core docs](https://php-concept.github.io/concept-docs/)
- [Directory structure](https://php-concept.github.io/concept-docs/en/directory-structure.html)
- [Core repository](https://github.com/php-concept/concept-core)

---

## License

MIT © Concept Framework contributors.

---

<p align="center">
  <strong>Concept Framework</strong> — small kernel, sharp edges, infinite composition.<br>
  Build the app. Ship the component. Repeat.
</p>
