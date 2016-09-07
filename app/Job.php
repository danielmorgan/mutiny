<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function getActionAttribute()
    {
        return unserialize(json_decode($this->payload)->data->command);
    }

    public function getClassAttribute()
    {
        return json_decode($this->payload)->data->commandName;
    }
}
