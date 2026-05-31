<?php declare(strict_types=1);


use Concept\Core\App;
use Symfony\Component\Console\Application as ConsoleApplication;

require __DIR__ . '/../vendor/autoload.php';

$rootPath = dirname(__DIR__);
/** @var array<string, string> $paths */
$paths = include $rootPath . '/bootstrap/paths.php';
$app = App::create($rootPath, $paths);

$providerFiles = [
    $rootPath . '/bootstrap/providers/console.php',
];
$app->registerServiceProviders($providerFiles);

$container = $app->getContainer();
/** @var ConsoleApplication $console */
$console = $container->get(ConsoleApplication::class);

$console->run();
