<?php declare(strict_types=1);

use Concept\Core\Providers\CastingServiceProvider;
use Concept\Core\Providers\ComponentsServiceProvider;
use Concept\Core\Providers\ConfigServiceProvider;
use Concept\Core\Providers\DatabaseServiceProvider;
use Concept\Core\Providers\ErrorHandlerServiceProvider;
use Concept\Core\Providers\EventServiceProvider;
use Concept\Core\Providers\HttpServiceProvider;
use Concept\Core\Providers\LogServiceProvider;
use Concept\Core\Providers\MaskerServiceProvider;
use Concept\Core\Providers\SessionServiceProvider;
use Concept\Core\Providers\ValidationServiceProvider;
use Concept\Core\Providers\ViewServiceProvider;

return [
    ConfigServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    EventServiceProvider::class,
    HttpServiceProvider::class,
    SessionServiceProvider::class,
    LogServiceProvider::class,
    ViewServiceProvider::class,
    MaskerServiceProvider::class,
    ValidationServiceProvider::class,
    DatabaseServiceProvider::class,
    CastingServiceProvider::class,
    ComponentsServiceProvider::class,
];
