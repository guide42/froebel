<?php

namespace Froebel;

use Froebel\Hash\Hash;
use Froebel\Storage\Storage;

class Engine
{
    protected $hashes;

    protected $storage;

    public function __construct($hashes, Storage $storage)
    {
        $this->hashes = $hashes;
        $this->storage = $storage;
    }

    public function index($data)
    {
        foreach ($this->hashes as $hash) {
            if (!$hash->supports($data)) {
                continue;
            }

            $keys = $hash->tokenize($data);

            foreach ($keys as $key) {
                $this->storage->set($hash->name, $key, $data);
            }
        }
    }
}