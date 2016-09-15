<div class="room-sidebar">
    <ul class="list-group">
        @foreach (Auth::user()->ship->rooms as $room)
            <li class="room list-group-item
                @if (Auth::user()->isInRoom($room)) list-group-item-info @endif
                @if (Auth::user()->isMovingToRoom($room)) list-group-item-warning @endif
            ">
                @if (Auth::user()->isInRoom($room))

                    <a href="{{ route('location') }}">
                        <h4 class="name list-group-item-heading"><strong>{{ $room }}</strong></h4>
                    </a>

                    <p class="list-group-item-text">(You are here)</p>

                @elseif (Auth::user()->isMovingToRoom($room))

                    <h4 class="name list-group-item-heading"><strong>{{ Auth::user()->targetRoom }}</strong></h4>

                    <form action="{{ route('move.user.cancel') }}" method="POST" class="cancel-move">
                        <button type="submit" class="btn btn-sm btn-warning">
                            Cancel move
                        </button>
                    </form>

                @else

                    <h4 class="name list-group-item-heading"><strong>{{ $room }}</strong></h4>

                    <form action="{{ route('move.user.location', ['location' => $room->location]) }}" method="POST" class="move">
                        <button type="submit" class="btn btn-sm btn-success">
                            Move to - <i class="fa fa-clock-o"></i> 10s
                        </button>
                    </form>

                @endif
            </li>
        @endforeach
    </ul>
</div>
