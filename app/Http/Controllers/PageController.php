<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WWW\Page;

class PageController extends Controller
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
            case 'safeweb':
                $this->theme = '網站安全政策宣告';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.other');
                break;
            case 'safeinfo':
                $this->theme = '資訊安全政策';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.other');
                break;
            case 'openinfo':
                $this->theme = '政府資訊公開';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.other');
                break;
            case 'privacy':
                $this->theme = '隱私權保護政策宣告';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.other');
                break;
            case 'statusEdu':
                $this->theme = '教育現況';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'fundEdu':
                $this->theme = '教育經費';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'charedu':
                $this->theme = '品格教育';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'registerkg':
                $this->theme = '立案園所';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'unregisterkg':
                $this->theme = '未立案機構';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'allowancekg':
                $this->theme = '符合補助要件園所';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'exckg':
                $this->theme = '績優園所';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'abolishmentkg':
                $this->theme = '撤銷/廢止園所';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.eduNow');
                break;
            case 'preview':
                $this->theme = '預告統計發布時間表';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.people');
                break;
            case 'accuse':
                $this->theme = '檢舉管道';
                array_push(
                    $this->position,
                    ['name' => '便民服務'],
                    ['name' => '廉政服務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.people');
                break;
            case 'service':
                $this->theme = '為民服務窗口';
                array_push($this->position, ['name' => $this->theme]);
                $this->sidebar = config('www.menu.people');
                break;
            case 'mayor':
                $this->theme = '市長的話';
                array_push(
                    $this->position,
                    ['name' => '組織介紹'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.intro');
                break;
            case 'organization':
            default:
                $this->theme = '教育局組織架構';
                array_push(
                    $this->position,
                    ['name' => '組織介紹'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.intro');
                break;
        }
    }

    /**
     * 顯示前台頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        $this->setPageInfo($page);

        $item = Page::where('title', $this->theme)->first();
        return view('pages.page.index', [
            'position' => $this->position,
            'sidebar' => $this->sidebar,
            'item' => $item,
        ]);
    }

    /**
     * 顯示後台頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function back($page)
    {
        $this->setPageInfo($page, true);

        $item = Page::where('title', $this->theme)->first();
        return view('pages.page.back', [
            'position' => $this->position,
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Page::find($id);
        $item->content = $request->content;
        $item->updated_by = session('userID');

        return $item->save() ? 'success': 'error';
    }
}
