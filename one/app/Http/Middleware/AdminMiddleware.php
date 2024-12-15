<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('is_admin') || session('is_admin') != 1) {
            return redirect('/')->with('error', '권한이 없습니다.');
        }

        return $next($request);
    }
}

