<div class="room">
    <h4 class="name">{{ $room->type }}</h4>
    <form action="{{ route('move.user.room', ['room' => $room]) }}" method="POST" class="move">
        <button type="submit" class="btn btn-sm btn-success">Move to</button>
    </form>
    <ul>
        @foreach ($room->occupants as $user)
            @if ($user->id === Auth::id())
                <li>{{ $user->name }} <strong>(You)</strong></li>
            @else
                <li>{{ $user->name }}</li>
            @endif
        @endforeach
    </ul>
</div>
