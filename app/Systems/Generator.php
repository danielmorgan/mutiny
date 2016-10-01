<?php

namespace App\Systems;

use Illuminate\Database\Eloquent\Model;
use App\Rooms\Room;

class Generator extends Model
{
    // Input ranges
    public $fuel_in_min = 0;
    public $fuel_in_max = 10;
    public $coolant_in_min = 0;
    public $coolant_in_max = 150;

    // Output ranges
    public $energy_out_min = 0;
    public $energy_out_max = 1000;
    public $temperature_min = 0;
    public $temperature_max = 1000;

    // Conversion rates
    public $fuel_to_energy_conversion_rate = 100;
    public $fuel_to_heat_conversion_rate = 200;
    public $coolant_to_heat_conversion_rate = -3;

    public function room() {
        $this->belongsTo(Room::class);
    }

    public function updatedOutputs()
    {
        $this->energy_out = $this->fuel_in * $this->fuel_to_energy_conversion_rate;
        $this->temperature = ($this->fuel_in * $this->fuel_to_heat_conversion_rate) +
                             ($this->coolant_in * $this->coolant_to_heat_conversion_rate);

        $this->energy_out = max($this->energy_out, $this->energy_out_min);
        $this->temperature = max($this->temperature, $this->temperature_min);

        $this->energy_out = min($this->energy_out, $this->energy_out_max);
        $this->temperature = min($this->temperature, $this->temperature_max);

        if ($this->temperature >= $this->temperature_max) {
            $this->energy_out = $this->energy_out_min;
        }

        return $this;
    }
}
