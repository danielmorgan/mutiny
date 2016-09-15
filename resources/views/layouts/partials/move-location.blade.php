<li class="location list-group-item
    @if (Auth::user()->isInLocation($location)) list-group-item-info @endif
    @if (Auth::user()->isMovingToLocation($location)) list-group-item-warning @endif
">

    <div class="name list-group-item-heading"><strong>{{ $location->type }}:</strong> {{ $location }}</div>

    @if (Auth::user()->isInLocation($location))
        <p class="list-group-item-text">(You are here)</p>
    @elseif (Auth::user()->isMovingToLocation($location))
        <form action="{{ route('move.user.cancel') }}" method="POST" class="cancel-move">
            <button type="submit" class="btn btn-sm btn-warning">
                Cancel move
            </button>
        </form>
    @else
        @if (Auth::user()->canReach($location))
            <form action="{{ route('move.user.location', ['location' => $location]) }}" method="POST" class="move">
                <button type="submit" class="btn btn-sm btn-success">
                    Move to
                </button>
            </form>
        @endif
    @endif

</li>
