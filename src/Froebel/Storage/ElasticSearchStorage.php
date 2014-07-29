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
        $params = array('index' => $this->index, 'type' => $name, 'id' => $key);
        $params = array_merge($params, $data);

        $this->client->index($params);
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