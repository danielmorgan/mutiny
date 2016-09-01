<h4>{{ $room->name }}</h4>
<form action="/move/{{ $room->location->id }}" method="POST">
    <button type="submit" class="btn btn-sm btn-success">Move to</button>
</form>
<ul>
    @foreach ($room->occupants as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>
