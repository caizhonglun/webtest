<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WWW\Link;

class SitemapsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('index');
    }

    /**
     * 顯示局網對外導覽
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sitemaps.index');
    }

    /**
     * 顯示局網對內導覽
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return view('pages.sitemaps.back');
    }
}
