@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <!-- 제목 -->
    <h1 class="mb-4 text-center" style="color: #6B4226;">사용자 수정</h1>
    
    <!-- 사용자 수정 폼 -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 이름 -->
        <div class="mb-3">
            <label for="name" class="form-label" style="color: #6B4226;">이름</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ $user->name }}" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 이메일 -->
        <div class="mb-3">
            <label for="email" class="form-label" style="color: #6B4226;">이메일</label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="{{ $user->email }}" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 관리자 여부 -->
        <div class="mb-3">
            <label for="is_admin" class="form-label" style="color: #6B4226;">관리자 여부</label>
            <select name="is_admin" id="is_admin" class="form-control"
                    style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>일반 사용자</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>관리자</option>
            </select>
        </div>

        <!-- 수정 버튼 -->
        <div class="text-center">
            <button type="submit" class="btn" 
                    style="background-color: #8C6450; color: #FFF; border-radius: 5px; width: 100px;">
                수정
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary" 
               style="border-radius: 5px; color: #6B4226; border: 1px solid #6B4226;">
                취소
            </a>
        </div>
    </form>
</div>
@endsection
