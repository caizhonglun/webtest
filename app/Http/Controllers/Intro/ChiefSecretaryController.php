<?php

namespace App\Http\Controllers\Intro;

use App\Http\Requests\PersonalDutyPost;
use App\Http\Controllers\Controller;
use App\WWW\PersonalDuty;
use Illuminate\Support\Facades\Storage;

class ChiefSecretaryController extends Controller
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
            ['name' => '主任秘書簡介'],
        ];

        $chiefSecretary = PersonalDuty::where('position', '主任秘書')->first();

        return view('pages.intro.chiefSecretary.index', [
            'position' => $position,
            'sidebar' => config('www.menu.intro'),
            'chiefSecretary' => $chiefSecretary,
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
            ['name' => '主任秘書簡介'],
        ];

        $chiefSecretary = PersonalDuty::where('position', '主任秘書')->first();

        return view('pages.intro.chiefSecretary.back', [
            'position' => $position,
            'item' => $chiefSecretary
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
            ['name' => '主任秘書簡介', 'url' => route('chiefsecretary.back')],
            ['name' => '預覽'],
        ];

        // 儲存大頭貼
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/intro');
        }

        $chiefSecretary = PersonalDuty::where('id', $id)
                            ->where('position', '主任秘書')
                            ->first();

        $chiefSecretary->name = $request->name;
        if (isset($path)) {
            if (Storage::exists($chiefSecretary->img_path)) {
                Storage::delete($chiefSecretary->img_path);
            }
            $chiefSecretary->img_path = str_replace('public/', 'storage/', $path);
        }
        $chiefSecretary->telephone = $request->telephone;
        $chiefSecretary->telephone_extension = $request->telephone_extension;
        $chiefSecretary->direct_telephone = $request->direct_telephone;
        $chiefSecretary->fax = $request->fax;
        $chiefSecretary->email = $request->email;
        $chiefSecretary->education = $request->education;
        $chiefSecretary->experience = $request->experience;
        $chiefSecretary->honor = $request->honor;
        $chiefSecretary->updated_by = session('userID');
        $chiefSecretary->save();

        return view('pages.intro.chiefSecretary.preview', [
            'position' => $position,
            'chiefSecretary' => $chiefSecretary
        ]);
    }
}
