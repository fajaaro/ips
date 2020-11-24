<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserCourse
{
    public function handle(Request $request, Closure $next)
    {
        $courseId = (int) filter_var($request->path(), FILTER_SANITIZE_NUMBER_INT);
        
        $user = Auth::user();

        if ($user->hasCourse($courseId)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
