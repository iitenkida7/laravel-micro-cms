<?php
namespace Iitenkida7\MicroCms\Facade;

use Illuminate\Support\Facades\Facade;

class MicroCms extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'micro-cms-client';
    }
}
