<?php declare(strict_types=1);

use Concept\Core\Providers\ComponentsServiceProvider;
use Concept\Core\Providers\ConfigServiceProvider;
use Concept\Core\Providers\ConsoleServiceProvider;
use Concept\Core\Providers\DatabaseServiceProvider;
use Concept\Core\Providers\ErrorHandlerServiceProvider;
use Concept\Core\Providers\HttpServiceProvider;
use Concept\Core\Providers\LogServiceProvider;
use Concept\Core\Providers\SessionServiceProvider;

return [
    ConfigServiceProvider::class,
    HttpServiceProvider::class,
    SessionServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    LogServiceProvider::class,
    DatabaseServiceProvider::class,
    ConsoleServiceProvider::class,
    ComponentsServiceProvider::class,
];
