<?php

namespace App\Providers;

use App\User;
use App\UserObserver;
use Auth;
use Blade;
use Validator;
use Illuminate\Support\ServiceProvider;
use DB;
use Log;

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
            $right = User::where($parameters[0], $value)->first();
            return $left->id !== $right->id;
        });

        Blade::directive('currency', function($expression) {
            return "<?php echo currency($expression); ?>";
        });

        DB::listen(function($query) {
            Log::info($query->sql, $query->bindings);
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
