<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\WWW\Video;
use App\Http\Requests\VideoPost;


/**
 * 此Controller的功能主要是提供給「廉政專區」裡的「影音宣導」使用
 * ，如若需要提供擴充至其他頁面的功能，則需要進行調整。
 */
class VideoController extends Controller
{
    private $theme = '影音宣導';

    /**
     * check auth
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('index');
    }

    /**
     * 顯示前台頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Video::orderBy('priority')->paginate(20);

        return view('pages.video.index', [
            'theme' => $this->theme,
            'position' => [
                ['name' => '首頁', 'url' => route('Index')],
                ['name' => '廉政服務專區'],
                ['name' => '影音專區']
            ],
            'items' => $items
        ]);
    }

    /**
     * 顯示後台頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $items = Video::orderBy('priority')->paginate(10);

        return view('pages.video.back', [
            'theme' => $this->theme,
            'position' => [
                ['name' => '網站地圖', 'url' => route('sitemaps.back')],
                ['name' => '廉政服務專區'],
                ['name' => '影音專區']
            ],
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\VideoPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoPost $request)
    {
        $item = new Video;
        $item->sort = '影音宣導';
        $item->title = $request->title;
        $item->path = $request->file('video')->store('public/video');
        $item->priority = 1 + Video::count('id');
        $item->created_by = session('userID');
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
        $item = Video::find($id);
        $path = str_replace('storage/', 'public/', $item->path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $item->delete();
    }

    /**
     * 設定排序
     *
     * @return \Illuminate\Http\Response
     */
    public function priority($id, $number)
    {
        $item = Video::find($id);
        $item->priority = $number;
        $item->save();
    }
}
