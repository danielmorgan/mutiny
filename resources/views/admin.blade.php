@extends('layouts.app')

@section('content')
<div class="container">

    {{--Admin--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>

                <div class="panel-body">
                    <p>
                        <button id="notifyEveryone" class="btn btn-danger">SPAM EVERYONE</button>
                    </p>

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

</div>
@endsection
