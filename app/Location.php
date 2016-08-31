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
}
