<?php

namespace Gez\Core\Service;

use League\Container\Container as LeagueContainer;
use League\Container\ReflectionContainer;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

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

        $container->share('Zend\HttpHandlerRunner\Emitter\EmitterInterface', SapiEmitter::class);

        $container->share('League\Plates\Engine')->withArgument($config['view_dir']);

        $container->share('Monolog\Logger', function() use ($config) {
            $log = new \Monolog\Logger('app');
            $log->pushHandler(new \Monolog\Handler\StreamHandler(
                $config['app_log'],
                \Monolog\Logger::DEBUG
            ));

            return $log;
        });

        $container->share('DebugBar\DebugBar', function() {
            $debugbar = new \DebugBar\StandardDebugBar();
            $debugbar->addCollector(new \DebugBar\DataCollector\ConfigCollector(
                $this->container->get('config')
            ));
            $debugbar->addCollector(new \DebugBar\Bridge\DoctrineCollector(
                new \Doctrine\DBAL\Logging\DebugStack()
            ));
            $debugbar->addCollector(new \DebugBar\Bridge\MonologCollector(
                $this->container->get('Monolog\Logger')
            ));

            return $debugbar;
        });

        $container->share('Gez\Core\View\Renderer')
            ->withArgument('League\Plates\Engine')
            ->withArgument('Psr\Http\Message\ResponseInterface')
            ->withArgument([
                'config' => $this->container->get('config'),
                'debugbar' => $this->container->get('DebugBar\DebugBar'),
            ]);

        $container->add('Relay\RelayBuilder', function() {
            $resolver = function ($class) {
                return $this->container->get($class);
            };

            return new \Relay\RelayBuilder($resolver);
        });

        $container->add('Whoops\Run', function() {
            $run = new \Whoops\Run();
            $run->pushHandler(new \Whoops\Handler\PrettyPageHandler());
            if (\Whoops\Util\Misc::isAjaxRequest()) {
                $run->pushHandler(new \Whoops\Handler\JsonResponseHandler());
            }

            return $run;
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
