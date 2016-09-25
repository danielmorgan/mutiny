<?php

namespace App\Ships;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $timestamps = false;

    public static $types = ['hull', 'armor', 'propellant', 'fuel', 'coolant', 'energy'];
}
