<?php

namespace Gez\Core\View;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class Renderer
 *
 * @package Gez\Core\View
 */
class Renderer
{
    /** @var Engine */
    private $templates;

    /** @var ResponseInterface */
    private $response;

    /**
     * @param Engine            $templates
     * @param ResponseInterface $response
     * @param array             $data
     */
    public function __construct(Engine $templates, ResponseInterface $response, array $data)
    {
        $this->templates = $templates;
        $this->response = $response;
        $this->templates->addData($data);
    }

    /**
     * @param string $view
     * @param array  $data
     *
     * @return HtmlResponse
     */
    public function renderView($view, array $data = [])
    {
        return new HtmlResponse(
            $this->templates->render($view, $data)
        );
    }
}
