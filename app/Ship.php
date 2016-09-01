<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use Locatable;

    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'parent_id');
    }
}
