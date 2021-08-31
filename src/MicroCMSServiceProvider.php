<?php
namespace IItenkida7\MicroCMS;

use Iitenkida7\MicroCMS\MicroCMS;
use Illuminate\Support\ServiceProvider;

class MicroCMSServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/micro-cms.php', 'micro-cms');
        $this->app->bind('micro-cms-client', function () {
            return new MicroCMS();
        });
    }

}
