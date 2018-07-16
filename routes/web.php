<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\Unit;

// 局網首頁
Route::get('/', 'IndexController@index')->name('Index');

// 局網首頁
Route::get('search', function(Request $request) {
    return view('pages.search', ['q' => $request->q]);
})->name('search');
// Route::get('/test', function(Request $request) {
    // return phpinfo();
// });


// Route::get('portal', function (Request $request) {
        // session([
            // 'logined' => true,
            // 'unit_id' => 123,
            // 'userName' => 123,
            // 'userID' => 'a9911131'
        // ]);

        // return redirect()->route('sitemaps.back');
// })->name('portal');


// 導入
Route::post('portal', function (Request $request) {
    $sID = DB::connection('pass')
        ->table('session_data')
        ->where('u_id', $request->u_id)
        ->orderBy('time', 'desc')
        ->value('s_id');

    if (md5(strrev($sID)) === $request->ss_id) {
        $row = DB::connection('pass')
            ->table('edu_user')
            ->where('us_id', $request->u_id)
            //->where('sch_id', null)  20171023關閉限定老師無法登入
            ->select('us_name', 'sch_id', 'unit_id', 'us_id')
            ->first();

        session([
            'logined' => true,
            'unit_id' => $row->unit_id,
            'userName' => $row->us_name,
            'userID' => $row->us_id
        ]);

        return redirect()->route('sitemaps.back');
    } else {
        return redirect()->to('https://teos.tyc.edu.tw');
    }
})->name('portal');

// 網站地圖
Route::get('/sitemaps', 'SitemapsController@index')->name('sitemaps');
Route::get('/sitemaps/back', 'SitemapsController@back')->name('sitemaps.back');

/************************pages table******************************/

// 前台頁面
Route::get('page/{page}', 'PageController@index')->name('page.index');

// 後台頁面
Route::get('page/{page}/back', 'PageController@back')->name('page.back');

// update
Route::resource('page', 'PageController', [
    'only' => ['update']
]);

/************************首頁Home******************************/

/**
 * 最新消息
 */
Route::get('news/back', 'Home\NewsController@back')->name('news.back');
Route::delete('news/attach/{id}', 'Home\NewsController@destroyAttach')->name('news.attach.delete');
Route::patch('news/toggle/{id}', 'Home\NewsController@toggleShow')->name('news.toggle');
Route::resource('news', 'Home\NewsController');

/**
 * 常見問題
 */
Route::get('qa/back', 'QAController@back')->name('qa.back');
Route::resource('qa', 'QAController', [
    'only' => ['index', 'show', 'store', 'update', 'destroy']
]);

// 政策宣導後台
Route::get('policy/back', 'Home\PolicyController@back')->name('policy.back');
Route::delete('policy/attach/{id}', 'Home\PolicyController@destroyAttach')->name('policy.attach.delete');
Route::patch('policy/toggle/{id}', 'Home\PolicyController@toggleShow')->name('policy.toggle');
Route::resource('policy', 'Home\PolicyController');

// 教育新聞
Route::get('edunews/back', 'Home\EduNewsController@back')->name('edunews.back');
Route::patch('edunews/toggle/{id}', 'Home\EduNewsController@toggleShow')->name('edunews.toggle');
Route::resource('edunews', 'Home\EduNewsController');

// 跑馬燈後台管理頁面
Route::get('marquee/back', 'Home\MarqueeController@back')->name('marquee.back');
Route::resource('marquee', 'Home\MarqueeController', [
    'except' => ['index', 'show']
]);

// 幻燈片後台管理頁面
Route::get('carousel/back', 'Home\CarouselController@back')->name('carousel.back');
Route::resource('carousel', 'Home\CarouselController', [
    'except' => ['index', 'show']
]);

/************************各級學校******************************/
Route::get('schools/back', 'SchoolsController@back')->name('schools.back');
Route::get('schools/all', 'SchoolsController@all')->name('schools.all');
Route::post('schools/search', 'SchoolsController@search')->name('schools.search');
Route::post('schools/searchSch', 'SchoolsController@searchSch')->name('schools.searchSch');
Route::resource('schools', 'SchoolsController', [
    'except' => ['show']
]);

/************************學區資訊******************************/
Route::get('district/back', 'DistrictController@back')->name('district.back');
Route::post('district/addYear', 'DistrictController@addYear')->name('district.addYear');
Route::get('district/{year}/{area}', 'DistrictController@show')->name('district.show');
Route::resource('district', 'DistrictController', [
    'except' => ['create', 'edit', 'update', 'show', 'delete']
]);





// 活動看板後台管理頁面
Route::get('advimg/back', 'Home\AdvimgController@back')->name('advimg.back');
Route::resource('advimg', 'Home\AdvimgController', [
    'except' => ['index', 'show']
]);

//市立幼兒園後台管理頁面
Route::get('citykg/{page}/back', 'CitykgController@back')->name('citykg.back');
// 市立幼兒園前台頁面
Route::get('citykg/{page}', 'CitykgController@index')->name('citykg.index');

// 市立幼兒園update
Route::resource('citykg', 'CitykgController', [
    'only' => ['update']
]);
/************************組織介紹******************************/

// 品格教育
Route::get('charedu/back', 'EduNow\CharEduController@back')->name('charedu.back');
Route::resource('charedu', 'EduNow\CharEduController', [
    'only' => ['index']
]);

/************************組織介紹******************************/

// 局長介紹
Route::get('/director/back', 'Intro\DirectorController@back')->name('director.back');
Route::resource('director', 'Intro\DirectorController', [
    'only' => ['index', 'update']
]);

// 副局長介紹
Route::get('/vicedirector/back', 'Intro\ViceDirectorController@back')->name('vicedirector.back');
Route::resource('vicedirector', 'Intro\ViceDirectorController', [
    'only' => ['index', 'update']
]);

// 主任秘書介紹
Route::get('/chiefsecretary/back', 'Intro\ChiefSecretaryController@back')->name('chiefsecretary.back');
Route::resource('chiefsecretary', 'Intro\ChiefSecretaryController', [
    'only' => ['index', 'update']
]);

// 組織業務人員簡介
Route::get('duty/back', 'Intro\DutyController@back')->name('duty.back');
// 科室排序
Route::patch('duty/{id}/priority/{number}', 'Intro\DutyController@priority')->name('duty.priority');
// 科室設定頁面
Route::patch('duty/toggle/{id}', 'Intro\DutyController@toggleShow')->name('duty.toggle');
Route::resource('duty', 'Intro\DutyController', [
    'except' => ['create', 'edit', 'destroy']
]);

// 各科室人員職掌
Route::get('duty/back/{id}', 'Intro\PersonalDutyController@back')->name('personalduty.back');
// 人員職掌排序
Route::patch('personalduty/{id}/priority/{number}', 'Intro\PersonalDutyController@priority')->name('duty.priority');
Route::resource('personalduty', 'Intro\PersonalDutyController', [
    'except' => ['index']
]);

/************************連結相關******************************/

// 三層連結設定
Route::get('/link/{page}/back', 'Link\PageController@back')->name('link.back');

// 兩層連結設定
Route::get('/link/{page}/subback', 'Link\PageController@subBack')->name('link.subBack');
// 排序, 僅限subBack使用
Route::patch('/link/{id}/priority/{number}', 'Link\LinkController@priority')->name('link.priority');

Route::resource('linksort', 'Link\SortController', [
    'only' => ['store', 'show', 'destroy']
]);

// 超連結，會使用到此controller的頁面皆有標記，LinkController
Route::resource('link', 'Link\LinkController', [
    'only' => ['store', 'update', 'destroy']
]);

/**
 * 檔案管理相關
 */
Route::get('/folder/{page}/back', 'File\FolderController@back')->name('folder.back');
Route::get('/folder/{page}/select', 'File\FolderController@index')->name('folder.index');
Route::resource('folder', 'File\FolderController', [
    'only' => ['store', 'show']
]);

Route::resource('file', 'File\FileController', [
    'only' => ['store', 'show', 'destroy']
]);

/**
 * 廉政專區>影片專區
 */
Route::get('video/back', 'VideoController@back')->name('video.back');
// 排序
Route::patch('video/{id}/priority/{number}', 'VideoController@priority')->name('video.priority');

Route::resource('video', 'VideoController', [
    'only' => ['index', 'store', 'destroy']
]);        

Route::get('videolink/back', 'VideolinkController@back')->name('videolink.back');
Route::resource('videolink', 'VideolinkController');



/*************************業務專區******************************/

Route::get('/business/{page}', 'Business\BusinessController@index')->name('business.index');
Route::get('/business/{page}/back', 'Business\BusinessController@back')->name('business.back');

Route::resource('business', 'Business\BusinessController', [
    'only' => ['update']
]);

Route::delete('business/attach/{id}', 'Business\BuController@destroyAttach')->name('business.attach.delete');

/************************JSON******************************/

/**
 * 個資保護作業
 */
Route::get('pdata/back', 'PDataController@back')->name('pdata.back');
Route::resource('pdata', 'PDataController', [
    'only' => ['index', 'show', 'store', 'update', 'destroy']
]);


/**
 * 科室選項，回傳JSON
 */
Route::get('sections', function() {
    return Unit::whereIn('sort_id', [1, 5])
            ->select('id', 'name2')
            ->orderBy('sort_id', 'asc')
            ->orderBy('u_id', 'asc')
            ->get();
});

// 登出
Route::get('/logout', function(Request $request) {
    $request->session()->flush();
    return redirect()->route('Index');
})->name('logout');
