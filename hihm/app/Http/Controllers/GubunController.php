<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gubun;

class GubunController extends Controller
{
    public function index()
    {

        $data['tmp'] = $this->qstring();
        $text1=request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('gubun.index', $data);
    }
    
    public function getlist($text1)
    {
        $result = Gubun::where('name', 'like', '%'. $text1. '%')
                    ->orderby('name', 'asc')
                    ->paginate(5)->appends(['text1' => $text1]);
        return $result;
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'name' => 'required|max:20'
        ],
        [
            'name.required' => '이름은 필수입력입니다.',
            'name.max' => '20자 이내입니다.',
        ]);
        $row->name = $request->input('name');
        
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
        return view('gubun.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // 새로운 Gubun 객체 생성
        $row = new Gubun;
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('gubun'. $tmp);
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
        $data["row"] = Gubun::find($id);
        return view('gubun.show', $data);
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
        $data['row'] = Gubun::find($id);
        return view('gubun.edit', $data);
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
        $row = Gubun::find($id);
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('gubun' .$tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gubun::find($id) -> delete();
        $tmp = $this->qstring();
        return redirect('gubun' . $tmp);
    }

    public function qstring()
    {
        $text1 = request("text1") ? request('text1') : "";
        $page =  request("page") ? request('page') : "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }
}
