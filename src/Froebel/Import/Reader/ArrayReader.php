<?php

namespace Froebel\Import\Reader;

class ArrayReader implements Reader
{
    protected $data;

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function read()
    {
        foreach ($this->data as $item) {
            yield $item;
        }
    }
}