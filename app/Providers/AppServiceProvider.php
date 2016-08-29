<?php

namespace App\Providers;

use App\User;
use Auth;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('notSelf', function($attribute, $value, $parameters, $validator) {
            $left = Auth::user();
            $right = User::where($parameters[0], $value)
                ->first();

            return $left->id !== $right->id;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
