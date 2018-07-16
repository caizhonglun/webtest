<?php

namespace App\Http\Controllers\Intro;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PersonalDutyPost;
use App\Http\Controllers\Controller;
use App\WWW\Page;
use App\WWW\PersonalDuty;

class DirectorController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('index');
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
            ['name' => '組織介紹'],
            ['name' => '局長簡介'],
        ];

        $page = Page::where('title', '局長簡介')->select('content')->first();
        $director = PersonalDuty::where('position', '局長')->first();

        return view('pages.intro.director.index', [
            'position' => $position,
            'sidebar' => config('www.menu.intro'),
            'directorWords' => $page->content,
            'director' => $director,
        ]);
    }

    /**
     * Display back.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '局長簡介'],
        ];

        $page = Page::where('title', '局長簡介')->select('content')->first();
        $director = PersonalDuty::where('position', '局長')->first();

        return view('pages.intro.director.back', [
            'position' => $position,
            'directorWords' => $page->content,
            'item' => $director
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalDutyPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '局長簡介', 'url' => route('director.back')],
            ['name' => '預覽'],
        ];

        // 儲存大頭貼
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/intro');
        }

        $page = Page::where('title', '局長簡介')->first();
        $page->content = $request->directorWords;
        $page->save();

        $director = PersonalDuty::where('id', $id)
                        ->where('position', '局長')
                        ->first();

        $director->name = $request->name;
        if (isset($path)) {
            if (Storage::exists($director->img_path)) {
                Storage::delete($director->img_path);
            }

            $director->img_path = str_replace('public/', 'storage/', $path);
        }
        $director->telephone = $request->telephone;
        $director->telephone_extension = $request->telephone_extension;
        $director->direct_telephone = $request->direct_telephone;
        $director->fax = $request->fax;
        $director->email = $request->email;
        $director->education = $request->education;
        $director->experience = $request->experience;
        $director->honor = $request->honor;
        $director->updated_by = session('userID');
        $director->save();

        return view('pages.intro.director.preview', [
            'position' => $position,
            'director' => $director,
            'directorWords' => $request->directorWords
        ]);
    }
}
