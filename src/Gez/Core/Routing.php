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

    /** @var ServerRequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    /**
     * @param RouteCollection        $route
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     */
    public function __construct(RouteCollection $route, ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->route = $route;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Define your routes here
     */
    public function mapRoutes()
    {
        $this->route->setStrategy(new ParamStrategy());

        $this->route->map('GET', '/', 'Gez\Controller\HomeController::home');
    }

    /**
     * @return ResponseInterface
     */
    public function dispatch()
    {
        return $this->route->dispatch(
            $this->request,
            $this->response
        );
    }
}
