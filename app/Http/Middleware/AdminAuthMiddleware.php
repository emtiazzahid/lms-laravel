<?php

namespace App\Http\Middleware;

use App\Libraries\Enumerations\UserTypes;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AdminAuthMiddleware
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
        if (!Auth::user() || Auth::user()->user_type != UserTypes::$ADMIN) {
            $urlPath = Request::path().str_replace(Request::url(), '', Request::fullUrl());

            if ($request->isMethod('post')) {
                $urlPath = "";
            }
            return redirect()->route('login', ['urlPath' => $urlPath]);
        }
        return $next($request);
    }
}
