<?php

namespace App\Http\Controllers\File;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FilePost;
use App\Http\Controllers\Controller;
use App\WWW\File;
use App\WWW\Attach;

class FileController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilePost $request)
    {
        $item = new File;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->folder_id = $request->folder_id;
        $item->created_by = session('userID');
        $item->updated_by = session('userID');
        $result = $item->save();

        if ($request->hasFile('attachs')) {
            $this->storeAttach($request->attachs, $item->id);
        }

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
        $item = File::find($id);
        $attachs = Attach::where('file_id', $item->id)->get();

        foreach ($attachs as $key => $attach) {
            $attachs[$key]->path = asset($attach->path);
        }

        $item->attachs = $attachs;

        return $item;
    }

    /**
     * 前端ajax尚有問題，所以暫不提供此功能
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilePost $request, $id)
    {
        // $item = File::find($id);
        // $item->title = $request->title;
        // $item->description = $request->description;
        // $item->updated_by = session('userID');
        // $result = $item->save();

        // if ($request->hasFile('attachs')) {
        //     $this->storeAttach($request, $item->id);
        // }

        // return $result ? 'success' : 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attachs = Attach::where('file_id', $id)->get();

        foreach ($attachs as $attach) {
            $this->destroyAttach($attach->id);
        }

        $item = File::find($id);
        $item->delete();
    }

    /**
     * Remove the specified attach from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAttach($id)
    {
        $attach = Attach::find($id);

        $path = str_replace('storage/', 'public/', $attach->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $attach->delete();
    }

    /**
     * 儲存附件檔案
     *
     * @param  array  $attachs
     * @param  int    $fileId
     */
    public function storeAttach($attachs, $fileId)
    {
        foreach ($attachs as $attach) {
            $item = new Attach;
            $item->file_id = $fileId;
            $item->name = $attach->getClientOriginalName();
            $item->path = $attach->store('public/attachs/files');
            $item->created_by = session('userID');
            $item->save();
        }
    }
}
