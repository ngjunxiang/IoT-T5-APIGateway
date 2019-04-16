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

        // Derrick's Home, Derrick's Office, School's Wifi, Kangrui's Office, Kangrui's Home
        // For Testing, include ::1 (localhost)
        // $opt_hosts = ['124.197.124.20', '128.106.215.190', '202.161.33.32', '::1', '127.0.0.1'];
        $opt_hosts = [env('DERRICK_HOME'), env('DERRICK_OFFICE'), '202.161.33.32', '157.120.248.198', '58.182.111.80', '::1', '127.0.0.1'];
        $imt_hosts = [env('PI_HOST'), env('DASHBOARD_HOST'), env('TELEGRAM_HOST')];

        // Only allow API calls from the below hosts
        if (in_array($callerIP, array_merge($imt_hosts, $opt_hosts))) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
