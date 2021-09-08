<?php

namespace Iitenkida7\MicroCMS;

class BuildQuery
{
    protected array $conditions;

    // conditions
    public string $draftKey;

    public int $limit;

    public int $offset;

    public string $orders;

    public string $q;

    public string $fields;

    public string $ids;

    public string $filters;

    public int $depth;

    // additional option parameter
    public array $options;

    public function getConditions(): array
    {
        $this->mergeCondition();
        return $this->conditions;
    }

    private function mergeCondition(): self
    {
        $conditions = [];

        if (isset($this->draftKey)) {
            $conditions['draftKey'] = $this->draftKey;
        }

        if (isset($this->limit)) {
            $conditions['limit'] = $this->limit;
        }

        if (isset($this->offset)) {
            $conditions['offset'] = $this->offset;
        }

        if (isset($this->orders)) {
            $conditions['orders'] = $this->orders;
        }

        if (isset($this->q)) {
            $conditions['q'] = $this->q;
        }

        if (isset($this->fields)) {
            $conditions['fields'] = $this->fields;
        }

        if (isset($this->ids)) {
            $conditions['ids'] = $this->ids;
        }

        if (isset($this->depth)) {
            $conditions['depth'] = $this->depth;
        }

        // additional
        if (isset($this->options)) {
            $conditions = $conditions + $this->options;
        }

        $this->conditions = $conditions;

        return $this;
    }
}
