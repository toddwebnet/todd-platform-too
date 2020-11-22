<?php
return [
    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => env('REDIS_HOST', 'redis'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
        ],

    ],
];
