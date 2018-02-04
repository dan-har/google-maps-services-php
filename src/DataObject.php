<?php

namespace Niddit\Google\Maps;

class DataObject
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Dynamically get value by key.
     *
     * @param string $key
     * @return mixed|null
     */
    public function __get($key)
    {
        if( ! array_key_exists($key, $this->data)) {
            return null;
        }

        return $this->data[$key];
    }
}
