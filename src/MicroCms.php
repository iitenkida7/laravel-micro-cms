<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Support\Collection;

class MicroCms
{
    protected Convert $convert;

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->convert = new Convert();
    }

    public function get(string $schema, QueryBuilder $queryBuilder): Collection
    {
        $response = $this->client->schema($schema)->get($queryBuilder);
        return $this->convert->get($response);
    }
}
