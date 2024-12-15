@extends('admin_layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center" style="color: #8B5E3C;">사용자 관리</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($users) && count($users) > 0)
        <div class="d-flex justify-content-between mb-3">
            <div></div>
            <!-- 사용자 추가 버튼 -->
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">사용자 추가</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead style="background-color: #6C757D; color: #FFF;">
                <tr>
                    <th>ID</th>
                    <th>이름</th>
                    <th>이메일</th>
                    <th>관리자 여부</th>
                    <th>가입일</th>
                    <th>작업</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? '관리자' : '일반 사용자' }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <!-- 수정 버튼 -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm">수정</a>
                                
                                <!-- 삭제 버튼 -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('이 사용자를 삭제하시겠습니까?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center" style="color: #8B5E3C;">등록된 사용자가 없습니다.</p>
        
        <!-- 사용자 추가 버튼 -->
        <div class="text-center">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">사용자 추가</a>
        </div>
    @endif
</div>
@endsection
