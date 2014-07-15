<?php

namespace Froebel\Storage;

interface Storage
{
    public function set($name, $key, $data);

    public function get($name, $key);
}