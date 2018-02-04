<?php

namespace Niddit\Google\Maps\Service\Places;

use Niddit\Google\Maps\Address\AddressComponent;
use Niddit\Google\Maps\DataObject;

/**
 * @property \Niddit\Google\Maps\Address\AddressComponent[] addressComponents
 * @property string adrAddress
 * @property string formattedAddress
 * @property string formattedPhoneNumber
 * @property array geometry
 * @property string icon
 * @property string id
 * @property string internationalPhoneNumber
 * @property string name
 * @property array openingHours
 * @property string place_id
 * @property float rating
 * @property string reference
 * @property array reviews
 * @property string scope
 * @property array types
 * @property string url
 * @property int utcOffset
 * @property string vicinity
 * @property string website
 */
class PlaceDetailsResult extends DataObject
{
    /**
     * @param array $result
     * @return static
     */
    public static function fromArray(array $result)
    {
        $data = [];

        foreach($result as $key => $value) {
            $camelCaseKey = str_replace('_', '', lcfirst(ucwords($key, '_')));

            $data[$camelCaseKey] = $value;
        }

        $addressComponents = [];

        foreach($result['address_components'] as $addressComponent) {
            $addressComponents[] = new AddressComponent(
                $addressComponent['long_name'],
                $addressComponent['short_name'],
                $addressComponent['types']
            );
        }

        $data['addressComponents'] = $addressComponents;

        return new static($data);
    }
}
