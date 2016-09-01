<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;
use App\Wallet\HasWallet;
use App\Locatable;
use App\Location;
use App\Ships\Ship;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasPushSubscriptions, HasWallet, Locatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Eloquent observers.
     */
    public static function boot()
    {
        static::created(function($user) {
            // Set the default balance
            $user->balance = 6000;

            // Place the user on a ship crew
            $user->ship()->associate(Ship::first());

            /**
             * Put the new user in the first Room of this ship.
             *
             * @todo Refactor. This is happening on Locatable but this boot() function is preventing that from running.
             */
            $location = new Location([
                'locatable_id' => $user->id,
                'locatable_type' => User::class,
                'parent_id' => $user->ship->rooms()->first()->location->id,
            ]);

            $user->location()->save($location);
            $user->save();
        });
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ship_id');
    }
}
