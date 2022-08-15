<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class language
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && !empty(Auth::user()->lang)){
            App::setLocale(Auth::user()->lang);
        }
        return $next($request);
    }
}
