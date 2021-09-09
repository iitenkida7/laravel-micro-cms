<?php

namespace Iitenkida7\MicroCms;

class MicroCms
{
    protected Convert $convert;

    protected Client $client;

    public function __construct(Client $client, Convert $convert)
    {
        $this->client = $client;
        $this->convert = $convert;
    }

    public function get(string $schema, BuildQuery $buildQuery)
    {
        // @todo:こんな感じで扱えるようにする。
        //$response = ($this->client->schema($schema)->get($buildQuery));

        $this->buildQuery = $buildQuery;
        $response = ($this->client->schema($schema)->get());

        return $this->convert->get($response);
    }
}
