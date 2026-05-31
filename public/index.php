<?php declare(strict_types=1);

use Concept\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

/** @var App $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->run();
