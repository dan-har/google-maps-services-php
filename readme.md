# google-maps-services-php

PHP client for google maps api service.

## Installation

Install using composer

```
composer require dan-har/google-maps-services-php
```

## Usage

```php
$placesService = new PlacesApi(new Client(), Auth::fromKey('GOOGLE_API_KEY'));

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
```