<?php

namespace Froebel\Import;

use Froebel\Engine;
use Froebel\Import\Reader\Reader;

class Workflow
{
    public $engine;

    public $readers;

    public function __construct(Engine $engine, $readers)
    {
        $this->engine = $engine;
        $this->readers = $readers;
    }

    public function process()
    {
        foreach ($this->readers as $reader) {
            foreach ($reader->read() as $item) {
                $this->engine->index($item);
            }
        }
    }
}