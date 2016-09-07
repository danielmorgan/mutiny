@if (Auth::check())
    <div class="row">
        <div class="col-xs-12">
            @foreach (Auth::user()->jobs as $job)
                <action-progress-bar :action="{{ json_encode($job->action) }}"></action-progress-bar>
            @endforeach
        </div>
    </div>
@endif
