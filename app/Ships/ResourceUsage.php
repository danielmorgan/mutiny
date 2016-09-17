<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;

class ResourceUsage extends Model
{
    public $timestamps = false;

    public $fillable = ['hull', 'armor', 'propellant', 'fuel', 'energy'];
}
