<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Client
{
    protected PendingRequest $http;

    protected string $endpoint;

    protected string $apiKey;

    protected array $conditions;

    protected string $schema;

    protected QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->endpoint = config('micro-cms.api_endpoint');
        $this->apiKey = config('micro-cms.api_key');
        $this->http = Http::withHeaders(['X-API-KEY' => $this->apiKey]);
    }

    public function schema(string $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->http = $this->http->timeout($timeout);
        return $this;
    }

    public function get(QueryBuilder $queryBuilder): Collection
    {
        $query = http_build_query($queryBuilder->getConditions());

        return $this->http->get($this->endpoint . $this->schema . '?' . $query)->collect();
    }
}
