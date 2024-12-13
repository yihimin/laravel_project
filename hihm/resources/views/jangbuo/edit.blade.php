@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">매출</div>
<script>
    $(function(){
     $("#writeday") .datetimepicker({
        locale: "ko",
        format: "YYYY-MM-DD",
        defaultDate: moment()
     });
    });

    function select_product() 
    {
        var str;
        str = form1.sel_products_id.value;  // 선택된 제품 ID 값을 가져옴
        if (str == "") {  // 만약 선택된 제품이 없다면
            form1.products_id.value = "";  // 제품 ID 초기화
            form1.price.value = "";        // 단가 초기화
            form1.prices.value = "";       // 금액 초기화
        } else {  // 선택된 제품이 있으면
            str = str.split("^^");  // "^^"를 기준으로 ID와 단가 분리
            form1.products_id.value = str[0];  // 제품 ID 설정
            form1.price.value = str[1];        // 단가 설정
            form1.prices.value = Number(form1.price.value) * Number(form1.numo.value);  // 수량과 단가를 곱하여 금액 설정
        }
    }

    function cal_prices() 
    {
        form1.prices.value = Number(form1.price.value) * Number(form1.numo.value);  // 단가와 수량을 곱하여 금액 계산
        form1.bigo.focus();  // '비고' 필드로 포커스를 이동
    }

    function find_product() {
        window.open("{{ route('findproduct.index') }}", "", "resizable=yes, scrollbars=yes, width=500, height=600");
    }
</script>  

<form name="form1" method="post" action="{{ route('jangbuo.update', $row->id) }}{{ $tmp }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table class="table table-sm table-bordered mymargin5">
        <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 날짜</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                        <div class="input-group input-group-sm date" id="writeday">
                            <input type="text" name="writeday" size="10" value="{{ $row->writeday }}" class="form-control form-control-sm">
                            <div class="input-group-text">
                                <div class="input-group-addon">
                                    <i class="far fa-calendar-alt fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @error('writeday') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font>제품명</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                     <input type="hidden" name="products_id" value="{{ $row->products_id }}">
                     <input type="text" name="product_name" value="{{ $row->product_name }}" class="form-control form-control-sm" readonly> &nbsp;
                     <input type="button" value="제품찾기" onClick="find_product();" class="btn btn-sm mycolor1">
                </div>
                @error('product_id') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 단가</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="price" size="20" maxlength="20" value="{{ $row->price }}" class="form-control form-control-sm" onChange="cal_prices();">
                </div>
                @error('price') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 수량</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="numo" size="20" maxlength="20" value="{{ $row->numo }}" class="form-control form-control-sm" onChange="cal_prices();">
                </div>
                @error('numo') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 금액</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="prices" size="20" maxlength="20" value="{{ $row->prices }}" class="form-control form-control-sm" readonly>
                </div>
                @error('prices') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 비고</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="bigo" size="20" maxlength="20" value="{{ $row->bigo }}" class="form-control form-control-sm">
                </div>
                @error('bigo') {{ $message }} @enderror
            </td>
        </tr>
    </table>

    <div align="center">
        <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
    </div>

</form>
@endsection
