<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Student;

class UserHasStudent
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

        $student = Student::find($request->student);

        if (auth()->user()->isAdmin() || auth()->user()->students->contains($student)) {
            return $next($request);
        }

        return redirect('/student');


        return $next($request);
    }
}
