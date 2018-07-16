<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\School;

class SchoolsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('index', 'all', 'searchSch');
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
            ['name' => '教育現況'],
            ['name' => '各級學校'],
        ];

        return view('pages.schools.index', [
            'theme'    => '各級學校',
            'position' => $position,
            'sidebar' => config('www.menu.eduNow'),
            'items'    => School::where('city', 'like', '%桃園市%')
                                ->orderBy('area', 'sort_id', 'updated_at')
                                ->paginate(30)
        ]);
    }

    /**
     * search schools for index.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchSch(Request $request)
    {
        $position = [
            ['name' => '首頁', 'url' => route('Index')],
            ['name' => '教育現況'],
            ['name' => '各級學校'],
        ];

        return view('pages.schools.index', [
            'theme'    => '各級學校',
            'position' => $position,
            'sidebar' => config('www.menu.eduNow'),
            'items'    => School::where('city', 'like', '%桃園市%')
                                ->Where('name', 'like', "%{$request->school}%")
                                ->orWhere('name1', 'like', "%{$request->school}%")
                                ->orWhere('name2', 'like', "%{$request->school}%")
                                ->orderBy('area', 'sort_id', 'updated_at')
                                ->paginate(10)
        ]);
    }

    /**
     * get all schools id and name.
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return School::select('id', 'name')->get();
    }

    /**
     * search schools for back.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '教育現況'],
            ['name' => '各級學校'],
        ];

        return view('pages.schools.back', [
            'theme'    => '各級學校',
            'position' => $position,
            'items'    => School::where('city', 'like', '%桃園市%')
                          ->where(function ($query) {
                                $query->where('name', 'like', "%{$request->school}%")
                                      ->orWhere('name1', 'like', "%{$request->school}%")
                                      ->orWhere('name2', 'like', "%{$request->school}%");
                            })
                          ->orderBy('updated_at', 'desc')
                          ->paginate(10)
        ]);
    }

    /**
     * 後台
     * 
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return $this->search(new Request());
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
            ['name' => '教育現況'],
            ['name' => '各級學校'],
            ['name' => '新增']
        ];

        return view('pages.schools.form', [
            'theme'    => '新增',
            'position' => $position,
            'route'    => route('schools.store'),
            'isUpdate' => false,
            'item'     => new School(),
            'sch_sorts'=> DB::table('sch_sort')->orderBy('id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '教育現況'],
            ['name' => '各級學校', 'url' => route('schools.back')],
            ['name' => '預覽']
        ];

        $item = new School();
        $item->e_no = $request->e_no;
        $item->g_no = $request->g_no;
        $item->city = $request->city;
        $item->area = $request->area;
        $item->name = $request->name;
        $item->name1 = $request->name1;
        $item->name2 = $request->name2;
        $item->engName = $request->engName;
        $item->sort_id = $request->sort_id;
        $item->address = $request->address;
        $item->longitude = $request->longitude;
        $item->latitude = $request->latitude;
        $item->save();

        return view('pages.schools.preview', [
            'position' => $position,
            'theme'    => '預覽',
            'item'     => $item,
            'sort'     => DB::table('sch_sort')->where('id', $item->sort_id)->first()->sort
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
            ['name' => '教育現況'],
            ['name' => '各級學校', 'url' => route('schools.back')],
            ['name' => '修改']
        ];

        return view('pages.schools.form', [
            'position' => $position,
            'theme' => '修改',
            'route'    => route('schools.update', $id),
            'isUpdate' => true,
            'item' => School::find($id),
            'sch_sorts'=> DB::table('sch_sort')->orderBy('id')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '教育現況'],
            ['name' => '各級學校', 'url' => route('schools.back')],
            ['name' => '預覽']
        ];

        $item = School::find($id);
        $item->e_no = $request->e_no;
        $item->g_no = $request->g_no;
        $item->city = $request->city;
        $item->area = $request->area;
        $item->name = $request->name;
        $item->name1 = $request->name1;
        $item->name2 = $request->name2;
        $item->engName = $request->engName;
        $item->sort_id = $request->sort_id;
        $item->address = $request->address;
        $item->longitude = $request->longitude;
        $item->latitude = $request->latitude;
        $item->save();

        return view('pages.schools.preview', [
            'position' => $position,
            'theme'    => '預覽',
            'item'     => $item,
            'sort'     => DB::table('sch_sort')->where('id', $item->sort_id)->first()->sort
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
        $item = School::find($id);
        $item->delete();
    }
}
