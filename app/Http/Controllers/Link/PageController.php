<?php

namespace App\Http\Controllers\Link;

use App\Http\Controllers\Controller;
use App\WWW\LinkSort;
use App\WWW\Link;

class PageController extends Controller
{
    // 說明，提供網站使用者資訊
    private $description = '';

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin');
    }

    /**
     * 三層後台
     *
     * @return void
     */
    public function back($page)
    {
        switch ($page) {
            case 'official':
                $theme = '教育公務';
                break;
            case 'resource':
            default:
                $theme = '教學資源';
                break;
        }

        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => $theme],
        ];

        return view('pages.link.back', [
            'position' => $position,
            'theme' => $theme,
            'items' => LinkSort::where('theme', $theme)->orderBy('priority')->get(),
        ]);
    }

    /**
     * 兩層後台
     *
     * @return \Illuminate\Http\Response
     */
    public function subBack($page)
    {
        switch ($page) {
            case 'recruitment':
                $theme = '人事徵聘';
                break;
            case 'publicinfo':
            default:
                $theme = '政府公開資訊';
                break;
        }

        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => $theme],
        ];

        return view('pages.link.subBack', [
            'position' => $position,
            'theme' => $theme,
            'items' => Link::where('sort', $theme)->orderBy('priority')->get(),
            'description' => $this->description
        ]);
    }

}
