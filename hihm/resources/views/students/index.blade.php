@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">학생</div>

<script>
	function find_text()
	{
		form1.action="{{ route('students.index') }}";
		form1.submit();
	}
</script>

<form name="form1" action="">
	<div class="row">
		<div class="col-3" align="left">
			<div class="input-group input-group-sm">
				<span class="input-group-text">이름</span>
				<input type="text" name="text1" value="{{ $text1 }}" class="form-control" 
					onKeydown="if (event.keyCode == 13) { find_text(); }"> 
				<button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
			</div>
		</div>
		<div class="col-9" align="right">
		<a href="{{ route('students.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
		</div>
	</div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
<tr class="mycolor2">
	<td width="10%">번호</td>
	<td width="30%">이름</td>
	<td width="30%">전화번호</td>
	<td width="30%">반</td>
</tr>
@foreach($list as $row)
<tr>
	<td>{{ $row->id }}</td>
	<td><a href="{{ route('students.show', $row->id) }}{{ $tmp }}">{{ $row->name }}</a></td>
	<td>{{ $row->phone }}</td>
	<td>{{ $row->ban }}</td>
</tr>
@endforeach
</table>

<div class="row">
	<div class="col">
		{{ $list->links('mypagination') }}
	</div>
</div>

@endsection
