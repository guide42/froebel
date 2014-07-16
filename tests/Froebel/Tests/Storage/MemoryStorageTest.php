<?php

use Froebel\Storage\MemoryStorage;

class MemoryStorageTest extends PHPUnit_Framework_TestCase
{
    public function testSet()
    {
        $storage = new MemoryStorage();
        $storage->set('person', '1', 'Juan M');

        $this->assertSame(array('Juan M'), $storage->get('person', '1'));
    }

    public function testGetEmpty()
    {
        $storage = new MemoryStorage();
        $storage->set('car', 'fiat-strada', array('brand' => 'Fiat', 'model' => 'Strada'));

        $this->assertSame(array(), $storage->get('person', '1'));
    }
}