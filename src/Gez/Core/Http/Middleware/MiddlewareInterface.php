<?php

namespace Gez\Core\Http\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Uses PSR compliant request and response objects
 */
interface MiddlewareInterface
{
    /**
     * __invoke() must call the next middleware like so:
     *
     *   $response = $next($request, $response);
     *
     * The request and response can be manipulated before and after this call, as desired.
     * __invoke() must return a response object:
     *
     *   return $response
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next);
}
