<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function locatable()
    {
        return $this->morphTo();
    }
}
