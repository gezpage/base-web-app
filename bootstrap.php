<?php

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/app/config/config.php';
$container = new Gez\Core\Service\Container($config);

if ($container->get('config')['debug'] === true) {
    ini_set('display_errors', 1);
    ini_set('html_errors', 1);
}
