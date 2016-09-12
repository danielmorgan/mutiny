<div class="room-sidebar">
    <h3>Parent Location</h3>
    <ul class="list-group">
        @include('locations.partials.location', ['location' => Auth::user()->location->parent->parent])
    </ul>

    <h3>Sibling Locations</h3>
    <ul class="list-group">
        @foreach (Auth::user()->location->parent->siblings as $location)
            @include('locations.partials.location', ['location' => $location])
        @endforeach
    </ul>

    <h3>Child Locations</h3>
    <ul class="list-group">
        @foreach (Auth::user()->location->parent->children as $location)
            @include('locations.partials.location', ['location' => $location])
        @endforeach
    </ul>
</div>
