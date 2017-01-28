<?php

namespace Gez\Controller;

use Gez\Core\View\Renderer;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;

/**
 * Class HomeController
 *
 * @package Gez\Controller
 */
class HomeController
{
    /** @var Renderer */
    private $renderer;

    /** @var Logger */
    private $logger;

    /**
     * @param Renderer $renderer
     * @param Logger $logger
     */
    public function __construct(Renderer $renderer, Logger $logger)
    {
        $this->renderer = $renderer;
        $this->logger = $logger;
    }

    /**
     * @param RequestInterface $request
     *
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function home(RequestInterface $request)
    {
        $this->logger->notice('Request log', [
            'uri' => $request->getUri(),
        ]);

        return $this->renderer->renderView('home', [
            'message' => 'Welcome!',
        ]);
    }
}
