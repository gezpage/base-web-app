<?php

namespace Gez\Core\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Relay\RelayBuilder;

/**
 * Class Application
 *
 * @package Gez\Core\Http
 */
class Application
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    /** @var HttpKernel */
    private $httpKernel;

    /** @var RelayBuilder */
    private $relayBuilder;

    /**
     * Application constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param HttpKernel        $httpKernel
     * @param RelayBuilder      $relayBuilder
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        HttpKernel $httpKernel,
        RelayBuilder $relayBuilder
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->httpKernel = $httpKernel;
        $this->relayBuilder = $relayBuilder;
    }

    /**
     * Start application
     */
    public function run()
    {
        // HttpKernel stores the middleware classes
        $queue = $this->httpKernel->getQueue();

        // RelayBuilder handles the loading of middlewares
        $relay = $this->relayBuilder->newInstance($queue);
        $response = $relay($this->request, $this->response);
        // Response sender middleware emits the response, so we don't do anything here
    }
}
