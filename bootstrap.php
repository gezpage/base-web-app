<?php

require __DIR__ . '/vendor/autoload.php';

$configFile = __DIR__ . '/app/config/config.php';

if (false === file_exists($configFile)) {
    echo "Missing config file: {$configFile}. \n";
    echo "Copy app/config/config.dist.php to app/config/config.php and edit. \n";
    exit;
}

$container = new Gez\Core\Service\Container(include $configFile);

if ($container->get('config')['debug'] === true) {

    // Register whoops error handler
    $container->get('Whoops\Run')->register();

    // Display errors in html
    ini_set('display_errors', 1);
    ini_set('html_errors', 1);

}
