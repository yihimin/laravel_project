@extends('main')
@section('content')

<br>
	<div class="alert mycolor1" role="alert">학생</div>

	<form name="form1" method="post" action="{{ route('students.update', $row->id) }}{{ $tmp }}">
    @csrf
    @method('PATCH')
	<table class="table table-sm table-bordered mymargin5">
		<tr>
			<td width="20%" class="mycolor2">번호</td>
			<td width="80%" align="left">{{ $row->id }}</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 이름</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="name" size="20" maxlength="20" value="{{ $row->name }}" class="form-control form-control-sm">
				</div>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 전화번호</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<input type="text" name="phone" size="15" maxlength="11" value="{{ $row->phone }}" class="form-control form-control-sm">
				</div>
                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
			</td>
		</tr>
		<tr>
			<td width="20%" class="mycolor2"><font color="red">*</font> 반</td>
			<td width="80%" align="left">
				<div class="d-inline-flex">
					<select name="ban" class="form-control form-control-sm">
						<option value="국화반" {{ $row->ban == '국화반' ? 'selected' : '' }}>국화반</option>
						<option value="장미반" {{ $row->ban == '장미반' ? 'selected' : '' }}>장미반</option>
						<option value="백합반" {{ $row->ban == '백합반' ? 'selected' : '' }}>백합반</option>
						<option value="튤립반" {{ $row->ban == '튤립반' ? 'selected' : '' }}>튤립반</option>
					</select>
				</div>
                @error('ban') <div class="text-danger">{{ $message }}</div> @enderror
			</td>
		</tr>
	</table>

	<div align="center">
		<input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
		<input type="button" value="이전화면" class="btn btn-sm mycolor1" onClick="history.back();">
	</div>

	</form>
@endsection
