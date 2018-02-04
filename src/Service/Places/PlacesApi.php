<?php

namespace Niddit\Google\Maps\Service\Places;

use Exception;
use InvalidArgumentException;
use Niddit\Google\Maps\Service\AbstractService;
use Niddit\Google\Maps\Service\ResourceRequestException;

class PlacesApi extends AbstractService
{
    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return 'https://maps.googleapis.com/maps/api/place/details/json';
    }

    /**
     * Send request for place details by place id.
     *
     * @param string $placeId
     * @param array $query
     * @return \Niddit\Google\Maps\Service\Places\PlaceDetailsResponse
     * @throws \Niddit\Google\Maps\Service\ResourceRequestException
     */
    public function details($placeId, $query = [])
    {
        if( ! $placeId) {
            throw new InvalidArgumentException('placeId must be a string');
        }

        try {
            $response = $this->httpClient->request('GET', $this->url, [
                'query' => array_merge([
                    'placeid' => $placeId,
                    'key' => $this->auth->key(),
                ], $query)
            ]);

        } catch (Exception $e) {
            throw new ResourceRequestException(null, sprintf('Failed to request place details for place id %s', $placeId), 0, $e);
        }

        if( $response->getStatusCode() > 299) {
            throw new ResourceRequestException($response, sprintf('Failed to request place details for place id %s', $placeId));
        }

        return PlaceDetailsResponse::fromResponse($response);
    }
}
