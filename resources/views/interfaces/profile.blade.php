<div class="panel panel-default panel-wallet">
    <div class="panel-heading">Me</div>

    <div class="panel-body">
        <h2>{{ $user->name }}</h2>
        <dl class="dl-horizontal">
            @foreach($user->toArray() as $key => $value)
                <dt>{{ $key }}</dt>
                <dd>{{ $value }}</dd>
            @endforeach
        </dl>

        <hr>

        <h3>Current Location</h3>
        <p>
            <a href="{{ route('ship') }}">{{ $user->ship->name }}</a>
            @if ($user->room)
                &rarr; {{ dump($user->room) }}
            @endif
        </p>
    </div>
</div>
