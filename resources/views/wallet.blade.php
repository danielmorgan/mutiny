@extends('layouts.app')

@section('content')
    {{--Wallet--}}
    <div class="row">
        <div class="col-xs-12">
            @include('interfaces.wallet')
        </div>
    </div>
@endsection
