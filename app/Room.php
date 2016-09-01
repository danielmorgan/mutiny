<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use Locatable;

    protected $fillable = ['name'];

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'id', 'parent_id');
    }
}
