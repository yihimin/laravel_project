<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display the main index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // main.index 뷰 파일을 렌더링
        return view('main.index');
    }

    /**
     * Display the products page.
     *
     * @return \Illuminate\View\View
     */
    public function products()
    {
        // main.products 뷰 파일을 렌더링
        return view('main.products');
    }

    /**
     * Display the store page.
     *
     * @return \Illuminate\View\View
     */
    public function store()
    {
        // main.store 뷰 파일을 렌더링
        return view('main.store');
    }
}
