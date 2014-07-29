<?php

namespace Froebel\Storage;

class ElasticSearchStorage implements Storage
{
    protected $index;
    protected $client;

    public function __construct($index, \Elasticsearch\Client $client)
    {
        $this->index = $index;
        $this->client = $client;
    }

    public function set($name, $key, $data)
    {
        $this->client->index(array(
            'index' => $this->index,
            'type' => $name,
            'id' => $key,
            'body' => $data,
        ));
    }

    public function get($name, $key)
    {
        return $this->client->get(array(
            'index' => $this->index,
            'type' => $name,
            'id' => $key,
        ));
    }
}