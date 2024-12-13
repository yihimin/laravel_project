@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">매입</div>

<!-- 데이터를 보여주는 테이블 -->
<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2">날짜</td>
        <td width="80%" align="left">{{$row->writeday}}</td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
        <td width="80%" align="left">{{$row->product_name}}</td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2"> 단가</td>
        <td width="80%" align="left">{{number_format($row->price)}}</td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2"> 수량</td>
        <td width="80%" align="left">{{number_format($row->numi)}}</td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2">금액</td>
        <td width="80%" align="left">{{number_format($row->prices)}}</td>
    </tr>
    <tr>
        <td width="20%" class="mycolor2">비고</td>
        <td width="80%" align="left">{{$row->bigo}}</td>
    </tr>
</table>

<div align="center">
    <!-- 수정 버튼 -->
    <a href="{{ route('jangbui.edit', $row->id) }}{{ $tmp }}" class="btn btn-sm mycolor1">수정</a>

    <!-- 삭제 버튼 -->
    <form action="{{ route('jangbui.destroy', $row->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm mycolor1" onClick="return confirm('삭제할까요?');">삭제</button>
    </form>

    <!-- 이전 화면으로 돌아가는 버튼 -->
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
</div>

@endsection
