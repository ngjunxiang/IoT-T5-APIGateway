<?php

namespace App\Http\Middleware;

use Exception;
use Closure;

class WhitelistMiddleware
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
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $callerIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $callerIP = $_SERVER['REMOTE_ADDR'];
        }

        // Only allow API calls from the below hosts
        if (in_array($callerIP, [env('DERRICK'), env('PI_HOST'), env('DASHBOARD_HOST')])) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
