<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WWW\Folder;
use App\WWW\File;

class FolderController extends Controller
{
    private $theme;
    private $position = [];
    private $folders = [];
    private $sidebar = [];

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
            case 'statistics':
                $this->theme = '統計專區';
                array_push(
                    $this->position,
                    ['name' => $this->theme]
                );

                $folderID = Folder::where('name', '統計專區')->first()->id;
                $this->sidebar = config('www.menu.people');
                break;
            case 'Administrative_rules':
                $this->theme = '行政規則(章)';
                array_push(
                    $this->position,
                    ['name' => $this->theme]
                );

                $folderID = Folder::where('name', '行政規則(章)')->first()->id;
                $this->sidebar = config('www.menu.message');
                break;
            case 'download':
                $this->theme = '檔案下載';
                array_push(
                    $this->position,
                    ['name' => $this->theme]
                );

                $folderID = Folder::where('name', '檔案下載')->first()->id;
                $this->sidebar = config('www.menu.people');
                break;
            case 'genderarea':
                $this->theme = '性別主流化專區';
                array_push(
                    $this->position,
                    ['name' => $this->theme]
                );

                $folderID = Folder::where('name', '性別主流化專區')->first()->id;
                $this->sidebar = config('www.menu.other');
                break;
            case 'ethicsfolder':
            default:
                $this->theme = '廉政專區';
                array_push(
                    $this->position,
                    ['name' => $this->theme],
                    ['name' => '檔案專區']
                );

                $folderID = Folder::where('name', '廉政專區')->first()->id;
                $this->sidebar = config('www.menu.people');
                break;
        }

        // 判斷前後台
        if ($isBack) {
            $this->folders[] = [
                'id' => $folderID,
                'name' => $this->theme,
                'open' => false,
                'children' => Folder::where('above', $folderID)
                                    ->get()->toArray()
            ];
        } else {
            $this->folders = Folder::where('above', $folderID)
                ->select('id', 'name')
                ->get();
        }
    }

    /**
     * 顯示檔案專區前台
     *
     * @param string $page
     * @return \Illuminate\Http\Response
     */
    public function index($page)
    {
        $this->setPageInfo($page);

        return view('pages.file.index', [
            'theme' => $this->theme,
            'position' => $this->position,
            'options'  => $this->folders,
            'sidebar'  => $this->sidebar,
        ]);
    }


    /**
     * 顯示檔案專區後台
     *
     * @param string $page
     * @return \Illuminate\Http\Response
     */
    public function back($page)
    {
        $this->setPageInfo($page, true);

        return view('pages.file.back', [
            'theme' => $this->theme,
            'position' => $this->position,
            'folders'  => $this->folders
        ]);
    }

    /**
     * create folder sort
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $item = new Folder;
        $item->above = $request->above;
        $item->layer = $request->layer;
        $item->name = $request->name;
        $result = $item->save();

        return $result ? 'success' : 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return File::where('folder_id', $id)->get();
    }
}
