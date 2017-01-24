<?php

namespace Gez\Core\View;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

class Renderer
{
    /** @var Engine */
    private $templates;

    /** @var ResponseInterface */
    private $response;

    /**
     * @param Engine $templates
     * @param ResponseInterface $response
     * @param array $config
     */
    public function __construct(Engine $templates, ResponseInterface $response, array $config)
    {
        $this->templates = $templates;
        $this->templates->addData(['config' => $config]);
        $this->response = $response;
    }

    /**
     * @param string $view
     * @param array $data
     */
    public function renderView($view, array $data = [])
    {
        return new HtmlResponse(
            $this->templates->render($view, $data)
        );
        //return $this->response->getBody()->write(
            //$this->templates->render($view, $data)
        //);
    }
}
