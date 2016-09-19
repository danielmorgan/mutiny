<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Auth;

class Location extends Model
{
    public $timestamps = false;

    public $fillable = [
        'name', 'locatable_id', 'locatable_type', 'parent_id',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

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

    public function siblings()
    {
        return $this->hasMany(Location::class, 'parent_id', 'parent_id');
    }

    // Not a real relationship, can't be accessed as a property
    public function enterableByUser()
    {
        return collect()
            ->merge($this->parent()->userCanEnter()->get())
            ->merge($this->siblings()->userCanEnter()->get())
            ->merge($this->children()->userCanEnter()->get());
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeUserCanEnter($query)
    {
        if (Auth::check()) {
            // A User can't enter their current location
            $query = $query->where('id', '!=', Auth::user()->location->parent->id);
        }

        return $query->where('userCanEnter', true);
    }


    /*
    |--------------------------------------------------------------------------
    | Override default Model methods
    |--------------------------------------------------------------------------
    */

    public function newCollection(array $models = [])
    {
        return new LocatableCollection($models);
    }


    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = str_slug($this->name);
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getOccupantsAttribute()
    {
        return $this->children->transform(function($child) {
            return $child->locatable;
        });
    }

    public function getClassAttribute()
    {
        if ($this->isLocatable()) {
            return class_basename($this->locatable);
        }

        return class_basename($this);
    }

    public function getTypeAttribute()
    {
        return $this->locatable->locationType ? $this->locatable->locationType : $this->locatable_type;
    }


    /*
    |--------------------------------------------------------------------------
    | Domain specific methods
    |--------------------------------------------------------------------------
    */

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

    public function __toString()
    {
        if ($this->isLocatable()) {
            return (string) $this->locatable;
        }

        return $this->name;
    }
}
