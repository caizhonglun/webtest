<?php

namespace App\Http\Controllers\Link;

use App\Http\Requests\LinkPost;
use App\WWW\Link;
use App\Http\Controllers\Controller;

class LinkController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\LinkPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkPost $request)
    {
        $item = new Link;
        $item->title = $request->title;
        $item->url = $request->url;
        $item->sort = $request->sort;
        $item->sort_id = $request->sort_id;
        $item->organizer = $request->organizer;
        $item->contact_phone = $request->contactPhone;
        $item->priority = 1 + Link::count('id');
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() === true ? 'success' : 'error';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\LinkPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkPost $request, $id)
    {
        $item = Link::find($id);
        $item->title = $request->title;
        $item->url = $request->url;
        $item->organizer = $request->organizer;
        $item->contact_phone = $request->contactPhone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() === true ? 'success' : 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Link::find($id);
        $item->delete();
    }

    /**
     * 設定排序
     *
     * @return \Illuminate\Http\Response
     */
    public function priority($id, $number)
    {
        $item = Link::find($id);
        $item->priority = $number;
        $item->save();
    }
}
