@if (! $errors->flash->isEmpty())
    <div class="row">
        <div class="col-xs-12">
            @foreach ($errors->flash->all() as $error)
                <div class="alert alert-danger">{!! $error !!}</div>
            @endforeach
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success">{!! Session::get('success') !!}</div>
        </div>
    </div>
@endif

@if (Session::has('info'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info">{!! Session::get('info') !!}</div>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-warning">{!! Session::get('warning') !!}</div>
        </div>
    </div>
@endif

@if (Session::has('danger'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger">{!! Session::get('danger') !!}</div>
        </div>
    </div>
@endif
