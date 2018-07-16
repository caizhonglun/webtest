<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; 
use App\Http\Requests\BusinessPost;
use App\WWW\Business;
use App\WWW\Attach;


class BusinessController extends Controller
{
    private $theme;
    private $position = [];
    private $folders = [];

    
   public function __construct()
    {
        $this->middleware('checklogin')->except('index');
    }
    
      private function setPageInfo($page, $isBack=false) {
        $this->position = [
            [
                'name' => $isBack ?  '網站地圖' : '首頁',
                'url' => $isBack ? route('sitemaps.back') : route('Index')
            ]
        ];

        switch ($page) {
                case 'preedu':
                $this->theme = '幼兒教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'priedu':
                $this->theme = '國小教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'secedu':
                $this->theme = '國中教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'highedu':
                $this->theme = '高中教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'alllifeedu':
                $this->theme = '終身教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'speedu':
                $this->theme = '特殊教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'infoedu':
                $this->theme = '資訊教育科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'people':
                $this->theme = '便民行政';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'physicaledu':
                $this->theme = '體育保健科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                 case 'facilityedu':
                $this->theme = '教育設施科';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                 case 'schsafe':
                $this->theme = '學輔校安室';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                 case 'personnel':
                $this->theme = '人事室';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'accounting':
                $this->theme = '會計室';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'political':
                $this->theme = '政風室';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                case 'secretary':
                $this->theme = '秘書室';
                array_push(
                    $this->position,
                    ['name' => '業務專區'],
                    ['name' => $this->theme]
                );
                $this->sidebar = config('www.menu.message');
               
                break;
                
                
           
        }


    }
    public function index($page)
    {
        $this->setPageInfo($page);
        $item = Business::where('title', $this->theme)->first();
        return view('pages.business.index', [
            'theme' => $this->theme,
            'position' => $this->position,
            'options'  => $this->folders,
            'item' => $item,
            'sidebar'  => $this->sidebar,
            'attachs' => Attach::where('business_id', $item->id)->get(),

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
        
        $item = Business::where('title', $this->theme)->first();
        
        return view('pages.business.back', [
            'theme' => $this->theme,
            'position' => $this->position,
            'item' => $item,
            'route' => route('business.update',"$item->id"),
            'sidebar' => $this->sidebar,
            'attachs' => Attach::where('business_id', $item->id)->get(),
            
        ]);
    }

    /**
     * create folder sort
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    
    public function update(Request $request, $id)
    {
        $item = Business::find($id);
 
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
            case '7':
                $item->name1 = $request->name1;
                $item->name2 = $request->name2;
                $item->name3 = $request->name3;
                $item->name4 = $request->name4;
                $item->name5 = $request->name5;
                $item->name6 = $request->name6;
            break;
        }
        $item->updated_by = session('userID');
        $item->save();
        
         if ($request->hasFile('attachs')) {
            foreach ($request->attachs as $attach) {
                $newAttach = new Attach;
                $newAttach->business_id = $item->id;
                $newAttach->name = $attach->getClientOriginalName();
                $newAttach->path = $attach->store('public/attachs/business');
                $newAttach->created_by = session('userID');
                $newAttach->save();
            }
        }
        
        return  redirect()->back();
    }
    
     public function destroyAttach($id)
    {
        $attach = Attach::find($id);

        $path = str_replace('storage/', 'public/', $attach->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $attach->delete();
    }
    
    public function destroy($id)
    {
        $attachs = Attach::where('business_id', $id)->get();

        foreach ($attachs as $attach) {
            $this->destroyAttach($attach->id);
        }

       
    }
    
    
    

 
}
