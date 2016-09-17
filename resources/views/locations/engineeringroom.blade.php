<h3>Computers</h3>

<div class="generator">
    <h4>Generator</h4>
    {{ $engineeringroom->generateEnergy() }}
</div>

<hr>

@include('locations.partials.room-occupants', ['room' => $engineeringroom])
