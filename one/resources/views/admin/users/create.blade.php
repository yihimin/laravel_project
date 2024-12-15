@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <!-- 제목 -->
    <h1 class="mb-4 text-center" style="color: #6B4226;">사용자 추가</h1>

    <!-- 사용자 추가 폼 -->
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- 이름 -->
        <div class="mb-3">
            <label for="name" class="form-label" style="color: #6B4226;">이름</label>
            <input type="text" name="name" id="name" class="form-control"
                   placeholder="이름을 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 이메일 -->
        <div class="mb-3">
            <label for="email" class="form-label" style="color: #6B4226;">이메일</label>
            <input type="email" name="email" id="email" class="form-control"
                   placeholder="이메일을 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 비밀번호 -->
        <div class="mb-3">
            <label for="password" class="form-label" style="color: #6B4226;">비밀번호</label>
            <input type="password" name="password" id="password" class="form-control"
                   placeholder="비밀번호를 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 관리자 여부 -->
        <div class="mb-3">
            <label for="is_admin" class="form-label" style="color: #6B4226;">관리자 여부</label>
            <select name="is_admin" id="is_admin" class="form-control"
                    style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
                <option value="0">일반 사용자</option>
                <option value="1">관리자</option>
            </select>
        </div>

        <!-- 추가 버튼 -->
        <div class="text-center">
            <button type="submit" class="btn" 
                    style="background-color: #8C6450; color: #FFF; border-radius: 5px; width: 100px;">
                추가
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"
               style="border-radius: 5px; color: #6B4226;">
                취소
            </a>
        </div>
    </form>
</div>
@endsection
