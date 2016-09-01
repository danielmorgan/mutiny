<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ships\Ship;

class Location extends Model
{
    public $fillable = [
        'name', 'locatable_id', 'locatable_type', 'parent_id',
    ];

    public function locatable()
    {
        return $this->morphTo();
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(Location::class, 'id', 'parent_id');
    }

    public function newCollection(array $models = [])
    {
        return new LocatableCollection($models);
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

    public function isInstantiable()
    {
        return $this->locatable_type !== null && $this->locatable_id == null;
    }

    public function getNameAttribute($value)
    {
        if ($this->isLocatable()) {
            return $this->locatable->name;
        }

        return $value;
    }
}
