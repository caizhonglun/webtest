<?php

namespace App\Http\Controllers\Intro;

use App\Http\Requests\PersonalDutyPost;
use App\Http\Controllers\Controller;
use App\WWW\PersonalDuty;
use Illuminate\Support\Facades\Storage;

class ViceDirectorController extends Controller
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
        $items = PersonalDuty::where('position', '副局長')->orderBy('priority')->get();

        $position = [
            ['name' => '首頁', 'url' => route('Index')],
            ['name' => '組織介紹'],
            ['name' => '副局長簡介'],
        ];

        return view('pages.intro.viceDirector.index', [
            'sidebar' => config('www.menu.intro'),
            'position' => $position,
            'viceDirectors' => $items,
        ]);
    }

    /**
     * Display back.
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        $items = PersonalDuty::where('position', '副局長')->orderBy('id')->get();
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '副局長簡介'],
        ];

        return view('pages.intro.viceDirector.back', [
            'position' => $position,
            'viceDirectors' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalDutyPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '副局長簡介', 'url' => route('vicedirector.back')],
            ['name' => '預覽']
        ];

        $item = PersonalDuty::where('id', $id)
                            ->where('position', '副局長')
                            ->first();

        // 儲存大頭貼
        if ($request->hasFile('thumbnail')) {
            if (Storage::exists($item->img_path)) {
                Storage::delete($item->img_path);
            }

            $item->img_path = $request->file('thumbnail')->store('public/intro');
        }
        $item->name = $request->name;
        $item->telephone = $request->telephone;
        $item->telephone_extension = $request->telephone_extension;
        $item->direct_telephone = $request->direct_telephone;
        $item->fax = $request->fax;
        $item->email = $request->email;
        $item->education = $request->education;
        $item->experience = $request->experience;
        $item->honor = $request->honor;
        $item->updated_by = session('userID');
        $item->save();

        return view('pages.intro.viceDirector.preview', [
            'position' => $position,
            'viceDirectors' => [$item]
        ]);
    }
}
