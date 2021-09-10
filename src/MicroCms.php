<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


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
        // @todo: has bugs
        $queryBuilder->limit = 1;
        $queryBuilder->offset = $this->getOffsetOrFail($queryBuilder->limit);

        $response = $this->get($schema, $queryBuilder);

        $paginator = new LengthAwarePaginator(
            $response['contents'],
            $response['totalCount'],
            $response['limit'],
            $response['offset'],
        );

        return $paginator;
    }

    private function getOffsetOrFail(int $limit): int
    {
        if (is_numeric(request()->page) && request()->page > 0) {
            return (request()->page - 1) * $limit;
        } elseif (request()->page) {
            abort(404);
        } else {
            return 0;
        }
    }


}
