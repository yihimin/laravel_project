<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 사용자 인증 확인
        if (!auth()->check()) {
            return redirect('/login')->with('error', '로그인이 필요합니다.');
        }

        // 관리자 권한 확인
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', '관리자 권한이 필요합니다.');
        }

        return $next($request); // 요청 계속 처리
    }
}
