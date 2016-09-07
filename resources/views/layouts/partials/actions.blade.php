@foreach (Auth::user()->jobs as $job)
    {{ dump($job->action) }}
@endforeach
