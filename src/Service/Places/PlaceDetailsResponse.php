<?php

namespace Niddit\Google\Maps\Service\Places;

use GuzzleHttp\Psr7\Response;

class PlaceDetailsResponse
{
    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $httpResponse;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \Niddit\Google\Maps\Service\Places\PlaceDetailsResult
     */
    protected $result;

    /**
     * @var array
     */
    protected $htmlAttributes;

    /**
     * @var null|string
     */
    protected $errorMessage;

    /**
     * @param \GuzzleHttp\Psr7\Response $httpResponse
     * @param string $status
     * @param \Niddit\Google\Maps\Service\Places\PlaceDetailsResult $result
     * @param array $htmlAttributes
     * @param string $errorMessage
     */
    public function __construct(Response $httpResponse, $status, PlaceDetailsResult $result = null, array $htmlAttributes = [], $errorMessage = null)
    {
        $this->httpResponse = $httpResponse;
        $this->status = $status;
        $this->result = $result;
        $this->htmlAttributes = $htmlAttributes;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Create response from http response.
     *
     * @param \GuzzleHttp\Psr7\Response $httpResponse
     * @return \Niddit\Google\Maps\Service\Places\PlaceDetailsResponse
     */
    public static function fromResponse(Response $httpResponse)
    {
        $content = json_decode($httpResponse->getBody()->getContents(), true);

        $status = isset($content['status']) ? $content['status'] : '';

        if($status == Status::OK) {
            $htmlAttributes = isset($content['html_attributes']) ? $content['html_attributes'] : [];

            $result = isset($content['result']) ? $content['result'] : [];
            $result = PlaceDetailsResult::fromArray($result);
            $errorMessage = null;
        }

        else {
            $errorMessage = isset($content['error_message']) ? $content['error_message'] : null;
            $htmlAttributes = [];
            $result = null;
        }

        return new static($httpResponse, $status, $result, $htmlAttributes, $errorMessage);
    }

    /**
     * Get the http response.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * Get the http status code.
     *
     * @return int
     */
    public function statusCode()
    {
        return $this->httpResponse->getStatusCode();
    }

    /**
     * Get the response status.
     *
     * @return string
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * Get the result.
     *
     * @return \Niddit\Google\Maps\Service\Places\PlaceDetailsResult|null
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * Get the error message.
     *
     * @return null|string
     */
    public function errorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Get the html attributes.
     *
     * @return array
     */
    public function htmlAttributes()
    {
        return $this->htmlAttributes;
    }

    /**
     * Check if the response status is ok.
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->status == Status::OK;
    }

    /**
     * Check if response has a result.
     *
     * @return bool
     */
    public function hasResult()
    {
        return !! $this->result;
    }
}
