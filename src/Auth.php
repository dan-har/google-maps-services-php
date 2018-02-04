<?php

namespace Niddit\Google\Maps;

use InvalidArgumentException;

class Auth
{
    /**
     * The services api key.
     *
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        if( ! strlen($key) > 0) {
            throw new InvalidArgumentException('Key cannot be empty string');
        }

        $this->key = $key;
    }

    /**
     * Create from key.
     *
     * @param string $key
     * @return \Niddit\Google\Maps\Auth
     */
    public static function fromKey($key)
    {
        return new self($key);
    }

    /**
     * Get the auth key.
     *
     * @return string
     */
    public function key()
    {
        return $this->key;
    }
}
