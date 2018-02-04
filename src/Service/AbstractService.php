<?php

namespace Niddit\Google\Maps\Service;

use GuzzleHttp\Client;
use Niddit\Google\Maps\Auth;

abstract class AbstractService
{

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * The service url.
     *
     * @var string
     */
    protected $url = '';

    /**
     * @var \Niddit\Google\Maps\Auth
     */
    protected $auth;

    /**
     * @param \GuzzleHttp\Client $httpClient
     * @param \Niddit\Google\Maps\Auth $auth
     */
    public function __construct(Client $httpClient, Auth $auth)
    {
        $this->httpClient = $httpClient;
        $this->auth = $auth;
        $this->url = $this->getUrl();
    }

    /**
     * Get the service base url.
     *
     * @return string
     */
    abstract public function getUrl();
}
