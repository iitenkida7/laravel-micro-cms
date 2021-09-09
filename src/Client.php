<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client
{
    protected PendingRequest $http;

    protected string $endpoint;

    protected string $apiKey;

    protected array $conditions;

    protected string $schema;

    protected BuildQuery $buildQuery;

    public function __construct(BuildQuery $buildQuery)
    {
        $this->endpoint = config('micro-cms.api_endpoint');
        $this->apiKey = config('micro-cms.api_key');
        $this->http = Http::withHeaders(['X-API-KEY' => $this->apiKey]);
        $this->buildQuery = $buildQuery;
    }

    public function schema(string $schema)
    {
        $this->schema = $schema;
        return $this;
    }

    public function setTimeout(int $timeout)
    {
        $this->http = $this->http->timeout($timeout);
    }

    public function get()
    {
        $query = http_build_query($this->buildQuery->getConditions());

        $response = $this->http->get($this->endpoint . $this->schema . '?' . $query)->collect();

        return $response;
    }
}
