<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\UserObserver;
use App\Ships\Ship;
use App\Ships\ShipObserver;
use App\Ships\Resource;
use App\Ships\ResourceObserver;
use Auth;
use Blade;
use DB;
use Log;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        Ship::observe(ShipObserver::class);

        Resource::observe(ResourceObserver::class);

        Validator::extend('notSelf', function($attribute, $value, $parameters, $validator) {
            $left = Auth::user();
            $right = User::where($parameters[0], $value)->first();
            return $left->id !== $right->id;
        });

        Blade::directive('currency', function($expression) {
            return "<?php echo currency($expression); ?>";
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
