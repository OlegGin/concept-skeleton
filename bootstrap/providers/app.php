<?php declare(strict_types=1);

use Concept\Core\Providers\Bootstrap\ConfigServiceProvider;
use Concept\Core\Providers\Bootstrap\ErrorHandlerServiceProvider;
use Concept\Core\Providers\Component\ComponentsServiceProvider;
use Concept\Core\Providers\Database\DatabaseServiceProvider;
use Concept\Core\Providers\Http\HttpServiceProvider;
use Concept\Core\Providers\Http\SessionServiceProvider;
use Concept\Core\Providers\Logging\DebugLoggerServiceProvider;
use Concept\Core\Providers\Logging\LogServiceProvider;
use Concept\Core\Providers\Support\CastingServiceProvider;
use Concept\Core\Providers\Support\DataMaskerServiceProvider;
use Concept\Core\Providers\Support\LocaleServiceProvider;
use Concept\Core\Providers\Support\ValidationServiceProvider;
use Concept\Core\Providers\Telemetry\TelemetryServiceProvider;
use Concept\Core\Providers\View\TwigServiceProvider;
use Concept\Core\Providers\View\ViewRegistryServiceProvider;

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
