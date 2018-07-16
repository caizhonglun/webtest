<?php

namespace App\Http\Controllers\Intro;

use App\Http\Controllers\Controller;
use App\Unit;
use App\WWW\PersonalDuty;
use App\Http\Requests\DutyPost;

class DutyController extends Controller
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
            ['name' => '組織介紹'],
            ['name' => '組織業務人員簡介'],
        ];

        $units = Unit::whereIn('sort_id', [1, 5])
                    ->where('is_show', true)
                    ->orderBy('priority', 'asc')
                    ->get();

        return view('pages.intro.duties.index', [
            'position' => $position,
            'sidebar' => config('www.menu.intro'),
            'units' => $units,
        ]);
    }

    /**
     * 提供該科室的科室執掌資訊
     *
     * @param  int  $unitID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Unit::where('id', $id)->select('name1', 'duty')->first();
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
            ['name' => '組織業務人員簡介'],
        ];

        $units = Unit::whereIn('sort_id', [1, 5])
                    ->orderBy('priority', 'asc')
                    ->get();

        return view('pages.intro.duties.back', [
            'position' => $position,
            'units' => $units,
        ]);
    }

    /**
     * 新增科室執掌
     *
     * @param  App\Http\Requests\DutyPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DutyPost $request)
    {
        $item = new Unit;
        $item->sort_id = $request->sort_id;
        $item->city = '桃園市';
        $item->name = $request->name;
        $item->name1 = $request->name1;
        $item->name2 = $request->name2;
        $item->engName = $request->engName;
        $item->duty = $request->duty;
        $item->priority = 1 + Unit::count('id');
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        return $item->save() ? 'success' : 'error';
    }

    /**
     * 更新科室執掌
     *
     * @param  App\Http\Request\DutyPost  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DutyPost $request, $id)
    {
        $item = Unit::find($id);
        $item->sort_id = $request->sort_id;
        $item->name = $request->name;
        $item->name1 = $request->name1;
        $item->name2 = $request->name2;
        $item->engName = $request->engName;
        $item->duty = $request->duty;
        $item->updated_by = session('userID');
        return $item->save() ? 'success' : 'error';
    }

    /**
     * 切換科室顯示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleShow($id)
    {
        $item = Unit::find($id);
        $item->is_show = $item->is_show ? false : true;
        $item->save();
    }

    /**
     * 設定科室排序
     *
     * @return \Illuminate\Http\Response
     */
    public function priority($id, $number)
    {
        $item = Unit::find($id);
        $item->priority = $number;
        $item->save();
    }
}
