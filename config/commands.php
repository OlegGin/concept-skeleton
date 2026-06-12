<?php declare(strict_types=1);

use Concept\Core\Console\Commands\ComponentListCommand;
use Concept\Core\Console\Commands\ComponentPublishAssetsCommand;
use Concept\Core\Console\Commands\DbMigrateCommand;
use Concept\Core\Console\Commands\DbMigrationListCommand;
use Concept\Core\Console\Commands\DbRollbackCommand;
use Concept\Core\Console\Commands\DbSeedCommand;
use Concept\Core\Console\Commands\DbSeedersListCommand;
use Concept\Core\Console\Commands\RouteListCommand;
use Concept\Core\Console\Commands\ViewClearCommand;

return [
    'commands' => [
        // Database Tools
        DbMigrateCommand::class,
        DbMigrationListCommand::class,
        DbRollbackCommand::class,
        DbSeedCommand::class,
        DbSeedersListCommand::class,

        // System Tools
        ViewClearCommand::class,
        ComponentListCommand::class,
        ComponentPublishAssetsCommand::class,
        RouteListCommand::class,

        // Custom Business Commands
    ],
];