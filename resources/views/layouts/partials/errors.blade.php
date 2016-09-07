@if (! $errors->flash->isEmpty())
    <div class="row">
        <div class="col-xs-12">
            @foreach ($errors->flash->all() as $error)
                <div class="alert alert-danger">{!! $error !!}</div>
            @endforeach
        </div>
    </div>
@endif
