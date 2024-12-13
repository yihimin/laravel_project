<?php

namespace App\Http\Middleware;

use Closure;

class SessionAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user_id')) {
            return redirect('/login')->with('error', '로그인이 필요합니다.');
        }

        return $next($request);
    }
}
