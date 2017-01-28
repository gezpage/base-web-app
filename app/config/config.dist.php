<?php

return [
    'app_name' => 'Base Web App',
    'debug' => true,
    'dbal' => [
        'dbname' => 'base-web-app',
        'user' => 'root',
        'password' => 'password',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ],
    'view_dir' => realpath(__DIR__ . '/../../views'),
    'app_log' => realpath(__DIR__ . '/../../app/log/app.log'),
];
