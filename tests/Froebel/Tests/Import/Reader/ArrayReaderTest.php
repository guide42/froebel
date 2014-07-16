<?php

use Froebel\Import\Reader\ArrayReader;

class ArrayReaderTest extends PHPUnit_Framework_TestCase
{
    public function testGetIterator()
    {
        $reader = new ArrayReader(array(1, 2, 3));
        $iterator = $reader->getIterator();

        $this->assertInstanceOf('\ArrayIterator', $iterator);
    }

    public function testReadIterator()
    {
        $reader = new ArrayReader(array(1, 2, 3));
        $iterator = $reader->read();

        $this->assertInstanceOf('\Iterator', $iterator);
    }

    public function testReadCount()
    {
        $reader = new ArrayReader(array(1, 2, 3));
        $iterator = $reader->read();

        $this->assertCount(3, $iterator);
    }
}