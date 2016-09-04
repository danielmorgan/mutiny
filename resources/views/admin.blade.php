@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Admin</div>

            <div class="panel-body">
                <p>
                    <button id="notifyEveryone" class="btn btn-danger">SPAM EVERYONE</button>
                </p>

                <h3>Ships</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Crew</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach (App\Ships\Ship::all() as $ship)
                        <tr>
                            <td>{{ $ship->name }}</td>
                            <td>{{ $ship->crew->count() }}</td>
                            <td>
                                <form action="{{ route('testshippa', ['ship' => $ship]) }}" method="POST">
                                    <button type="submit" class="btn btn-small btn-success">Test PA System</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h3>Users</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Wallet Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach (App\User::all() as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>@currency($user->balance)</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
