<?php

return [
    'app_name' => 'Base Project',
    'debug' => true,
    'dbal' => [
        'dbname' => 'base-project',
        'user' => 'root',
        'password' => 'password',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ],
    'view_dir' => realpath(__DIR__ . '/../../views'),
];
