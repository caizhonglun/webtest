<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselPost;
use App\WWW\Carousel;

class CarouselController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin');

        // 檢查幻燈片數
        $this->middleware(function ($request, $next) {
            if (Carousel::count() < config('www.carouselLimit')) {
                return $next($request);
            } else {
                return back();
            }
        })->only('creat', 'store');
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
            ['name' => '幻燈片']
        ];

        return view('pages.home.carousel.back', [
            'position' => $position,
            'items' => Carousel::paginate(15),
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
            ['name' => '幻燈片', 'url' => route('carousel.back')],
            ['name' => '新增']
        ];

        return view('pages.home.carousel.form', [
            'position' => $position,
            'route' => route('carousel.store'),
            'update' => false,
            'item' => new Carousel,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CarouselPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '幻燈片', 'url' => route('carousel.back')],
            ['name' => '預覽']
        ];

        $item = new Carousel();
        $item->img_path = $request->file('thumbnail')->store('public/carousel');
        $item->title = $request->title;
        $item->url = $request->url;
        $item->organizer = $request->organizer;
        $item->phone = $request->phone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.carousel.preview', [
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
            ['name' => '幻燈片', 'url' => route('carousel.back')],
            ['name' => '修改']
        ];

        return view('pages.home.carousel.form', [
            'position' => $position,
            'route' => route('carousel.update', $id),
            'update' => true,
            'item' => Carousel::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CarouselPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarouselPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '幻燈片', 'url' => route('carousel.back')],
            ['name' => '預覽']
        ];

        $item = Carousel::find($id);

        if ($request->hasFile('thumbnail')) {
            // 移除舊圖檔
            $exPath = str_replace('storage/', 'public/', $request->img_path);

            if (Storage::exists($exPath)) {
                Storage::delete($exPath);
            }

            $item->img_path = $request->file('thumbnail')->store('public/intro');
        }

        $item->title             = $request->title;
        $item->url              = $request->url;
        $item->organizer        = $request->organizer;
        $item->phone            = $request->phone;
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.carousel.preview', [
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
        $item = Carousel::find($id);
        $path = str_replace('storage/', 'public/', $item->img_path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $item->delete();
    }
}
