<?php

namespace Iitenkida7\MicroCms;

use Carbon\CarbonImmutable as Carbon;
use Illuminate\Support\Collection;

class Convert
{
    public function get($input)
    {
        $input['contents'] = collect($input['contents'])->map(function ($content) {
            return $this->convertContent($content);
        })->all();

        return $input;
    }

    private function convertContent($content): Collection
    {
        $result = collect();

        foreach ($content as $key => $value) {
            if (is_array($value)) {
                $result->{$key} = $this->convertContent($value);
            } elseif (preg_match('!.*At$!', $key)) {
                $result->{$key} = $this->castTimestamp($value);
            } else {
                $result->{$key} = $value;
            }
        }

        return $result;
    }

    private function castTimestamp(string $timestamp): string
    {
        $timezone = config('app.timezone');
        return Carbon::parse($timestamp)->timezone($timezone);
    }
}
