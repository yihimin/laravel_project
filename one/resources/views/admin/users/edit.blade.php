@extends('admin_layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">사용자 수정</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">이름</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">이메일</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="is_admin" class="form-label">관리자 여부</label>
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>일반 사용자</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>관리자</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">수정</button>
    </form>
</div>
@endsection
