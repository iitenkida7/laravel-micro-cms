<?php

namespace IItenkida7\MicroCms;

use Iitenkida7\MicroCms\MicroCms;
use Illuminate\Support\ServiceProvider;

class MicroCmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/micro-cms.php', 'micro-cms');
        $this->app->bind('micro-cms-client', function () {
            return new MicroCms();
        });
    }
}
