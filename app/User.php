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

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
}
