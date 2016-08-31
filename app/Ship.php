<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use Locatable;

    protected $fillable = ['name'];
}
