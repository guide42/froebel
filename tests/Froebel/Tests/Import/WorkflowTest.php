<?php

use Froebel\Engine;
use Froebel\Hash\ObjectHash;
use Froebel\Storage\MemoryStorage;
use Froebel\Import\Workflow;
use Froebel\Import\Reader\ArrayReader;

class WorkflowTest extends PHPUnit_Framework_TestCase
{
    public function testProcess()
    {
        $data = new \stdClass();
        $data->answer = 42;
        $hash = spl_object_hash($data);

        $storage = new MemoryStorage();
        $engine = new Engine(array(new ObjectHash('a')), $storage);

        $workflow = new Workflow($engine, array(new ArrayReader(array($data))));
        $workflow->process();

        $this->assertSame(array($data), $storage->get('a', $hash));
    }
}