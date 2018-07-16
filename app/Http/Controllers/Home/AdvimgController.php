<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvimgPost;
use App\WWW\Advimg;

class AdvimgController extends Controller
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
            ['name' => '活動看板'],
        ];

        $items = Advimg::paginate(15);
        return view('pages.home.advimg.back', [
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
            ['name' => '活動看板', 'url' => route('advimg.back')],
            ['name' => '新增']
        ];

        return view('pages.home.advimg.form', [
            'position' => $position,
            'route' => route('advimg.store'),
            'update' => false,
            'item' => new Advimg,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarqueePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvimgPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '跑馬燈', 'url' => route('advimg.back')],
            ['name' => '預覽']
        ];

        $item = new Advimg();

        $item->img_path = $request->file('thumbnail')->store('public/advimg');
        $item->title = $request->title;
        $item->url = $request->url;
        $item->organizer = $request->organizer;
        $item->phone = $request->phone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.advimg.preview', [
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
            ['name' => '活動看板', 'url' => route('advimg.back')],
            ['name' => '修改']
        ];

        $item = Advimg::find($id);

        return view('pages.home.advimg.form', [
            'position' => $position,
            'route' => route('advimg.update', $id),
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
    public function update(AdvimgPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '活動看板', 'url' => route('advimg.back')],
            ['name' => '預覽']
        ];

        $item = Advimg::find($id);

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

        return view('pages.home.advimg.preview', [
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
        $item = Advimg::find($id);
        $path = str_replace('storage/', 'public/', $item->img_path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $item->delete();
    }
}
