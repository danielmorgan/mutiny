@extends('layouts.app')

@section('content')
<div class="container">

    {{--Map--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">
                    @include('locations.list', ['colleciton' => $locations['root']])
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
