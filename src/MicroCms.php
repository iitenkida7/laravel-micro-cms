<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MicroCms
{
    protected Convert $convert;

    protected Client $client;

    protected Paginator $paginator;

    public function __construct()
    {
        $this->client = new Client();
        $this->convert = new Convert();
        $this->paginator = new Paginator();
    }

    public function get(string $schema, QueryBuilder $queryBuilder): Collection
    {
        $response = $this->client->schema($schema)->get($queryBuilder);
        return $this->convert->get($response);
    }

    public function getWithPaginate(string $schema, QueryBuilder $queryBuilder): LengthAwarePaginator
    {
        $currentPage = request()->page ?: 1;

        if (!is_numeric($currentPage)) {
            abort(404);
        }

        if (!isset($queryBuilder->limit)) {
            $queryBuilder->limit = 15; //default
        }
        $queryBuilder->offset = $this->paginator->getOffsetOrFail($queryBuilder->limit, $currentPage);

        $response = $this->get($schema, $queryBuilder);

        if (!$response['contents']) {
            abort(404);
        }

        return $this->paginator->paginate($response, $currentPage);
    }
}
