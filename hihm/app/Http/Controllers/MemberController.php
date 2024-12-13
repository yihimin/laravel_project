<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        if(session()->get("rank")!=1) return redirect("/");
        
        $data['tmp'] = $this->qstring();
        $text1=request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('member.index', $data);
    }
    
    public function getlist($text1)
    {
        $result = Member::where('name', 'like', '%'. $text1. '%')
                    ->orderby('name', 'asc')
                    ->paginate(5)->appends(['text1' => $text1]);
        return $result;
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'uid' => 'required|max:20',
            'pwd' => 'required|max:20',
            'name' => 'required|max:20'
        ],
        [
            'uid.required' => '아이디는 필수입력입니다.',
            'pwd.required' => '암호는 필수입력입니다.',
            'name.required' => '이름은 필수입력입니다.',
            'uid.max' => '20자 이내입니다.',
            'pwd.max' => '20자 이내입니다.',
            'name.max' => '20자 이내입니다.',
        ]);

        // 전화번호를 합치는 작업
        $tel1 = $request->input("tel1");
        $tel2 = $request->input("tel2");
        $tel3 = $request->input("tel3");
        $tel = sprintf("%-3s%-4s%s-4s", $tel1, $tel2, $tel3);
    
        // 사용자 입력값을 Member 객체의 속성에 할당
        $row->uid = $request->input('uid');
        $row->pwd = $request->input('pwd');
        $row->name = $request->input('name');
        $row->tel = $tel;
        $row->rank = $request->input('rank');
    
        // 데이터베이스에 저장
        $row->save();
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tmp'] = $this->qstring();
        return view('member.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // 새로운 Member 객체 생성
        $row = new Member;
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('member'. $tmp);
    }       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['tmp'] = $this->qstring();
        $data["row"] = Member::find($id);
        return view('member.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tmp'] = $this->qstring();
        $data['row'] = Member::find($id);
        return view('member.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        // 자료찾기
        $row = Member::find($id);
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('member' .$tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::find($id) -> delete();
        $tmp = $this->qstring();
        return redirect('member' . $tmp);
    }

    public function qstring()
    {
        $text1 = request("text1") ? request('text1') : "";
        $page =  request("page") ? request('page') : "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }
}
