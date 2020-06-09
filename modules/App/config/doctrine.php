<?php

return [
    'doctrine_migrations' => [
        'migrations_paths' => [
            'App\DoctrineMigrations' => dirname(__DIR__) . '/doctrine_migrations',
        ],
    ],

    'paths' => [
        dirname(__DIR__) . '/src/Entities',
    ],
];
