<?php

namespace App\Http\Controllers\Intro;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PersonalDutyPost;
use App\Http\Controllers\Controller;
use App\WWW\PersonalDuty;
use App\Unit;

class PersonalDutyController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checklogin')->except('show');
    }

    /**
     * Instantiate a new controller instance.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function back($id)
    {
        $unit = Unit::find($id);
        $personalDuties = PersonalDuty::where('unit_id', $id)
                            ->orderBy('priority', 'asc')
                            ->get();
        session([
            'nowDutyID' => $unit->id,
            'nowDutyName' => $unit->name2,
            'nowDutyEngName' => $unit->engName
        ]);

        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '組織業務人員簡介', 'url' => route('duty.back')],
            ['name' => $unit->name2],
        ];

        return view('pages.intro.duties.personalDuty', [
            'position' => $position,
            'unit' => $unit,
            'personalDuties' => $personalDuties,
        ]);
    }

    /**
     * 顯示人員執掌新增表單
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '各科室業務簡介', 'url' => route('duty.back')],
            ['name' => session('nowDutyName')],
            ['name' => '新增人員執掌'],
        ];

        $units = Unit::whereIn('sort_id', [1, 5])
                    ->orderBy('sort_id', 'asc')
                    ->orderBy('u_id', 'asc')
                    ->get();

        return view('pages.intro.duties.formPersonalDuty', [
            'position' => $position,
            'units' => $units,
            'personalDuty' => new PersonalDuty,
            'route' => route('personalduty.store'),
        ]);
    }

    /**
     * 新增人員職掌
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalDutyPost $request)
    {
        $personalDuty = new PersonalDuty;

        // 儲存大頭貼
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/intro');
            $personalDuty->img_path = str_replace('public/', 'storage/', $path);
        }

        $personalDuty->name = $request->name;
        $personalDuty->unit_id = $request->unitID;
        $personalDuty->position = $request->position;
        $personalDuty->telephone = $request->telephone;
        $personalDuty->telephone_extension = $request->telephone_extension;
        $personalDuty->direct_telephone = $request->direct_telephone;
        $personalDuty->fax = $request->fax;
        $personalDuty->email = $request->email;
        $personalDuty->agent = $request->agent;
        $personalDuty->duty = $request->duty;
        $personalDuty->priority = 1 + PersonalDuty::count('id');
        $personalDuty->created_by = session('userID');
        $personalDuty->updated_by = session('userID');
        $personalDuty->save();

        $unit = Unit::where('id', $personalDuty->unit_id)
                    ->select('id', 'name2', 'engName')
                    ->first();

        session([
            'nowDutyID' => $unit->id,
            'nowDutyName' => $unit->name2,
            'nowDutyEngName' => $unit->engName
        ]);

        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '各科室業務簡介', 'url' => route('duty.back')],
            ['name' => session('nowDutyName')],
            ['name' => '人員執掌預覽'],
        ];

        return view('pages.intro.duties.previewPersonalDuty',[
            'position' => $position,
            'personalDuty' => $personalDuty,
            'unit' => $unit
        ]);
    }

    /**
     * 顯示該科室內的人員執掌
     *
     * @param  int  $unitID
     * @return \Illuminate\Http\Response
     */
    public function show($unitID)
    {
        $personalDuties = PersonalDuty::where('unit_id', $unitID)
                            ->orderBy('priority', 'asc')
                            ->get();

        foreach ($personalDuties as $key=>$personalDuty) {
            if (Storage::exists($personalDuty->img_path)) {
                $personalDuties[$key]->img_path = asset($personalDuty->img_path);
            } else {
                $personalDuties[$key]->img_path = null;
            }
        }

        $unitName = Unit::where('id', $unitID)->select('name1')->first()->name1;
        return [
            'name' => $unitName,
            'personalDuties' => $personalDuties
        ];
    }

    /**
     * 顯示指定的人員執掌修改
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '各科室業務簡介', 'url' => route('duty.back')],
            ['name' => session('nowDutyName')],
            ['name' => '人員職掌'],
        ];

        $personalDuty = PersonalDuty::where('id', $id)->first();
        $unit = Unit::where('id', $personalDuty->unit_id)
                    ->select('id', 'name2')
                    ->first();

        $units = Unit::whereIn('sort_id', [1, 5])
                    ->orderBy('sort_id', 'asc')
                    ->orderBy('u_id', 'asc')
                    ->get();

        return view('pages.intro.duties.formPersonalDuty', [
            'position' => $position,
            'personalDuty' => $personalDuty,
            'units' => $units,
            'route' => route('personalduty.update', $personalDuty->id),
            'update' => true
        ]);
    }

    /**
     * 更新指定的人員執掌內容
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalDutyPost $request, $id)
    {
        $position = [
            ['name' => '網站地圖', 'url' => route('sitemaps.back')],
            ['name' => '組織介紹'],
            ['name' => '各科室業務簡介', 'url' => route('duty.back')],
            ['name' => session('nowDutyName')],
            ['name' => '人員執掌預覽'],
        ];

        $item = PersonalDuty::find($id);

        // 儲存大頭貼
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/intro');

            if (Storage::exists($item->img_path)) {
                Storage::delete($item->img_path);
            }

            $item->img_path = str_replace('public/', 'storage/', $path);
        }

        $item->name                 = $request->name;
        $item->unit_id              = $request->unitID;
        $item->position             = $request->position;
        $item->telephone            = $request->telephone;
        $item->telephone_extension  = $request->telephone_extension;
        $item->direct_telephone     = $request->direct_telephone;
        $item->fax                  = $request->fax;
        $item->email                = $request->email;
        $item->agent                = $request->agent;
        $item->duty                 = $request->duty;
        $item->updated_by           = session('userID');
        $item->save();

        $unit = Unit::where('id', $item->unit_id)
                    ->select('id', 'name2', 'engName')
                    ->first();

        return view('pages.intro.duties.previewPersonalDuty',[
            'position' => $position,
            'personalDuty' => $item,
            'unit' => $unit
        ]);
    }

    /**
     * 刪除指定的人員執掌
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PersonalDuty::find($id);
        $path = str_replace('storage/', 'public/', $item->img_path);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $item->delete();
    }

    /**
     * 設定科室排序
     *
     * @return \Illuminate\Http\Response
     */
    public function priority($id, $number)
    {
        $item = PersonalDuty::find($id);
        $item->priority = $number;
        $item->save();
    }
}
