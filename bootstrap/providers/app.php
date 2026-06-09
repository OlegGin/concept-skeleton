<?php declare(strict_types=1);

use Concept\Core\Providers\CastingServiceProvider;
use Concept\Core\Providers\ComponentsServiceProvider;
use Concept\Core\Providers\ConfigServiceProvider;
use Concept\Core\Providers\DatabaseServiceProvider;
use Concept\Core\Providers\DataMaskerServiceProvider;
use Concept\Core\Providers\DebugLoggerServiceProvider;
use Concept\Core\Providers\ErrorHandlerServiceProvider;
use Concept\Core\Providers\HttpServiceProvider;
use Concept\Core\Providers\LocaleServiceProvider;
use Concept\Core\Providers\LogServiceProvider;
use Concept\Core\Providers\SessionServiceProvider;
use Concept\Core\Providers\TelemetryServiceProvider;
use Concept\Core\Providers\TwigServiceProvider;
use Concept\Core\Providers\ValidationServiceProvider;
use Concept\Core\Providers\ViewRegistryServiceProvider;

return [
    ConfigServiceProvider::class,
    LocaleServiceProvider::class,
    TelemetryServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    HttpServiceProvider::class,
    SessionServiceProvider::class,
    DataMaskerServiceProvider::class,
    LogServiceProvider::class,
    ViewRegistryServiceProvider::class,
    TwigServiceProvider::class,
    ValidationServiceProvider::class,
    DatabaseServiceProvider::class,
    CastingServiceProvider::class,
    DebugLoggerServiceProvider::class,
    ComponentsServiceProvider::class,
];
