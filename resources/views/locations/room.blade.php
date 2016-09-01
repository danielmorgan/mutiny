<h4>{{ $room->name }}</h4>
<ul>
    @foreach ($room->occupants as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>
