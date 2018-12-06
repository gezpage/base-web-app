<?php

namespace Gez\Core\Http\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\HttpHandlerRunner\Emitter\EmitterInterface;

/**
 * Class ResponseEmitter
 *
 * @package Gez\Core\Http\Middleware
 */
class ResponseEmitter implements MiddlewareInterface
{
    /** @var EmitterInterface */
    private $emitter;

    /**
     * ResponseEmitter constructor.
     *
     * @param EmitterInterface $emitter
     */
    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        // Do nothing on 1st pass

        $response = $next($request, $response);

        $this->emitter->emit($response);

        return $response;
    }
}
