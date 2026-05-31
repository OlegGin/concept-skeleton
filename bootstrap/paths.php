<?php

use Concept\Core\Components\Path\PathManager;

return [
    PathManager::BOOTSTRAP_DIR => 'bootstrap',
    PathManager::SRC_DIR => 'src',
    PathManager::CONFIG_DIR => 'config',
    PathManager::MIGRATIONS_DIR => 'database/migrations',
    PathManager::SEEDERS_DIR => 'database/seeders',
    PathManager::PUBLIC_DIR => 'public',
    PathManager::STORAGE_DIR => 'storage',
    PathManager::LOGS_DIR => 'storage/logs',
    PathManager::CACHE_DIR => 'storage/cache',
    PathManager::RESOURCES_DIR => 'resources',
    PathManager::VIEWS_DIR => 'resources/views',
    PathManager::ERRORS_FALLBACK_VIEWS_DIR => 'resources/views/errors/fallback',
];