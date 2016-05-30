<?php

namespace App\Http\Middleware;

use App\Student;
use Closure;

class TeamLeaderMiddleware
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
        if(Student::find($request->input('student_id'))->is_leader === true) {
            return "TEAM LEADER CANT BE KICKED";
        }

        return $next($request);
    }
}
