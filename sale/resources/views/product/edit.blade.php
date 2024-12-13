@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">제품</div>

<form name="form1" method="post" action="{{ route('product.update', $row->id) }}{{ $tmp }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table class="table table-sm table-bordered mymargin5">
        <tr>
            <td width="20%" class="mycolor2">번호</td>
            <td width="80%" align="left">{{ $row->id }}</td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 구분명</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <select name="gubuns_id" class="form-select form-select-sm">
                        <option value="" selected>선택하세요.</option>
                        @foreach ($list as $gubun)
                            <option value="{{ $gubun->id }}" {{ old('gubuns_id', $row->gubuns_id) == $gubun->id ? 'selected' : '' }}>
                                {{ $gubun->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('gubuns_id') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="name" size="20" maxlength="20" value="{{ old('name', $row->name) }}" class="form-control form-control-sm">
                </div>
                @error('name') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"><font color="red">*</font> 단가</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="price" size="20" maxlength="20" value="{{ old('price', $row->price) }}" class="form-control form-control-sm">
                </div>
                @error('price') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 재고</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="text" name="jaego" size="20" maxlength="20" value="{{ old('jaego', $row->jaego) }}" class="form-control form-control-sm">
                </div>
                @error('jaego') {{ $message }} @enderror
            </td>
        </tr>
        <tr>
            <td width="20%" class="mycolor2"> 사진</td>
            <td width="80%" align="left">
                <div class="d-inline-flex">
                    <input type="file" name="pic" class="form-control form-control-sm">
                </div>
                <br><br>
                <b>파일이름</b>: {{ $row->pic }} <br>
                @if($row->pic)
                    <img src="{{ asset('storage/product_img/' . $row->pic) }}" width="200" class="img-fluid img-thumbnail mymargin5">
                @else
                    <img src="{{ asset('images/no_image.png') }}" width="200" class="img-fluid img-thumbnail mymargin5">
                @endif
            </td>
        </tr>
    </table>

    <div align="center">
        <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
    </div>

</form>
@endsection
