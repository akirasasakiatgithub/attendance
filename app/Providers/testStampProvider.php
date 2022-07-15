<?php

namespace App\Providers;

use App\Jobs\testStamp;
use Illuminate\Support\ServiceProvider;

class testStampProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindMethod([testStamp::class, 'handle'], function($job, $app) {
            return $job->handle();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
