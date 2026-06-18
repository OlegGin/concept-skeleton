# AGENTS.md — маніфест для ШІ

Інструкції для ШІ-агентів (Cursor та ін.) при роботі з **concept-skeleton** — демо-застосунком на [Concept Core](https://github.com/php-concept/core) (`php-concept/core`).

## Про проєкт

- **Мова:** PHP 8.4+, `declare(strict_types=1);` у кожному файлі
- **Namespace:** `Concept\` → `src/`
- **Стек:** League Route, League Container, Laminas Diactoros, Twig, Illuminate Database (Eloquent), Valinor, Symfony Console/Session
- **UI:** Bootstrap 5, Twig-шаблони, темна admin-панель (`@dashboard`)
- **Локаль:** `uk` (за замовчуванням), fallback `en`
- **Документація фреймворку:** `docs/uk/` (статичний HTML, `php -S localhost:8080 -t docs`)

## Архітектура

Проєкт використовує **модульний моноліт (package by feature)**:

```
src/
├── App/                    # спільний код застосунку (BaseModel, глобальні контролери, валідація)
└── Components/             # ізольовані функціональні модулі
    ├── AuthAdmin/          # адмін-авторизація, CRUD користувачів
    ├── UserCabinet/        # реєстрація, кабінет користувача
    ├── ProjectManager/     # управління проєктами
    └── DebugBar/           # dev-панель (тільки dev)
```

**Активні компоненти** реєструються в `config/components.php`. Кожен модуль — окрема папка з власними маршрутами, views, міграціями, сидерами та CLI-командами.

Глобальні маршрути та middleware-стек — у `routes/web.php`. Конфіг маршрутів — `config/routes.php`.

## Структура компонента

При створенні або зміні модуля дотримуйся структури **AuthAdmin** як еталону:

```
ComponentName/
├── {Name}Component.php     # extends BaseComponent, $componentDir = __DIR__
├── config.php                # метадані, migrations, seeders, views, assets, commands
├── routes.php                # HTTP-маршрути модуля
├── Controllers/
├── Middlewares/
├── Requests/                 # FormRequest + правила валідації
├── Dto/                      # readonly DTO (extends Concept\Core\Dto\Dto)
├── Models/                   # Eloquent-моделі
├── Services/                 # бізнес-логіка
├── Views/                    # Twig (@namespace/...)
├── Database/
│   ├── Migrations/
│   └── Seeders/
├── Commands/                 # Symfony Console
├── Extensions/               # Twig-розширення модуля
└── Assets/                   # JS/CSS → public через config assets
```

Після створення компонента — додай його клас у `config/components.php`.

## Конвенції коду

### PHP

- `declare(strict_types=1);` на початку кожного файлу
- Constructor property promotion, `readonly` де доречно
- DI через конструктор; не використовуй service locator
- PHPStan рівень 9 (`composer phpstan`); моделі виключені з аналізу
- Не додавай зайвих абстракцій, хелперів чи коментарів до очевидного коду
- Мінімізуй scope змін — лише те, що потрібно для задачі

### Моделі

- Наслідуй `Concept\App\Models\BaseModel` (містить `getId()`, `FIELD_ID`, `SORT_*`)
- Оголошуй константи полів: `public const string FIELD_NAME = 'name';`
- `$fillable`, `$hidden`, `$dates` — через константи полів
- Геттери: `getName()`, `isAdmin()` тощо
- Мутатори паролів — через `setPasswordAttribute()` з `password_hash()`

### Request → DTO → Controller

```php
/** @extends FormRequest<StoreUserDto> */
class StoreUserRequest extends FormRequest
{
    protected ?string $dtoClass = StoreUserDto::class;

    public function rules(): array { /* ... */ }
}
```

- DTO — `readonly` властивості в конструкторі, `extends Dto implements DtoInterface`
- Контролер отримує `FormRequest`, викликає `$request->validated()` або `$request->toDto()`
- Редіректи — `$this->response->redirectByName('route.name')`
- Views — `$this->viewResponse->create('@namespace/path', $data)`
- Flash-повідомлення — `FlashBagInterface`

### Маршрути

- Іменовані маршрути: `->setName('admin.users')`
- Групи з middleware: `->lazyMiddleware(AuthMiddleware::class)`
- Параметри: `{id:number}`
- Публічні маршрути (login) — поза auth-middleware
- У Twig: `uri('admin.user.create')` або `path()`

### Views (Twig)

- Шаблони модуля: `@auth-admin/users/list` → `src/Components/AuthAdmin/Views/users/list.twig`
- Реєстрація namespace у `config.php` → `view.paths`
- Admin-сторінки extends `@dashboard/layouts/base.twig`
- `view.contexts` у config.php задає `route_namespace` для URL-префіксів
- Спільні layouts: `resources/views/dashboard/`, `resources/views/`

### Міграції

- Іменування: `V{YYYY}_{MM}_{DD}_{HHMMSS}_{Description}.php`
- Анонімний клас `extends Migration`, `CapsuleManager::schema()`
- Шляхи в `config.php` компонента → `migrations.paths`

### config.php компонента

Обов'язкові ключі: `name`, `description`, `version`. Опційні: `seeders`, `migrations`, `commands`, `view`, `assets`, `providers`.

## Команди

```bash
composer phpstan          # статичний аналіз
composer test             # PHPUnit
composer console          # Symfony Console (міграції, сидери, component:list)
composer publish-assets   # Bootstrap → public/vendor
```

## Що НЕ робити

- Не змінювати `vendor/` напряму
- Не комітити `.env`, `storage/`, `vendor/`
- Не розміщувати код фічі в `App/` — тільки спільні речі
- Не дублювати middleware з `routes/web.php` у компонентах без потреби
- Не створювати markdown-файли без явного запиту
- Не робити git commit без явного запиту користувача
- Не додавати тести без запиту або без реальної цінності
- Не змінювати непов'язаний код «про всяк випадок»

## Приклади для орієнтиру

| Задача | Дивись |
|--------|--------|
| CRUD + admin | `src/Components/AuthAdmin/` |
| Кабінет користувача | `src/Components/UserCabinet/` |
| Модуль з enum-статусами | `src/Components/ProjectManager/` |
| Service Provider | `src/Components/DebugBar/Providers/` |
| Глобальна валідація | `src/App/Validation/Rules/` |
| Спільна модель | `src/App/Models/BaseModel.php` |

## Мова спілкування

Користувач спілкується українською. Відповіді та коментарі в коді — англійською (як у наявному коді), якщо користувач не просить інакше.
