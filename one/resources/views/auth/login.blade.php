@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center" style="color: #8B5E3C;">로그인</h1>
    @if(session('error'))
        <div class="alert alert-danger text-center" style="background-color: #F8D7DA; color: #842029;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label" style="color: #8B5E3C; font-weight: bold;">아이디</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="아이디를 입력하세요" style="border: 1px solid #D4A373; border-radius: 5px;" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" style="color: #8B5E3C; font-weight: bold;">비밀번호</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="비밀번호를 입력하세요" style="border: 1px solid #D4A373; border-radius: 5px;" required>
        </div>
        <button type="submit" class="btn w-100" style="background-color: #A67B5B; color: #FFF; font-weight: bold; border: none; border-radius: 5px;">로그인</button>
    </form>
</div>
@endsection