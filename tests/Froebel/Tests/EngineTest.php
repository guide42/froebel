<?php

use Froebel\Engine;
use Froebel\Hash\ObjectHash;
use Froebel\Storage\MemoryStorage;

class EngineTest extends PHPUnit_Framework_TestCase
{
    public function testIndexNotSupport()
    {
        $storage = $this->getMock('\Froebel\Storage\MemoryStorage', array('set'));
        $storage->expects($this->never())->method('set');

        $engine = new Engine(array(new ObjectHash('a')), $storage);
        $engine->index(42);
    }

    public function testIndex()
    {
        $data = new \stdClass();
        $data->answer = 42;

        $expected = spl_object_hash($data);

        $storage = $this->getMock('\Froebel\Storage\MemoryStorage', array('set'));
        $storage->expects($this->once())
                ->method('set')
                ->with($this->equalTo('a'), $this->equalTo($expected));

        $engine = new Engine(array(new ObjectHash('a')), $storage);
        $engine->index($data);
    }
}