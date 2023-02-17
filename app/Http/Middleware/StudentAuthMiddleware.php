<?php

namespace App\Http\Middleware;

use App\Libraries\Enumerations\UserTypes;
use Closure;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\Student;

class StudentAuthMiddleware
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
        if (!Auth::user() || Auth::user()->user_type != UserTypes::$STUDENT) {
            $urlPath = Request::path().str_replace(Request::url(), '', Request::fullUrl());

            if ($request->isMethod('post')) {
                $urlPath = "";
            }
            return redirect()->route('login', ['urlPath' => $urlPath]);
        }
        else {
            $StudentUserInfo = Student::where('user_id', Auth::user()->id)->first();
            if(!$StudentUserInfo) {
                abort(401, 'Unauthorized Acton');
            }
        }
        return $next($request);
    }
}
