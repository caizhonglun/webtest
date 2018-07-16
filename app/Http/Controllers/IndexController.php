<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WWW\Carousel;
use App\WWW\News;
use App\WWW\Policy;
use App\WWW\EduNews;
use App\WWW\Link;
use App\WWW\Advimg;

class IndexController extends Controller
{
    /**
     * 局網首頁
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 最新消息
        $news = News::where('is_show', true)
                ->where('announce_start', '<=', date('Y-m-d'))
                ->where('announce_end', '>=', date('Y-m-d'))
                ->orderBy('announce_start', 'desc')
                ->take(10)
                ->get();
                
        //維修公告
        
        $maintain = News::where('is_show', true)
                ->where('announce_start', '<=', date('Y-m-d'))
                ->where('announce_end', '>=', date('Y-m-d'))
                ->where('sort', '維修')
                ->orderBy('announce_end', 'desc')
                ->get();

        // 教育新聞
        $eduNews = EduNews::where('is_show', true)
                ->orderBy('activity_start', 'desc')
                ->limit(3)
                ->get();

        // 政策宣導
        $policies = Policy::where('is_show', true)
                    ->orderBy('updated_at')
                    ->get();

        // 政府公開資訊
        $publicInfo = Link::orderBy('title', 'desc')
                    ->where('sort', '政府公開資訊')
                    ->get();
        
        // 活動看板資訊
        $advimg = advimg::orderBy('id', 'asc')
                    ->get();

        return view('pages.index.index', [
            'carousel'  => Carousel::get(),
            'news'      => $news,
            'maintain'  => $maintain,
            'eduNews'   => $eduNews,
            'policies'  => $policies,
            'publicInfo'=> $publicInfo,
            'advimg'=> $advimg,
        ]);
    }
}
