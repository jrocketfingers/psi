<?php

namespace App\Http\Middleware;

use App\Assistant;
use Closure;

class AssistantMiddleware
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
        if(!Assistant::isAssistant($request->user()->id)) {
            return redirect()->action('HomeController@index');
        }
        
        return $next($request);
    }
}
