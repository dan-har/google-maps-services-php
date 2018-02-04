<?php

namespace Niddit\Google\Maps\Test;

use Niddit\Google\Maps\Auth;

class AuthTest extends \PHPUnit_Framework_TestCase
{
    public function testFromKey()
    {
        $key = 'example_key';

        $auth = Auth::fromKey($key);

        $this->assertInstanceOf(Auth::class, $auth);
    }

    public function testThrowsInvalidArgumentIfKeylengthIsZero()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        new Auth('');
    }

    public function testGetKey()
    {
        $key = 'example_key';

        $auth = new Auth($key);

        $this->assertEquals($key, $auth->key());
    }
}
