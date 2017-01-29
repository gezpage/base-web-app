<?php

namespace Gez\Core;

use League\Route\RouteCollection;
use League\Route\Strategy\ParamStrategy;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Routing
 *
 * @package Gez\Core
 */
class Routing
{
    /** @var RouteCollection */
    private $route;

    /**
     * @param RouteCollection        $route
     */
    public function __construct(RouteCollection $route)
    {
        $this->route = $route;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $this->mapRoutes();

        return $this->route->dispatch($request, $response);
    }

    /**
     * Define your routes here
     */
    public function mapRoutes()
    {
        $this->route->setStrategy(new ParamStrategy());

        $this->route->map('GET', '/', 'Gez\Controller\HomeController::home');
    }
}
