<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Validators\LoginValidator;


class ValidateProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function (
            $translator,
            $data,
            $rules,
            $messages
        ) {
            return new LoginValidator(
                $translator,
                $data,
                $rules,
                $messages
            );
        });
    }
}
