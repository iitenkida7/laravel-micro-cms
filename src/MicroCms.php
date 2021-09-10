<?php

namespace Iitenkida7\MicroCms;

class MicroCms
{
    protected Convert $convert;

    protected Client $client;

    protected QueryBuilder $queryBuilder;

    public function __construct(Client $client, Convert $convert)
    {
        $this->client = $client;
        $this->convert = $convert;
    }

    public function get(string $schema, QueryBuilder $queryBuilder)
    {
        // @todo:こんな感じで扱えるようにする。
        //$response = ($this->client->schema($schema)->get($buildQuery));

        $this->queryBuilder = $queryBuilder;
        $response = ($this->client->schema($schema)->get());

        return $this->convert->get($response);
    }
}
