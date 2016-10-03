@include('locations.partials.room-occupants', ['room' => $engineeringroom])

<hr>

<h3>Computers</h3>

<generator :fuel_in="{{ $engineeringroom->generator->fuel_in }}"
           :fuel_in_min="{{ $engineeringroom->generator->fuel_in_min }}"
           :fuel_in_max="{{ $engineeringroom->generator->fuel_in_max }}"
           :coolant_in="{{ $engineeringroom->generator->coolant_in }}"
           :coolant_in_min="{{ $engineeringroom->generator->coolant_in_min }}"
           :coolant_in_max="{{ $engineeringroom->generator->coolant_in_max }}"
           :energy_out="{{ $engineeringroom->generator->energy_out }}"
           :temperature="{{ $engineeringroom->generator->temperature }}">
</generator>
