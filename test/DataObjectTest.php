<?php

namespace Niddit\Google\Maps\Test;

use Niddit\Google\Maps\DataObject;
use ReflectionClass;

class DataObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatedFromDataArray()
    {
        $dataObject = new DataObject([
            'foo' => 'bar',
        ]);

        $class = new ReflectionClass($dataObject);
        $data = $class->getProperty('data');
        $data->setAccessible(true);

        $this->assertEquals(['foo' => 'bar'], $data->getValue($dataObject));
    }

    public function testDynamicGetterReturnsDataValue()
    {
        $dataObject = new DataObject([
            'foo' => 'bar',
        ]);

        $this->assertEquals('bar', $dataObject->foo);
    }

    public function testDynamicGetterReturnsNullOnUnknownValue()
    {
        $dataObject = new DataObject([
            'foo' => 'bar',
        ]);

        $this->assertNull($dataObject->unknown);
    }
}
