<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;
use App\Locatable;
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
     * The default Location type for a new Locatable.
     * Must match a belongsTo relationship.
     * If null, the default Location will be the root node.
     *
     * @var string|null
     */
    public $locatedInside = null;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return str_slug($this->getAttribute($this->getRouteKeyName()));
    }


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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
