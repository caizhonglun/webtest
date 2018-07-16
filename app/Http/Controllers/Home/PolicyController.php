<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\PolicyPost;
use App\WWW\Attach;
use App\WWW\Policy;

class PolicyController extends Controller
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
            ['name' => '政策宣導'],
        ];

        $items = Policy::where('is_show', true)->get();

        return view('pages.home.policy.index', [
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
            ['name' => '政策宣導'],
        ];

        return view('pages.home.policy.back', [
            'position' => $position,
            'items' => Policy::paginate(15),
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
            ['name' => '政策宣導', 'url' => route('policy.back')],
            ['name' => '新增']
        ];

        return view('pages.home.policy.form', [
            'position' => $position,
            'item' => new Policy,
            'route' => route('policy.store'),
            'update' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PollicyPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyPost $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '政策宣導', 'url' => route('policy.back')],
            ['name' => '預覽']
        ];

        $item = new Policy;
        $item->title = $request->title;
        $item->content = $request->content;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $item->save();

        if ($request->hasFile('attachs')) {
            foreach ($request->attachs as $attach) {
                $path = $attach->store('public/attachs/policy');
                $path = str_replace('public/', 'storage/', $path);
                $newAttach = new Attach;
                $newAttach->policy_id = $item->id;
                $newAttach->name = $attach->getClientOriginalName();
                $newAttach->path = $path;
                $newAttach->created_by = session('userID');
                $newAttach->save();
            }
        }

        return view('pages.home.policy.preview', [
            'position' => $position,
            'item' => $item,
            'attachs' => Attach::where('policy_id', $item->id)->get(),
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
            ['name' => '政策宣導', 'url' => route('policy.index')],
        ];
        return view('pages.home.policy.show', [
            'position' => $position,
            'item' => Policy::where('id', $id)->first(),
            'attachs' => Attach::where('policy_id', $id)->get(),
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
            ['name' => '政策宣導', 'url' => route('policy.back')],
            ['name' => '新增']
        ];

        return view('pages.home.policy.form', [
            'position' => $position,
            'route' => route('policy.update', $id),
            'update' => true,
            'item' => Policy::find($id),
            'attachs' => Attach::where('policy_id', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PollicyPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '首頁'],
            ['name' => '政策宣導', 'url' => route('news.back')],
            ['name' => '預覽']
        ];

        $item = Policy::find($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->updated_by = session('userID');
        $item->save();

        if ($request->hasFile('attachs')) {
            foreach ($request->attachs as $attach) {
                $path = $attach->store('public/attachs/policy');
                $path = str_replace('public/', 'storage/', $path);
                $newAttach = new Attach;
                $newAttach->policy_id = $item->id;
                $newAttach->name = $attach->getClientOriginalName();
                $newAttach->path = $path;
                $newAttach->created_by = session('userID');
                $newAttach->save();
            }
        }

        return view('pages.home.policy.preview', [
            'position' => $position,
            'item' => $item,
            'attachs' => Attach::where('policy_id', $item->id)->get(),
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
        $item = Policy::find($id);
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
        $attachs = Attach::where('policy_id', $id)->get();

        foreach ($attachs as $attach) {
            $path = str_replace('storage/', 'public/', $attach->path);

            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            $attach->delete();
        }

        $item = Policy::find($id);
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
        $attach = Attach::where('id', $id)->first();

        $path = str_replace('storage/', 'public/', $attach->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $attach->delete();
    }
}
