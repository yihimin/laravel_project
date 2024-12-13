@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">사용자</div>

	<script>
		function find_text()
		{
			form1.action="{{ route('member.index') }}";
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
		<a href="{{ route('member.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
		</div>
	</div>
	</form>

	<table class="table table-sm table-bordered table-hover mymargin5">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="20%">아이디</td>
        <td width="20%">암호</td>
        <td width="20%">이름</td>
        <td width="20%">전화</td>
        <td width="10%">등급</td>
    </tr>
	@foreach($list as $row)
    <?php
        // 전화번호를 포맷팅 (000-0000-0000 형식으로 변경)
        $tel1 = trim(substr($row->tel, 0, 3));
        $tel2 = trim(substr($row->tel, 3, 4));
        $tel3 = trim(substr($row->tel, 7, 4));
        $tel = $tel1 . "-" . $tel2 . "-" . $tel3;

        // 등급을 숫자에서 문자로 변환 (0: 직원, 1: 관리자)
        $rank = $row->rank == 0 ? '직원' : '관리자';
    ?>
    <tr>
        <td>{{ $row->id }}</td>
        <td><a href="{{ route('member.show' ,$row->id)}}{{ $tmp }}">{{ $row->name }}</a></td>
        <td>{{ $row->uid }}</td>
        <td>{{ $row->pwd }}</td>
        <td>{{ $tel }}</td>
        <td>{{ $rank }}</td>
    </tr>
	@endforeach
	</table>


	<div class="row">
		<div class="col>
			{{ $list->links('mypagination') }}
	</div>
</div>

@endsection()