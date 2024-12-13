@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">학생</div>

<form name="form1" method="post" action="">

<table class="table table-sm table-bordered mymargin5">
	<tr>
		<td width="20%" class="mycolor2">번호</td>
		<td width="80%" align="left">{{ $row->id }}</td>
	</tr>
	<tr>
		<td width="20%" class="mycolor2"></font> 이름</td>
		<td width="80%" align="left">
			{{ $row->name }}
		</td>
	</tr>
	<tr>
		<td width="20%" class="mycolor2"></font> 전화번호</td>
		<td width="80%" align="left">
			{{ $row->phone }}
		</td>
	</tr>
	<tr>
		<td width="20%" class="mycolor2">반</td>
		<td width="80%" align="left">
			{{ $row->ban }}
		</td>
	</tr>
</table>

<div align="center">
	<a href="{{ route('students.edit', $row->id) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>
	<form action="{{ route('students.destroy', $row->id) }}" method="POST" style="display:inline;">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요?');">삭제</button>
	</form>
	<input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
</div>

</form>
@endsection
