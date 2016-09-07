@if (Session::has('success'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success alert-dismissible" aria-label="Close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Session::get('success') !!}
            </div>
        </div>
    </div>
@endif

@if (Session::has('info'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info alert-dismissible" aria-label="Close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Session::get('info') !!}
            </div>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-warning alert-dismissible" aria-label="Close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Session::get('warning') !!}
            </div>
        </div>
    </div>
@endif

@if (Session::has('danger'))
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissible" aria-label="Close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Session::get('danger') !!}
            </div>
        </div>
    </div>
@endif
