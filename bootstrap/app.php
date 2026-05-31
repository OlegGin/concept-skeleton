<?php declare(strict_types=1);

use Concept\Core\App;

$rootPath = dirname(__DIR__);
/** @var array<string, string> $paths */
$paths = include $rootPath . '/bootstrap/paths.php';
$app = App::create($rootPath, $paths);

$providerFiles = [
    $rootPath . '/bootstrap/providers/app.php',
];
$app->registerServiceProviders($providerFiles);

return $app;
