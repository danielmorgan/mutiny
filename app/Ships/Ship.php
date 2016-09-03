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

    /**
     * The default Location type for a new Locatable. Must match a belongsTo
     * relationship. If null, the default Location will be the root node.
     *
     * @var string|null
     */
    public $locatedInside = null;


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
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
