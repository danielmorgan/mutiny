<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function locatable()
    {
        return $this->morphTo();
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function newCollection(array $models = [])
    {
        return new LocationCollection($models);
    }

    /**
     * Set an accessor that returns a collection of Locatable entities.
     *
     * @return \App\Locatable
     */
    public function getOccupantsAttribute()
    {
        return $this->children->transform(function($child) {
            return $child->locatable;
        });
    }

    static public function root()
    {
        return static::where('parent_id', null)->firstOrFail();
    }

    public function isLocatable()
    {
        return ! is_null($this->locatable);
    }

    static public function getTree(Location $location = null)
    {
        if (is_null($location)) {
            $location = Location::root();
        }

        return $location->children()->get()->threaded();
    }
}
