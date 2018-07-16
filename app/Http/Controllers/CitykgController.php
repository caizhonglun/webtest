<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WWW\Citykg;


class CitykgController extends Controller
{
    
    private $theme = '';
    private $sidebar = [];
    private $position = [];

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
     * 設定相關資訊
     *
     * @param String $page
     * @param boolean $isBack
     * @return void
     */
    
        private function setPageInfo($page, $isBack=false) {
        $this->position = [
            [
                'name' => $isBack ?  '網站地圖' : '首頁',
                'url' => $isBack ? route('sitemaps.back') : route('Index')
            ]
        ];
        switch ($page) {
           
            case 'taoyuan':
                $this->theme = '桃園幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'zhongli':
                $this->theme = '中壢幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'zhonglihsrail':
                $this->theme = '中壢高鐵幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'daxi':
                $this->theme = '大溪幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'yangmei':
                $this->theme = '楊梅幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'luzhu':
                $this->theme = '蘆竹幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'dayuan':
                $this->theme = '大園幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'guishan':
                $this->theme = '龜山幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'bade':
                $this->theme = '八德幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'longtan':
                $this->theme = '龍潭幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'pingzhen':
                $this->theme = '平鎮幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'xinwu':
                $this->theme = '新屋幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'guanyin':
                $this->theme = '觀音幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'nankan':
            default:
                $this->theme = '南崁幼兒園';
                array_push(
                    $this->position,
                    ['name' => '市立幼兒園'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.eduNow');
                break;

        }
    }
    
     public function index($page)
    {
        $this->setPageInfo($page);

        $item = Citykg::where('title', $this->theme)->first();
        
        return view('pages.citykg.index', [
            'position' => $this->position,
            'sidebar' => $this->sidebar,
            'item' => $item,
        ]);
    }
    
     public function back($page)
    {
         $this->setPageInfo($page, true);

        $item = Citykg::where('title', $this->theme)->first();
        
        return view('pages.citykg.back', [
            'position' => $this->position,
            'item' => $item,
            'sidebar' => $this->sidebar,
            'route' => route('citykg.update',"$item->id"),
        ]);
    }
    
      public function update(Request $request, $id)
    {
        $item = Citykg::find($id);
        switch($request->kinds)
        {
            case '1':
                $item->content1 = $request->announce;  
            break;
            case '2':
                $item->content2 = $request->intro;  
            break;
            case '3':
                $item->content3 = $request->history;  
            break;
            case '4':
                $item->content4 = $request->organization;  
            break;
            case '5':
                $item->content5 = $request->notice;  
            break;
            case '6':
                $item->content6 = $request->environment;  
            break;
        }
        $item->updated_by = session('userID');
        $item->save();
        
        return redirect()->back();
    }
}
