<?php

use Froebel\Hash\ObjectHash;

class ObjectHashTest extends PHPUnit_Framework_TestCase
{
    public function testSupports()
    {
        $hash = new ObjectHash('test');

        $this->assertFalse($hash->supports(array()));
        $this->assertFalse($hash->supports('sun'));
        $this->assertFalse($hash->supports(123));

        $this->assertTrue($hash->supports(new stdClass()));
    }

    public function testTokenize()
    {
        $hash = new ObjectHash('test');
        $obj = new stdClass();

        $this->assertSame(array(spl_object_hash($obj)), $hash->tokenize($obj));
    }
}