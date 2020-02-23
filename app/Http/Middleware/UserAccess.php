<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAccess
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
        $auth=Auth::user();
        $client=\App\Client::whereId($auth)->first();
        $cleaner=\App\Cleaner::whereId($auth)->first();

        $response = $next($request);

        // Perform action
        // dd($response->headers);
        dd($auth);

        return $response;
    }
}
