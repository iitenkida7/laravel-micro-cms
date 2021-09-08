<?php

namespace Iitenkida7\MicroCMS;

class MicroCMS
{
    protected BuildQuery $buildQuery;

    protected Convert $convert;

    protected Client $client;

    public function __construct(BuildQuery $buildQuery, Client $client, Convert $convert)
    {
        $this->client = $client;
        $this->buildQuery = $buildQuery;
        $this->convert = $convert;
    }

    public function demo()
    {
        $this->buildQuery->limit = 1;
        $this->buildQuery->orders = '-updatedAt';
        $result = ($this->client->schema('news')->get());

        dd($this->convert->get($result));
    }
}
