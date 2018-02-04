<?php

namespace Niddit\Google\Maps\Test\Service\Places;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use Niddit\Google\Maps\Service\Places\Status;
use Niddit\Google\Maps\Service\Places\PlaceDetailsResult;
use Niddit\Google\Maps\Service\Places\PlaceDetailsResponse;
use Niddit\Google\Maps\Test\Service\Places\Stub\PlaceDetails\ResponseMocks;
use Psr\Http\Message\StreamInterface;

class PlaceDetailsResponseTest extends \PHPUnit_Framework_TestCase
{
    use ResponseMocks;

    public function tearDown()
    {
        m::close();
    }

    public function testGetHttpResponse()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);

        $this->assertEquals($httpResponse, $placeDetailsResponse->getHttpResponse());
    }

    public function testGetStatusCode()
    {
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $httpResponse = m::mock(Response::class);
        $httpResponse->shouldReceive('getStatusCode')->andReturn(200);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);

        $this->assertEquals(200, $placeDetailsResponse->statusCode());
    }

    public function testGetResult()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);
        $this->assertEquals($placeDetailsResult, $placeDetailsResponse->result());

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::ZERO_RESULTS, null, []);
        $this->assertNull($placeDetailsResponse->result());
    }

    public function testGetHTmlAttributes()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, ['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $placeDetailsResponse->htmlAttributes());
    }

    public function testIsOk()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);
        $this->assertTrue($placeDetailsResponse->isOk());

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::ZERO_RESULTS, null, []);
        $this->assertFalse($placeDetailsResponse->isOk());
    }

    public function testHasResult()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);
        $this->assertTrue($placeDetailsResponse->hasResult());

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::ZERO_RESULTS, null, []);
        $this->assertFalse($placeDetailsResponse->hasResult());
    }

    public function testGetStatus()
    {
        $httpResponse = m::mock(Response::class);
        $placeDetailsResult = m::mock(PlaceDetailsResult::class);

        $placeDetailsResponse = new PlaceDetailsResponse($httpResponse, Status::OK, $placeDetailsResult, []);
        $this->assertEquals(Status::OK, $placeDetailsResponse->status());
    }

    public function testFromResponseCreatesOkResponse()
    {
        $placeDetailsResponse = PlaceDetailsResponse::fromResponse($this->getOkHttpResponse());

        $this->assertEquals(Status::OK, $placeDetailsResponse->status());
        $this->assertInstanceOf(PlaceDetailsResult::class, $placeDetailsResponse->result());
        $this->assertEquals([], $placeDetailsResponse->htmlAttributes());
        $this->assertNull($placeDetailsResponse->errorMessage());
    }

    public function testFromResponseCreateFailureResponse()
    {
        $placeDetailsResponse = PlaceDetailsResponse::fromResponse($this->getInvalidRequestHttpResponse());

        $this->assertEquals(Status::INVALID_REQUEST, $placeDetailsResponse->status());
        $this->assertNull(null, $placeDetailsResponse->result());
        $this->assertEquals([], $placeDetailsResponse->htmlAttributes());
        $this->assertNull($placeDetailsResponse->errorMessage());
    }

    public function testFromResponseCreateFailureResponseWithErrorMessage()
    {
        $placeDetailsResponse = PlaceDetailsResponse::fromResponse($this->getInvalidRequestWithErrorMessageHttpResponse());

        $this->assertEquals(Status::INVALID_REQUEST, $placeDetailsResponse->status());
        $this->assertNull(null, $placeDetailsResponse->result());
        $this->assertEquals([], $placeDetailsResponse->htmlAttributes());
        $this->assertEquals('Missing the placeid or reference parameter.', $placeDetailsResponse->errorMessage());
    }
}
