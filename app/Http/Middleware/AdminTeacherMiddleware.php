<?php

namespace App\Http\Middleware;

use App\Libraries\Enumerations\UserTypes;
use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class AdminTeacherMiddleware
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
        if (!Auth::user()) {
            $urlPath = Request::path().str_replace(Request::url(), '', Request::fullUrl());

            if ($request->isMethod('post')) {
                $urlPath = "";
            }
            return redirect()->route('login', ['urlPath' => $urlPath]);
        }

        if (Auth::user()->user_type != UserTypes::$ADMIN && Auth::user()->user_type != UserTypes::$TEACHER) {
            $urlPath = Request::path() . str_replace(Request::url(), '', Request::fullUrl());

            if ($request->isMethod('post')) {
                $urlPath = "";
            }
            return redirect()->route('login', ['urlPath' => $urlPath]);
        }
        return $next($request);
    }
}
