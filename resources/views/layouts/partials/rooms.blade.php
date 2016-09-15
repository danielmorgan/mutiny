<div class="room-sidebar">
    <ul class="list-group">
        @foreach (Auth::user()->ship->rooms as $room)
            @include('layouts.partials.move-location', ['location' => $room->location])
        @endforeach
    </ul>
</div>
