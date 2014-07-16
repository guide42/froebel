<?php

namespace Froebel\Import\Reader;

interface Reader extends \IteratorAggregate
{
    public function read();
}