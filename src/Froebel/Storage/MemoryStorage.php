<?php

namespace Froebel\Storage;

class MemoryStorage implements Storage
{
    protected $buckets = array();

    public function set($name, $key, $data)
    {
        if (!array_key_exists($name, $this->buckets)) {
            $this->buckets[$name] = array();
        }

        if (!array_key_exists($key, $this->buckets[$name])) {
            $this->buckets[$name][$key] = array();
        }

        $this->buckets[$name][$key][] = $data;
    }

    public function get($name, $key)
    {
        if (isset($this->buckets[$name][$key])) {
            return $this->buckets[$name][$key];
        }

        return array();
    }
}