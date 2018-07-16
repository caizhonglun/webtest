<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\WWW\Marquee;
use App\WWW\LinkSort;
use App\WWW\Link;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.header', function ($view) {
            return $view->with('menu', $this->getLayoutMenu());
        });

        View::composer('pages.sitemaps.index', function ($view) {
            return $view->with('menu', $this->getLayoutMenu());
        });

        View::composer('partials.navbar', function ($view) {
            return $view->with('menu', $this->getBackMenu());
        });

        View::composer('pages.sitemaps.back', function ($view) {
            return $view->with('menu', $this->getBackMenu());
        });

        View::composer('partials.marquee', function ($view) {
            return $view->with('marquee', Marquee::get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * 對外網頁menu
     *
     * @return void
     */
    public function getLayoutMenu()
    {
        $menu = config('www.menu');
        // 移除other項目
        unset($menu['other']);

        // 人事徵聘
        $menu['recruitment']['next'] = Link::where('sort', '人事徵聘')->orderBy('priority')->get()->toArray();

        $linkSorts = LinkSort::select('id', 'name')->where('theme', '教學資源')->get();
        foreach ($linkSorts as $key => $linkSort) {
            $menu['resource']['next'][$key]['title'] = $linkSort->name;
            $menu['resource']['next'][$key]['next'] = Link::where('sort_id', $linkSort->id)->get()->toArray();
        }

        $linkSorts = LinkSort::select('id', 'name')->where('theme', '教育公務')->get();
        foreach ($linkSorts as $key => $linkSort) {
            $menu['official']['next'][$key]['title'] = $linkSort->name;
            $menu['official']['next'][$key]['next'] = Link::where('sort_id', $linkSort->id)->get()->toArray();
        }


        return $menu;
    }

    /**
     * 後台網頁menu
     *
     * @return void
     */
    public function getBackMenu()
    {
        $menu = config('www.backMenu');
        return $menu;
    }
}
