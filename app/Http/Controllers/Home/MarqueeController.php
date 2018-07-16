<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarqueePost;
use App\WWW\Marquee;

class MarqueeController extends Controller
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
            ['name' => '首頁'],
            ['name' => '跑馬燈'],
        ];

        return view('pages.home.marquee.back', [
            'position' => $position,
            'items' => Marquee::paginate(15)
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
            ['name' => '跑馬燈', 'url' => route('marquee.back')],
            ['name' => '新增']
        ];

        return view('pages.home.marquee.form', [
            'position' => $position,
            'route' => route('marquee.store'),
            'update' => false,
            'item' => new Marquee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarqueePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarqueePost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '跑馬燈', 'url' => route('marquee.back')],
            ['name' => '預覽']
        ];

        $item = new Marquee();

        $item->img_path = $request->file('thumbnail')->store('public/marquee');
        $item->title = $request->title;
        $item->url = $request->url;
        $item->organizer = $request->organizer;
        $item->phone = $request->phone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.marquee.preview', [
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
            ['name' => '跑馬燈', 'url' => route('marquee.back')],
            ['name' => '修改']
        ];

        $item = Marquee::find($id);

        return view('pages.home.marquee.form', [
            'position' => $position,
            'route' => route('marquee.update', $id),
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
    public function update(MarqueePost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '跑馬燈', 'url' => route('marquee.back')],
            ['name' => '預覽']
        ];

        $item = Marquee::find($id);

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

        return view('pages.home.marquee.preview', [
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
        $item = Marquee::find($id);
        $path = str_replace('storage/', 'public/', $item->img_path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $item->delete();
    }
}
