<?php

require __DIR__ . '/../bootstrap.php';

try {
    $routes = $container->get('Gez\Core\Routing');
    $routes->mapRoutes();
    $response = $routes->dispatch();
    $container->get('Zend\Diactoros\Response\EmitterInterface')->emit($response);
} catch (Exception $e) {
    $container->get('Monolog\Logger')->error(get_class($e), ['exception' => $e]);
    echo $container->get('League\Plates\Engine')->render('error', ['exception' => $e]);
}
