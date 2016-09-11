<div class="room-sidebar">
    <ul class="list-group">
        @foreach (Auth::user()->ship->rooms as $room)
            <li class="room list-group-item @if (Auth::user()->isInRoom($room)) list-group-item-info @endif">
                @if (Auth::user()->isInRoom($room))
                    <a href="{{ route('location') }}">
                        <h4 class="name list-group-item-heading"><strong>{{ $room }}</strong></h4>
                    </a>

                    <p class="list-group-item-text">(You are here)</p>
                @else
                    <h4 class="name list-group-item-heading"><strong>{{ $room }}</strong></h4>

                    <form action="{{ route('move.user.room', ['room' => $room]) }}" method="POST" class="move">
                        <button type="submit" class="btn btn-sm btn-success">
                            Move to - <i class="fa fa-clock-o"></i> 2m
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</div>
