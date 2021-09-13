<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Pagination\LengthAwarePaginator;
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

    public function getWithPaginate(string $schema, QueryBuilder $queryBuilder): LengthAwarePaginator
    {
        $currentPage = (int) request()->page;

        $queryBuilder->limit = 2;
        $queryBuilder->offset = $this->getOffsetOrFail($queryBuilder->limit, $currentPage);

        $response = $this->get($schema, $queryBuilder);

        return new LengthAwarePaginator(
            $response['contents'],
            $response['totalCount'],
            $response['limit'],
            $currentPage,
        );
    }

    private function getOffsetOrFail(int $limit, int $currentPage): int
    {
        if ($currentPage > 0) {
            return ($currentPage - 1) * $limit;
        } elseif ($currentPage) {
            abort(404);
        }

        return 0;
    }
}
