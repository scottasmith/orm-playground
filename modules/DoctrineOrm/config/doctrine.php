<?php

return [
    'connection' => [
        'driver' => getenv('DATABASE_DRIVER'),
        'host' => getenv('DATABASE_HOST'),
        'database' => getenv('DATABASE_DB'),
        'username' => getenv('DATABASE_USERNAME'),
        'password' => getenv('DATABASE_PASSWORD'),
    ],

    'doctrine_migrations' => [
        'table_storage' => [
            'table_name'                 => 'doctrine_migration_versions',
            'version_column_name'        => 'version',
            'version_column_length'      => 1024,
            'executed_at_column_name'    => 'executed_at',
            'execution_time_column_name' => 'execution_time',
        ],

        'migrations_paths' => [
            // Migration paths in the format 'php namespace' => 'absolute path'
            // eg.
            // 'App\DoctrineMigrations' => base_path(__DIR__) . '/database/doctrine_migrations',
        ],

        'all_or_nothing'          => true,
        'check_database_platform' => true,
    ],

    'paths' => [
        // Paths of entities
        // dirname(__DIR__) . '/src',
    ],
];
