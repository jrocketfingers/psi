<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $admin = Admin::find(Auth::user()->id);
        if(!$admin) {
            return redirect()->action('HomeController@index');
        }
        
        return $next($request);
    }
}
