<?php

namespace Gez\Core\Service;

use League\Container\Container as LeagueContainer;
use League\Container\ReflectionContainer;

class Container
{
    private $container;

    public function __construct(array $config = [])
    {
        $this->container = new LeagueContainer();
        $this->configure($this->container, $config);
    }

    public function configure(LeagueContainer $container, array $config)
    {
        // Enable service auto-wiring
        $container->delegate(
            new ReflectionContainer()
        );

        // Define your services here

        $container->share('League\Route\RouteCollection')->withArgument($container);

        $container->share('Doctrine\DBAL\Connection', function () use ($config) {
            return \Doctrine\DBAL\DriverManager::getConnection(
                $config['dbal'],
                new \Doctrine\DBAL\Configuration()
            );
        });

        $container->share('Psr\Http\Message\ResponseInterface', \Zend\Diactoros\Response::class);
        $container->share('Psr\Http\Message\RequestInterface', function () {
            return \Zend\Diactoros\ServerRequestFactory::fromGlobals(
                $_SERVER,
                $_GET,
                $_POST,
                $_COOKIE,
                $_FILES
            );
        });

        $container->share('Zend\Diactoros\Response\EmitterInterface', \Zend\Diactoros\Response\SapiEmitter::class);

        $container->share('League\Plates\Engine')->withArgument($config['view_dir']);

        $container->share('config', $config);

        $container->share('Gez\Core\View\Renderer')
            ->withArgument('League\Plates\Engine')
            ->withArgument('Psr\Http\Message\ResponseInterface')
            ->withArgument('config');
    }

    public function get($service)
    {
        return $this->container->get($service);
    }
}
