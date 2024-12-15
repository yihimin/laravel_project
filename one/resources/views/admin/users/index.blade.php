@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <h1 class="mb-4 text-center" style="color: #6B4226;">사용자 관리</h1>

    @if(session('success'))
        <div class="alert alert-success text-center" style="color: #FFF; background-color: #8C6450; border-color: #6B4226;">
            {{ session('success') }}
        </div>
    @endif 

<!-- 검색창 및 사용자 추가 버튼 -->
<div class="d-flex justify-content-between mb-3">
    <!-- 검색 폼 -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex align-items-center">
        <input type="text" name="search" 
               class="form-control me-2" 
               placeholder="이름 또는 이메일 검색"
               value="{{ request('search') }}"
               style="border: 1px solid #C4A484; border-radius: 5px; background-color: #F9F5F0; color: #6B4226; height: 38px;">
               <button type="submit" 
                class="btn" 
                style="background-color: #8C6450; color: #FFF; border-radius: 5px; 
                    height: 38px; padding: 6px 12px; font-size: 14px; white-space: nowrap;">
                    검색
                </button>
    </form>
    <!-- 사용자 추가 버튼 -->
    <a href="{{ route('admin.users.create') }}" 
       class="btn" 
       style="background-color: #8C6450; color: #FFF; border-radius: 5px; height: 38px; padding: 6px 12px; font-size: 14px;">
       사용자 추가
    </a>
</div>

    @if(!empty($users) && count($users) > 0)
        <table class="table table-bordered" style="border-color: #C4A484;">
            <thead style="background-color: #6B4226; color: #FFF;">
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
                    <tr style="background-color: #F9F5F0; color: #6B4226;">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? '관리자' : '일반 사용자' }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                        <div class="d-flex justify-content-around">
                                <!-- 수정 버튼 -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="btn btn-sm" 
                                   style="background-color: #A67B5B; color: #FFF; border-radius: 5px;  white-space: nowrap;">
                                   수정
                                </a>
                                
                                <!-- 삭제 버튼 -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('이 사용자를 삭제하시겠습니까?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm" 
                                            style="background-color: #D9534F; color: #FFF; border-radius: 5px;  white-space: nowrap;">
                                        삭제
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

     <!-- Pagination -->
     @include('mypagination', ['paginator' => $users])

    @else
        <p class="text-center" style="color: #8C6450;">등록된 사용자가 없습니다.</p>
        
        <!-- 사용자 추가 버튼 -->
        <div class="text-center">
            <a href="{{ route('admin.users.create') }}" 
               class="btn" 
               style="background-color: #8C6450; color: #FFF; border-radius: 8px;">
               사용자 추가
            </a>
        </div>
    @endif
</div>
@endsection
