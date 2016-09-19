<?php

namespace App\Systems;

use Illuminate\Database\Eloquent\Model;
use App\Rooms\Room;

class Generator extends Model
{
    public $timestamps = false;

    public function room() {
        $this->belongsTo(Room::class);
    }
}
