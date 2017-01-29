<?php

require __DIR__ . '/../bootstrap.php';

try {
    $container->get('Gez\Core\Http\Application')->run();
} catch (Exception $e) {
    $container->get('Monolog\Logger')->error(get_class($e), ['exception' => $e]);
    echo $container->get('League\Plates\Engine')->render('error', ['exception' => $e]);
}
