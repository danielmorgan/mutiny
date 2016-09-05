<div class="row">
    <div class="col-xs-12">
            <ul class="list-group">
                @if (Auth::check())
                    <li class="list-group-item">
                        <a href="{{ route('location') }}">
                            Location
                            (<em>{{ Auth::user()->location->parent }}</em>)
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('ship') }}">Ship</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('wallet') }}">Wallet</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('settings') }}">Settings</a>
                    </li>
                @else
                    <li class="list-group-item">
                        <a href="{{ url('login') }}">Login</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('register') }}">Register</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('password/reset') }}">Forgot Password</a>
                    </li>
                @endif
            </ul>
    </div>
</div>
