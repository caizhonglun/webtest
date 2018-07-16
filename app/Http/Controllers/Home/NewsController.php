<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsPost;
use App\WWW\News;
use App\WWW\Attach;

class NewsController extends Controller
{
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
        $position = [
            ['name' => '首頁', 'url' => route('Index')],
            ['name' => '最新消息公告'],
        ];

        $items = News::where('is_show', true)
                    ->where('announce_start', '<=', date('Y-m-d'))
                    ->where('announce_end', '>=', date('Y-m-d'))
                    ->orderBy('announce_start', 'desc')
                    ->paginate(10);

        return view('pages.home.news.index', [
            'position' => $position,
            'items' => $items,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '最新消息公告'],
        ];

        return view('pages.home.news.back', [
            'position' => $position,
            'items'    => News::orderBy('announce_start', 'desc')
                              ->paginate(20),
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
            ['name' => '最新消息公告', 'url' => route('news.back')],
            ['name' => '新增']
        ];

        return view('pages.home.news.form', [
            'position' => $position,
            'item' => new News,
            'route' => route('news.store'),
            'update' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\NewsPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '最新消息公告', 'url' => route('news.back')],
            ['name' => '預覽']
        ];

        $item = new News;
        $item->announce_start = $request->announceStart;
        $item->announce_end = $request->announceEnd;
        $item->title = $request->title;
        $item->sort = $request->sort;
        $item->content = $request->content;
        $item->organizer = $request->organizer;
        $item->contractor = $request->contractor;
        $item->contact_phone = $request->contactPhone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        if ($request->hasFile('attachs')) {
            foreach ($request->attachs as $attach) {
                $newAttach = new Attach;
                $newAttach->news_id = $item->id;
                $newAttach->name = $attach->getClientOriginalName();
                $newAttach->path = $attach->store('public/attachs/news');
                $newAttach->created_by = session('userID');
                $newAttach->save();
            }
        }

        return view('pages.home.news.preview', [
            'position' => $position,
            'item' => $item,
            'attachs' => Attach::where('news_id', $item->id)->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = [
            ['name' => '首頁', 'url' => route('Index')],
            ['name' => '最新消息公告', 'url' => route('news.index')],
        ];
        return view('pages.home.news.show', [
            'position' => $position,
            'item' => News::where('id', $id)->first(),
            'attachs' => Attach::where('news_id', $id)->get(),
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
            ['name' => '最新消息公告', 'url' => route('news.back')],
            ['name' => '新增']
        ];

        return view('pages.home.news.form', [
            'position' => $position,
            'route' => route('news.update', $id),
            'update' => true,
            'item' => News::find($id),
            'attachs' => Attach::where('news_id', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\NewsPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '最新消息公告', 'url' => route('news.back')],
            ['name' => '預覽']
        ];

        $item = News::find($id);
        $item->announce_start = $request->announceStart;
        $item->announce_end = $request->announceEnd;
        $item->title = $request->title;
        $item->sort = $request->sort;
        $item->content = $request->content;
        $item->organizer = $request->organizer;
        $item->contractor = $request->contractor;
        $item->contact_phone = $request->contactPhone;
        $item->updated_by = session('userID');
        $item->save();

        if ($request->hasFile('attachs')) {
            foreach ($request->attachs as $attach) {
                $newAttach = new Attach;
                $newAttach->news_id = $item->id;
                $newAttach->name = $attach->getClientOriginalName();
                $newAttach->path = $attach->store('public/attachs/news');
                $newAttach->created_by = session('userID');
                $newAttach->save();
            }
        }

        return view('pages.home.news.preview', [
            'position' => $position,
            'item' => $item,
            'attachs' => Attach::where('news_id', $item->id)->get(),
        ]);
    }

    /**
     * 切換公告顯示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleShow($id)
    {
        $item = News::find($id);
        $item->is_show = $item->is_show ? false : true;
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attachs = Attach::where('news_id', $id)->get();

        foreach ($attachs as $attach) {
            $this->destroyAttach($attach->id);
        }

        $item = News::find($id);
        $item->delete();
    }

    /**
     * Remove the specified attach from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAttach($id)
    {
        $attach = Attach::find($id);

        $path = str_replace('storage/', 'public/', $attach->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $attach->delete();
    }
}
