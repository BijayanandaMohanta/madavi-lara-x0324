<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;
use Illuminate\Http\Request;

class registerSeller
{
    
    public function handle($request, Closure $next)
    {
        if (!Session::has('seller_id')) {
            return redirect()->route('sellerlogin')->with('failure', 'You must be logged in to access this page.');
        }
        return $next($request);
    }
}
