<?php

use Froebel\Storage\MemoryStorage;

class MemoryStorageTest extends PHPUnit_Framework_TestCase
{
    public function testSetGet()
    {
        $storage = new MemoryStorage();
        $storage->set('person', '1', 'Juan M');

        $this->assertSame(array('Juan M'), $storage->get('person', '1'));
    }
}