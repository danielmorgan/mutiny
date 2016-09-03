<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;
use App\Wallet\HasWallet;
use App\Locatable;
use App\Ships\Ship;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasPushSubscriptions, HasWallet, Locatable;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The default Location type for a new Locatable. Must match a belongsTo
     * relationship. If null, the default Location will be the root node.
     *
     * @var string|null
     */
    public $locatedInside = 'ship';


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ship_id');
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        /**
         * @todo Refactor. This should already happen on Locatable but the boot() function here is preventing that from running.
         */
        static::created(function($user) {
            // Set the default balance
            $user->balance = 6000;

            // Place the user on a ship crew
            $user->ship()->associate(Ship::first());

            // Put the new user in the first Room of this ship
            $user->location()->create([
                'locatable_id' => $user->id,
                'locatable_type' => User::class,
                'parent_id' => $user->ship->rooms()->first()->location->id,
            ]);

            $user->save();
        });
    }
}
