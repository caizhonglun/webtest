<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WWW\QA;

class QAController extends Controller
{
    private $theme = '常見問題';

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.qa.index', [
            'theme' => $this->theme,
            'position' => [
                [ 'name' => '首頁', 'url' => route('Index') ],
                [ 'name' => $this->theme ]
            ],
            'items' => QA::paginate(30)
        ]);
    }

    /**
     * [back description]
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return view('pages.qa.back', [
            'theme' => $this->theme,
            'position' => [
                [ 'name' => '網站地圖', 'url' => route('sitemaps.back') ],
                [ 'name' => '其他'],
                [ 'name' => $this->theme ]
            ],
            'items' => QA::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new QA();
        $item->title = $request->title;
        $item->content = $request->content;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() ? 'success': 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.qa.show', [
            'item' => QA::find($id),
            'position' => [
                [ 'name' => '首頁', 'url' => route('Index') ],
                [ 'name' => $this->theme ]
            ]
        ]);
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
        $item = QA::find($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->updated_by = session('userID');
        return $item->save() ? 'success': 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QA::find($id)->delete();
    }
}
