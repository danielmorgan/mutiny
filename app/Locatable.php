<?php

namespace App;

trait Locatable
{
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * @return \App\Locatable
     */
    public function getLocatedInAttribute()
    {
        if (! $this->location->parent->isLocatable()) {
            return $this->location->parent;
        }

        return $this->location->parent->locatable;
    }


    /*
    |--------------------------------------------------------------------------
    | Observers
    |--------------------------------------------------------------------------
    */

    /**
     * When a new Locatable is created we create an associated Location. We
     * make it a child of another Location, based on the `locatedInside`
     * property. Locatables without it are children of the root node.
     */
    public static function bootLocatable()
    {
        static::created(function($locatable) {
            if (! is_null($locatable->locatedInside)) {
                $locatedInside = $locatable->locatedInside;
                $parent = Location::where([
                    ['locatable_type', get_class($locatable->$locatedInside)],
                    ['locatable_id', $locatable->$locatedInside->id],
                ])->first();
            } else {
                $parent = Location::find(1);
            }

            $locatable->location()->create([
                'name' => $locatable->name,
                'slug' => str_slug($locatable->name),
                'description' => $locatable->description,
                'image' => $locatable->image,
                'userCanEnter' => $locatable->userCanEnter,
                'shipCanEnter' => $locatable->shipCanEnter,
                'locatable_id' => $locatable->id,
                'locatable_type' => get_class($locatable),
                'parent_id' => $parent->id,
            ]);
        });
    }
}
