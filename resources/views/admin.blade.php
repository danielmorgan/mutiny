@extends('layouts.app')

@section('content')
<div class="container">

    {{--Admin--}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>

                <div class="panel-body text-center">
                    <notifications inline-template>
                        <button id="notifyEveryone">SPAM</button>
                    </notifications>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
