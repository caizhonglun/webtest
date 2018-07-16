<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\EduNewsPost;
use App\WWW\Attach;
use App\WWW\EduNews;

class EduNewsController extends Controller
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
            ['name' => '教育新聞'],
        ];

        $items = EduNews::where('is_show', true)
                    ->orderBy('activity_start', 'desc')
                    ->paginate(20);

        return view('pages.home.eduNews.index', [
            'position' => $position,
            'items' => $items,
        ]);
    }

    /**
     * Display a listing of the resource in backend.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '教育新聞'],
        ];

        return view('pages.home.eduNews.back', [
            'position' => $position,
            'items' => EduNews::orderBy('activity_start', 'desc')
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
            ['name' => '教育新聞', 'url' => route('edunews.back')],
            ['name' => '新增']
        ];

        return view('pages.home.eduNews.form', [
            'position' => $position,
            'item' => new EduNews,
            'route' => route('edunews.store'),
            'update' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EduNewsPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EduNewsPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '教育新聞', 'url' => route('edunews.back')],
            ['name' => '預覽']
        ];

        $item = new EduNews;

        // store theme image
        $item->theme_img_path = $request
            ->file('themeImg')->store('public/eduNews');
        $item->activity_start = $request->activityStart;
        $item->activity_end = $request->activityEnd;
        $item->title = $request->title;
        $item->content = $request->content;
        $item->organizer = $request->organizer;
        $item->contractor = $request->contractor;
        $item->contact_phone = $request->contactPhone;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.eduNews.preview', [
            'position' => $position,
            'item' => $item,
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
            ['name' => '教育新聞', 'url' => route('edunews.index')],
        ];
        return view('pages.home.eduNews.show', [
            'position' => $position,
            'item' => EduNews::where('id', $id)->first(),
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
            ['name' => '教育新聞', 'url' => route('edunews.back')],
            ['name' => '修改']
        ];

        return view('pages.home.eduNews.form', [
            'position' => $position,
            'route' => route('edunews.update', $id),
            'update' => true,
            'item' => EduNews::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EduNewsPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EduNewsPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '教育新聞', 'url' => route('edunews.back')],
            ['name' => '預覽']
        ];

        $item = EduNews::find($id);

        // store theme image
        if ($request->hasFile('themeImg')) {
            // 移除舊圖檔
            $exPath = str_replace('storage/', 'public/', $request->theme_img_path);

            if (Storage::exists($exPath)) {
                Storage::delete($exPath);
            }

            $item->theme_img_path = $request
                    ->file('themeImg')->store('public/eduNews');
        }

        $item->activity_start = $request->activityStart;
        $item->activity_end = $request->activityEnd;
        $item->title = $request->title;
        $item->content = $request->content;
        $item->organizer = $request->organizer;
        $item->contractor = $request->contractor;
        $item->contact_phone = $request->contactPhone;
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.home.eduNews.preview', [
            'position' => $position,
            'item' => $item,
        ]);
    }

    /**
     * 切換新聞顯示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleShow($id)
    {
        $item = EduNews::find($id);
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
        $item = EduNews::find($id);
        $item->deleted_by = session('userID');
        $item->save();
        $item->delete();
    }
}
