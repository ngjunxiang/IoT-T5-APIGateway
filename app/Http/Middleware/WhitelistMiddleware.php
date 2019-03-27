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

        // Derrick's Home, Derrick's Office, School's Wifi
        // For Testing, include ::1 (localhost)
        // $opt_hosts = ['124.197.124.20', '128.106.215.190', '202.161.33.32', '::1'];
        $opt_hosts = ['124.197.124.20', '128.106.215.190', '202.161.33.32'];
        $imt_hosts = [env('PI_HOST'), env('DASHBOARD_HOST')];

        // Only allow API calls from the below hosts
        if (in_array($callerIP, array_merge($imt_hosts, $opt_hosts))) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
