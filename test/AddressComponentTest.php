<?php

namespace Niddit\Google\Maps\Test;

use Niddit\Google\Maps\Address\AddressComponent;

class AddressComponentTest extends \PHPUnit_Framework_TestCase
{
    protected function addressComponent()
    {
        return $addressComponent = new AddressComponent('foo', 'bar', ['baz']);
    }

    public function testGetLongName()
    {
        $addressComponent = $this->addressComponent();

        $this->assertEquals('foo', $addressComponent->getLongName());
    }

    public function testGetShortName()
    {
        $addressComponent = $this->addressComponent();

        $this->assertEquals('bar', $addressComponent->getShortName());
    }

    public function testGetTypes()
    {
        $addressComponent = $this->addressComponent();

        $this->assertEquals(['baz'], $addressComponent->getTypes());
    }

    public function testIsType()
    {
        $addressComponent = $this->addressComponent();

        $this->assertTrue($addressComponent->isType('baz'));
        $this->assertFalse($addressComponent->isType('bar'));
    }
}
