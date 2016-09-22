<?php

namespace App\Systems;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Rooms\Room;

class Generator extends Model
{
    public $timestamps = false;

    public $fuel_in_min = 0;
    public $fuel_in_max = 10;
    public $coolant_in_min = 0;
    public $coolant_in_max = 150;
    public $fuel_conversion_rate = 100;
    public $coolant_conversion_rate = 3;

    public function room() {
        $this->belongsTo(Room::class);
    }

    public function updatedOutputs()
    {
        $targetEnergyOutput = $this->fuel_in * $this->fuel_conversion_rate;
        $coolingAmount = $this->coolant_in * $this->coolant_conversion_rate;

        $this->energy_out = $targetEnergyOutput;
        $this->temperature = $targetEnergyOutput - $coolingAmount;

        return $this;
    }
}
