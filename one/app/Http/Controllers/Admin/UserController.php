<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * 사용자 목록 및 검색
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->paginate(5); 

        return view('admin.users.index', compact('users'));
    }    

    /**
     * 사용자 추가 폼
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * 사용자 저장
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // 비밀번호 암호화
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', '사용자가 추가되었습니다.');
    }

    /**
     * 사용자 수정 폼
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * 사용자 수정
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'is_admin' => 'required|boolean',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', '사용자 정보가 수정되었습니다.');
    }

    /**
     * 사용자 삭제
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', '사용자가 삭제되었습니다.');
    }
}
