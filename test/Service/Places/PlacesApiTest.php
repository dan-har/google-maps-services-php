<?php

namespace Service\Places;

use Mockery as m;
use GuzzleHttp\Client;
use Niddit\Google\Maps\Auth;
use InvalidArgumentException;
use Niddit\Google\Maps\Service\Places\PlacesApi;

class PlacesApiTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testDetailsThrowsExceptionWhenMissingPlaceId()
    {
        $httpClient = m::mock(Client::class);
        $auth = m::mock(Auth::class);

        $placesApi = new PlacesApi($httpClient, $auth);

        $this->setExpectedException(InvalidArgumentException::class);

        $placesApi->details(null);
    }
}
