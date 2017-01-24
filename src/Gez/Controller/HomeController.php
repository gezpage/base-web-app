<?php

namespace Gez\Controller;

use Gez\Core\View\Renderer;

/**
 * Class HomeController
 *
 * @package Gez\Controller
 */
class HomeController
{
    /** @var Renderer */
    private $renderer;

    /**
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function home()
    {
        return $this->renderer->renderView('home', [
            'message' => 'Welcome!',
        ]);
    }
}
