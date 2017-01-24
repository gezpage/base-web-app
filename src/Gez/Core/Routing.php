<?php

namespace Gez\Core;

use League\Route\RouteCollection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use League\Route\Strategy\ParamStrategy;

class Routing
{
    private $route;
    private $request;
    private $response;

    public function __construct(RouteCollection $route, RequestInterface $request, ResponseInterface $response)
    {
        $this->route = $route;
        $this->request = $request;
        $this->response = $response;
    }

    public function mapRoutes()
    {
        $this->route->setStrategy(new ParamStrategy());

        // Define your routes here

        $this->route->map('GET', '/', 'Gez\Controller\HomeController::home');
    }

    public function dispatch()
    {
        return $this->route->dispatch(
            $this->request,
            $this->response
        );
    }
}
