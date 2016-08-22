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
            'user' => Auth::user(),
        ]);
        
        return $next($request);
    }
}
