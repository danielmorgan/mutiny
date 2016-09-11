<h3>Occupants</h3>
<ul>
    @foreach ($room->occupants as $user)
        <li>
            <a href="@if ($user->isYou()) {{ route('profile') }} @else {{ route('profile', ['user' => $user]) }} @endif">
                {{ $user->name }}</a>
            @if ($user->isYou()) <strong>(You)</strong> @endif</li>
        </a>
        </li>
    @endforeach
</ul>
