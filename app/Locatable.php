<?php

namespace App;

trait Locatable
{
    /**
     * Eloquent observers.
     */
    public static function bootLocatable()
    {
        static::created(function($locatable) {
            $locatable->location()->create([
                'locatable_id' => $locatable->id,
                'locatable_type' => get_class($locatable),
                'parent_id' => Location::where('locatable_id', $locatable->parent_id)->firstOrFail()->id,
            ]);
        });
    }

    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    /**
     * Set an accessor that returns a collection of Locatable entities.
     *
     * @return \App\Locatable
     */
    public function getOccupantsAttribute()
    {
        return $this->location->children()->with('locatable')->get()->transform(function($child) {
            return $child->locatable;
        });
    }

    public function getLocatedInAttribute()
    {
        if (! $this->location->parent->isLocatable()) {
            return $this->location->parent;
        }

        return $this->location->parent->locatable;
    }
}
