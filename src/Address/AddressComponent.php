<?php

namespace Niddit\Google\Maps\Address;

class AddressComponent
{
    /**
     * @var string
     */
    protected $longName;

    /**
     * @var string
     */
    protected $shortName;

    /**
     * @var array
     */
    protected $types;

    /**
     * @param string $longName
     * @param string $shortName
     * @param array $types
     */
    public function __construct($longName, $shortName, array $types)
    {
        $this->longName = $longName;
        $this->shortName = $shortName;
        $this->types = $types;
    }

    /**
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Check if the address component is a address type.
     *
     * @param string $type
     * @return bool
     */
    public function isType($type)
    {
        return array_search($type, $this->types) !== false;
    }
}
