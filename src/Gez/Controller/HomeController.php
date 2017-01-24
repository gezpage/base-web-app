<?php

namespace Gez\Controller;

use Gez\Core\View\Renderer;
use Gez\Repository\SongRepository;
use League\Plates\Engine;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController
{
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function home()
    {
        return $this->renderer->renderView('home', [
            'message' => 'Welcome!',
        ]);
    }
}
