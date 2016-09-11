<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Location extends Model
{
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
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getOccupantsAttribute()
    {
        return $this->children->transform(function($child) {
            return $child->locatable;
        });
    }

    public function getImageAttribute()
    {
        $locatableType = str_slug(class_basename($this->locatable_type));
        $filePath = "/img/locations/$locatableType.jpg";

        if (File::exists(public_path($filePath))) {
            return $filePath;
        }
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
