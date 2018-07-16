<?php

namespace App\Http\Controllers\Link;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WWW\LinkSort;
use App\WWW\Link;

class SortController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin');
    }

    /**
     * 建立新類別
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new LinkSort;
        $item->name = $request->name;
        $item->theme = $request->theme;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() === true ? 'success' : 'error';
    }

    /**
     * 提供類別內的連結
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Link::where('sort_id', $id)->get();
    }

    /**
     * 刪除類別及底下的連結
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::where('sort_id', $id)->delete();

        $item = LinkSort::find($id);
        $item->delete();
    }
}
