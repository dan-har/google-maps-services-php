<?php

namespace Niddit\Google\Maps\Test\Service\Places\Stub\PlaceDetails;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\StreamInterface;

trait ResponseMocks
{
    /**
     * Get a place details response with OK status.
     *
     * @return \Mockery\MockInterface
     */
    public function getOkHttpResponse()
    {
        $streamContent = require __DIR__.'./ok-response.php';

        return $this->getResponseMockWithStreamContent($streamContent);
    }

    /**
     * Get a place details response with INVALID_REQUEST status.
     *
     * @return \Mockery\MockInterface
     */
    public function getInvalidRequestHttpResponse()
    {
        $streamContent = require __DIR__.'./invalid-response.php';

        return $this->getResponseMockWithStreamContent($streamContent);
    }

    /**
     * Get a place details response with INVALID_REQUEST status and error message.
     *
     * @return \Mockery\MockInterface
     */
    public function getInvalidRequestWithErrorMessageHttpResponse()
    {
        $streamContent = require __DIR__.'./invalid-error-message-response.php';

        return $this->getResponseMockWithStreamContent($streamContent);
    }

    /**
     * @param string $streamContent
     * @return \Mockery\MockInterface
     */
    public function getResponseMockWithStreamContent($streamContent)
    {
        $httpResponse = m::mock(Response::class);
        $stream = m::mock(StreamInterface::class);

        $stream->shouldReceive('getContents')->once()->andReturn($streamContent);
        $httpResponse->shouldReceive('getBody')->once()->andReturn($stream);

        return $httpResponse;
    }
}
