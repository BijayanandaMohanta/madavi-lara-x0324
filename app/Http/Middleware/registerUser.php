<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;
use Illuminate\Http\Request;

class registerUser
{
    
    public function handle($request, Closure $next)
    {
        if (!Session::has('customer_id')) {
            return redirect()->route('userlogin')->with('failure', 'You must be logged in to access this page.');
        }
        return $next($request);
    }
}
