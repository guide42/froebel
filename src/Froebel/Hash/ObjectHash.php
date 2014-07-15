<?php

namespace Froebel\Hash;

class ObjectHash implements Hash
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function supports($data)
    {
        return is_object($data);
    }

    public function tokenize($data)
    {
        return array(spl_object_hash($data));
    }
}