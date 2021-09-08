<?php

namespace Iitenkida7\MicroCMS;

use Carbon\CarbonImmutable as Carbon;

class Convert
{
    public function get($input)
    {
        $input['contents'] = collect($input['contents'])->map(function ($content) {
            return $this->convertContent($content);
        })->all();

        return $input;
    }

    private function convertContent($content): object
    {
        $result = collect();

        foreach ($content as $key => $value) {
            if (preg_match('!.*At$!', $key)) {
                $result->{$key} = $this->castTimestamp($value);
            } else {
                $result->{$key} = $value;
            }
        }
        return $result;
    }

    private function castTimestamp(string $timestamp): string
    {
        return Carbon::parse($timestamp)->timezone('Asia/Tokyo');
    }
}
