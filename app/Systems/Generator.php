<?php

namespace App\Systems;

use Illuminate\Database\Eloquent\Model;
use App\Rooms\Room;

class Generator extends Model
{
    public $timestamps = false;

    public $fuel_in_min = 0;
    public $fuel_in_max = 10;
    public $coolant_in_min = 0;
    public $coolant_in_max = 50;

    public function room() {
        $this->belongsTo(Room::class);
    }
}
