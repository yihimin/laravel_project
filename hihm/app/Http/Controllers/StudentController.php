<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        // 검색어와 데이터 가져오기
        $data['tmp'] = $this->qstring();
        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);

        return view('students.index', $data);
    }

    public function getlist($text1)
    {
        // 전체 학생 데이터 가져오기
        return Student::where('name', 'like', '%' . $text1 . '%')
                      ->orderby('name', 'asc')
                      ->paginate(5)
                      ->appends(['text1' => $text1]);
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'name' => 'required|max:20',
            'phone' => 'required|digits:11',
            'ban' => 'required|max:10'
        ], [
            'name.required' => '이름은 필수 입력입니다.',
            'phone.required' => '전화번호는 필수 입력입니다.',
            'phone.digits' => '전화번호는 정확히 11자리여야 합니다.',
            'ban.required' => '반 정보는 필수 입력입니다.',
            'name.max' => '이름은 20자 이내여야 합니다.',
            'ban.max' => '반 정보는 10자 이내여야 합니다.'
        ]);

        $row->name = $request->input('name');
        $row->phone = $request->input('phone');
        $row->ban = $request->input('ban');
        $row->save();
    }

    public function create()
    {
        $data['tmp'] = $this->qstring();
        return view('students.create', $data);
    }

    public function store(Request $request)
    {
        $row = new Student;
        $this->save_row($request, $row);
        return redirect()->route('students.index')->with('success', '학생이 추가되었습니다.');
    }

    public function show($id)
    {
        $data['tmp'] = $this->qstring();
        $data['row'] = Student::find($id);
        return view('students.show', $data);
    }

    public function edit($id)
    {
        $data['tmp'] = $this->qstring();
        $data['row'] = Student::find($id);
        return view('students.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $row = Student::find($id);
        $this->save_row($request, $row);
        return redirect()->route('students.index')->with('success', '학생 정보가 수정되었습니다.');
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect()->route('students.index')->with('success', '학생이 삭제되었습니다.');
    }

    public function qstring()
    {
        $text1 = request('text1') ?? '';
        $page = request('page') ?? '1';
        return $text1 ? "?text1=$text1&page=$page" : "?page=$page";
    }
}
