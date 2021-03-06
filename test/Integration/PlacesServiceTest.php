<?php

namespace Niddit\Google\Maps\Test\Integration;

use GuzzleHttp\Client;
use Niddit\Google\Maps\AddressType;
use Niddit\Google\Maps\Auth;
use Niddit\Google\Maps\Service\Places\PlacesApi;
use Niddit\Google\Maps\Service\ResourceRequestException;

class PlacesServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The google api key.
     *
     * @var string
     */
    protected $key;

    public function setUp()
    {
        $this->key = getenv('GOOGLE_API_KEY');
    }

    public function testPlaceDetails()
    {
        $placesService = new PlacesApi(new Client(), Auth::fromKey($this->key));
        $placeId = 'ChIJN1t_tDeuEmsRUsoyG83frY4';

        try {
            $placeResponse = $placesService->details($placeId);
        } catch (ResourceRequestException $e) {
            // handle request exception, for example caused by timeout
        }

        // check if the response is ok, if so we have a result for the place id
        if( ! $placeResponse->isOk()) {
            // handle request failure, for example no results, wrong place id etc.
        }

        $result = $placeResponse->result();

        // check for address component
        foreach($result->addressComponents as $addressComponent) {

            if($addressComponent->isType(AddressType::LOCALITY)) {
                //
            }
        }

        // get the geometry object.
        $geometry = $result->geometry;
    }
}
