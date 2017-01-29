<?php

namespace Gez\Core\Http;

use Gez\Core\Http\Middleware\ResponseEmitter;
use Gez\Core\Routing;

/**
 * Class HttpKernel
 *
 * @package Gez\Core\Http
 */
class HttpKernel
{
    /** @var array */
    private $queue = [
        // ResponseSender must be first in the queue so it sends the response
        ResponseEmitter::class,
        // Routing should usually be last in the queue to execute the controller
        Routing::class,
    ];

    /**
     * @return array
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
