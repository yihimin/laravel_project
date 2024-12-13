<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // 사용자 조회
        $user = User::where('name', $credentials['name'])->first();

        // 비밀번호 확인
        if ($user && $credentials['password'] === $user->password) {
            // 세션에 사용자 정보 저장
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);
            $request->session()->put('is_admin', $user->is_admin);

            return redirect()->intended('/');
        }

        return back()->withErrors(['name' => '아이디 또는 비밀번호가 올바르지 않습니다.']);
    }

    public function logout(Request $request)
    {
        // 세션 초기화
        $request->session()->forget(['user_id', 'user_name', 'is_admin']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
