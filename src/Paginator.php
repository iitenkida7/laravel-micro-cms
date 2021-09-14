<?php

namespace Iitenkida7\MicroCms;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Paginator
{
    public function paginate(Collection $response, $currentPage): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $response['contents'],
            $response['totalCount'],
            $response['limit'],
            $currentPage,
        );
    }

    public function getOffsetOrFail(int $limit, int $currentPage): int
    {
        if ($currentPage > 0) {
            return ($currentPage - 1) * $limit;
        } elseif ($currentPage) {
            abort(404);
        }

        return 0;
    }
}
