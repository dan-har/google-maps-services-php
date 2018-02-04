<?php

namespace Niddit\Google\Maps\Service;

use RuntimeException;
use Psr\Http\Message\ResponseInterface;

class ResourceRequestException extends RuntimeException
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(ResponseInterface $response = null, $message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
