<?php declare(strict_types=1);

use Concept\Core\Providers\Bootstrap\ConfigServiceProvider;
use Concept\Core\Providers\Bootstrap\ErrorHandlerServiceProvider;
use Concept\Core\Providers\Component\ComponentsServiceProvider;
use Concept\Core\Providers\Console\ConsoleServiceProvider;
use Concept\Core\Providers\Database\DatabaseServiceProvider;
use Concept\Core\Providers\Http\HttpServiceProvider;
use Concept\Core\Providers\Logging\LogServiceProvider;
use Concept\Core\Providers\Support\DataMaskerServiceProvider;

return [
    ConfigServiceProvider::class,
    ConsoleServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    HttpServiceProvider::class,
    DataMaskerServiceProvider::class,
    LogServiceProvider::class,
    DatabaseServiceProvider::class,
    ComponentsServiceProvider::class,
];
