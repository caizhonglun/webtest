<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VideolinkPost;
use App\WWW\Videolink;

class VideolinkController extends Controller
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
     * 顯示跑馬燈後台管理
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '廉政服務專區'],
            ['name' => '影音宣導'],
        ];

        $items = Videolink::paginate(15);
        return view('pages.videolink.back', [
            'position' => $position,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '影音宣導', 'url' => route('videolink.back')],
            ['name' => '新增']
        ];

        return view('pages.videolink.form', [
            'position' => $position,
            'route' => route('videolink.store'),
            'update' => false,
            'item' => new Videolink,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarqueePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideolinkPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '影音宣導', 'url' => route('videolink.back')],
            ['name' => '預覽']
        ];

        $item = new Videolink();

        $item->img_path = $request->file('thumbnail')->store('public/videolink');
        $item->title = $request->title;
        $item->url = $request->url;
        $item->organizer = $request->organizer;
        $item->phone = $request->phone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.videolink.preview', [
            'position' => $position,
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '影音宣導', 'url' => route('videolink.back')],
            ['name' => '修改']
        ];

        $item = Videolink::find($id);

        return view('pages.videolink.form', [
            'position' => $position,
            'route' => route('videolink.update', $id),
            'update' => true,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MarqueePost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideolinkPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '影音宣導', 'url' => route('videolink.back')],
            ['name' => '預覽']
        ];

        $item = Videolink::find($id);

        if ($request->hasFile('thumbnail')) {
            // 移除舊圖檔
            $exPath = str_replace('storage/', 'public/', $request->img_path);

            if (Storage::exists($exPath)) {
                Storage::delete($exPath);
            }

            $item->img_path = $request->file('thumbnail')->store('public/intro');
        }

        $item->title            = $request->title;
        $item->url              = $request->url;
        $item->organizer        = $request->organizer;
        $item->phone            = $request->phone;
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.videolink.preview', [
            'position' => $position,
            'item' => $item,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Videolink::find($id);
        $path = str_replace('storage/', 'public/', $item->img_path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $item->delete();
    }
    
  
    
    public function index()
    {
        $position = [
            ['name' => '首頁', 'url' => route('Index')],
            ['name' => '影音宣導'],
        ];

        $items = Videolink::paginate(15);
        return view('pages.videolink.index', [
            'position' => $position,
            'items' => $items
        ]);
    }
}
