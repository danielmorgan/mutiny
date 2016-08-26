<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use JavaScript;

class InjectJavaScriptVariables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        JavaScript::put([
            'USER' => Auth::user(),
            'PUSHER_OPTIONS' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]);
        
        return $next($request);
    }
}
