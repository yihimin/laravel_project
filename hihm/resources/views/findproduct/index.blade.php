@extends('main_nomenu')
@section('content')

<br>
<div class="alert mycolor1" role="alert">제품선택</div>

<script>
    function find_text() {
        document.forms['form1'].action = "{{ route('findproduct.index') }}";
        document.forms['form1'].submit();
    }

    function SendProduct(id, name, price) {
        opener.form1.products_id.value = id;
        opener.form1.product_name.value = name;
        opener.form1.price.value = price;
        opener.form1.prices.value = Number(price) * Number(opener.form1.numo.value);
        window.close();
    }
</script>

<form name="form1" action="" method="get">
    <div class="row">
        <div class="col-6" align="left">
            <div class="input-group input-group-sm">
                <span class="input-group-text">내용</span>
                <input type="text" name="text1" value="{{ $text1 }}" class="form-control" 
                    onKeydown="if (event.keyCode == 13) { find_text(); }"> 
                <button class="btn mycolor1" type="button" onClick="find_text();">검색</button>
            </div>
        </div>
        <div class="col-6" align="right">
            <!-- 오른쪽 공간 -->
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <tr class="mycolor2">
        <td width="10%">번호</td>
        <td width="20%">구분명</td>
        <td width="30%">제품명</td>
        <td width="20%">단가</td>
        <td width="20%">재고</td>
    </tr>
    @foreach($list as $row)
    <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->gubuns_name }}</td>
        <td>
            <a href="javascript:SendProduct('{{ $row->id }}', '{{ $row->name }}', '{{ $row->price }}')">
                {{ $row->name }}
            </a>
        </td>
        <td>{{ number_format($row->price) }}원</td>
        <td>{{ number_format($row->jaego) }}</td>
    </tr>
    @endforeach
</table>

@if($list->isEmpty())
    <div class="alert alert-info">검색 결과가 없습니다.</div>
@endif

<div class="row">
    <div class="col">
        {{ $list->links('mypagination') }}
    </div>
</div>

@endsection
