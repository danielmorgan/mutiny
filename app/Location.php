<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ships\Ship;

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
        $locationType = str_slug(class_basename($this->locatable_type));

        return "/img/locations/$locationType.jpg";
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
