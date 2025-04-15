<?php

declare(strict_types=1);

return [
    'name' => 'NoConsole',
    'version' => '1.0.0',
    'env' => [
        'LARAVEL_DIR' => '../../laravel',
    ],
    'commands' => [
        'Composer' => ['require', 'remove', 'install', 'update', 'dump-autoload',
            'show', 'check', 'geoip:update', 'fund',
        ],
        'Bower' => ['install', 'remove', 'update', 'list'],
        'Artisan' => ['exe',
            'route:list',
            'route:clear', 'view:clear', 'optimize:clear', 'cache:clear', 'config:clear',
            'config:cache',
            'migrate',
            'route:cache', 'vendor:publish',
        ],
        'Filament' => [
            'filament:upgrade',
        ],
        'Env' => [
            'debug:on', 'debug:off',
        ],
        'Log' => [
            'error:list', 'show:0', 'show:1', 'show:2', 'show:3', 'show:4', 'error:clear',
        ],
    ],
]; 