<?php

namespace Gez\Core\Service;

use League\Container\Container as LeagueContainer;
use League\Container\ReflectionContainer;

/**
 * Class Container
 *
 * @package Gez\Core\Service
 */
class Container
{
    /** @var LeagueContainer */
    private $container;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->container = new LeagueContainer();
        $this->configure($this->container, $config);
    }

    /**
     * Define your services here
     *
     * @param LeagueContainer $container
     * @param array           $config
     */
    public function configure(LeagueContainer $container, array $config)
    {
        // Enable service auto-wiring
        $container->delegate(
            new ReflectionContainer()
        );

        $container->share('config', $config);

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
        $container->share('Psr\Http\Message\ServerRequestInterface', function() use ($container) {
            return $container->get('Psr\Http\Message\RequestInterface');
        });

        $container->share('Zend\Diactoros\Response\EmitterInterface', \Zend\Diactoros\Response\SapiEmitter::class);

        $container->share('League\Plates\Engine')->withArgument($config['view_dir']);

        $container->share('Gez\Core\View\Renderer')
            ->withArgument('League\Plates\Engine')
            ->withArgument('Psr\Http\Message\ResponseInterface')
            ->withArgument('config');

        $container->share('Monolog\Logger', function() use ($config) {
            $log = new \Monolog\Logger('app');
            $log->pushHandler(new \Monolog\Handler\StreamHandler(
                $config['app_log'],
                \Monolog\Logger::DEBUG
            ));

            return $log;
        });
    }

    /**
     * @param string $service
     *
     * @return mixed|object
     */
    public function get($service)
    {
        return $this->container->get($service);
    }
}
