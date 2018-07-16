<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WWW\PData;

class PDataController extends Controller
{
    private $theme = '個資保護作業';

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
        return view('pages.pdata.index', [
            'units' => PData::distinct('unit')->select('unit')->get(),
            'position' => [
                [ 'name' => '首頁', 'url' => route('Index') ],
                [ 'name' => $this->theme ]
            ],
            'sidebar' => config('www.menu.other'),
            'items' => PData::paginate(30),
            'index' => true
        ]);
    }

    public function back()
    {
        return view('pages.pdata.back', [
            'theme' => $this->theme,
            'position' => [
                [ 'name' => '網站地圖', 'url' => route('sitemaps.back') ],
                [ 'name' => '其他'],
                [ 'name' => $this->theme ]
            ],
            'items' => PData::paginate(15)
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
        $item = new PData();
        $item->unit = $request->unit;
        $item->name = $request->name;
        $item->accordance = $request->accordance;
        $item->purpose = $request->purpose;
        $item->p_data_sort = $request->p_data_sort;
        $item->keep_unit = $request->keep_unit;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() ? 'success' : 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unit)
    {
        return PData::where('unit', $unit)->get();
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
        $item = PData::find($id);
        $item->unit = $request->unit;
        $item->name = $request->name;
        $item->accordance = $request->accordance;
        $item->purpose = $request->purpose;
        $item->p_data_sort = $request->p_data_sort;
        $item->keep_unit = $request->keep_unit;
        $item->updated_by = session('userID');
        return $item->save() ? 'success' : 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PData::find($id)->delete();
    }
}
