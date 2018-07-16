<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WWW\District;

/**
 * 不提供刪除功能，因為歷年的資區
 * 
 */
class DistrictController extends Controller
{
    private $theme = '學區資訊';

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
     * 取得資料庫中的學年
     * @return App\WWW\District
     */
    private function getYears()
    {
        return District::select(DB::raw('DISTINCT year'))->orderby('year', 'asc')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.district.index', [
            'theme' => $this->theme,
            'years' => $this->getYears(),
            'sidebar' => config('www.menu.eduNow'),
            'position' => [
                [ 'name' => '首頁', 'url' => route('Index')],
                [ 'name' => $this->theme ]
            ]
        ]);
    }

    /**
     * distric back page
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        return view('pages.district.back', [
            'theme' => $this->theme,
            'years' => $this->getYears(),
            'position' => [
                [ 'name' => '網站地圖', 'url' => route('sitemaps.back') ],
                [ 'name' => $this->theme ]
            ]
        ]);
    }

    /**
     * trigger addYear event to add areas about [district]
     */
    public function addYear() {
        $areas = config('www.areas');
        $data = [];

        foreach ($areas as $key => $area) {
            array_push($data, [
                'year' => District::count(DB::raw('DISTINCT year')) + 103,
                'area' => $area,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        District::insert($data);
    }

    /**
     * 儲存學區資訊content
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = District::where('year', $request->year)
                ->where('area', $request->area)->first();
        $item->content = $request->content;
        $item->save();
    }

    /**
     * 取得某年度某區域的學區資訊
     *
     * @param  string $year 學年
     * @param  string $area 地區
     * @return \Illuminate\Http\Response
     */
    public function show($year, $area)
    {
        return District::where('year', $year)
                        ->where('area', $area)
                        ->first();
    }
}
