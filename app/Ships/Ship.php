<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
use App\Location;
use App\User;
use App\Rooms\Room;

class Ship extends Model
{
    use Locatable;

    /**
     * @var array
     */
    protected $fillable = ['name'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crew()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return mixed
     */
    public function rooms()
    {
        return $this->hasManyThrough(Room::class, Location::class, 'parent_id');
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    static public function boot()
    {
        static::created(function($ship) {
            // Put the new ship the 'Universe' root Location
            $ship->location()->create([
                'locatable_id' => $ship->id,
                'locatable_type' => Ship::class,
                'parent_id' => 1,
            ]);
        });
    }
}
