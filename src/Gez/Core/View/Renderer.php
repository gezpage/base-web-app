<?php

namespace Gez\Core\View;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

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
     * @return ResponseInterface
     */
    public function renderView($view, array $data = [])
    {
        $this->response->getBody()->write(
            $this->templates->render($view, $data)
        );

        return $this->response;
    }
}
