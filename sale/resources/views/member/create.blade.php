@extends('main')
@section('content')

<br>
	<div class="alert mycolor1" role="alert">사용자</div>

	<form name="form1" method="post" action="{{ route('member.store') }}{{ $tmp }}">
     @csrf
	<table class="table table-sm table-bordered mymargin5">
		<tr>
			<td width="20%" class="mycolor2">번호</td>
			<td width="80%" align="left"></td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 이름</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="name" size="20" maxlength="20" value="{{ old('name') }}" class="form-control form-control-sm">
				</div>
                @error('name') {{ $message }} @enderror
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 아이디</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="uid" size="20" maxlength="20" value="{{ old('uid') }}" class="form-control form-control-sm">
				</div>
                @error('uid') {{ $message }} @enderror
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 암호</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="pwd" size="20" maxlength="20" value="{{ old('pwd') }}" class="form-control form-control-sm">
				</div>
                @error('pwd') {{ $message }} @enderror
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2">전화</div></td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="tel1" size="3" maxlength="3" value="" class="form-control form-control-sm">-
					<input type="text" name="tel2" size="4" maxlength="4" value="" class="form-control form-control-sm">-
					<input type="text" name="tel3" size="4" maxlength="4" value="" class="form-control form-control-sm">
				</div>
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2">등급</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="radio" name="rank" value="0" checked>&nbsp;직원&nbsp;&nbsp;
					<input type="radio" name="rank" value="1">&nbsp;관리자
				</div>
			</td>
		</tr>
	</table>

	<div align="center">
		<input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
		<input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
	</div>

	</form>
@endsection