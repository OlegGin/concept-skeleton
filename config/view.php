<?php declare(strict_types=1);

use Concept\App\Extensions\Twig\AppExtension;

return [
    'view' => [
        'extensions' => [
            AppExtension::class,
        ],
        'paths' => [
            'frontend' => '/resources/views/frontend',
        ],
        'contexts' => [
            '/' => 'frontend',
        ],
        'cache_dir' => 'views',
    ],
];