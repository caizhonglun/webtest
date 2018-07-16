<?php

namespace App\WWW;

use Illuminate\Database\Eloquent\Model;

class Videolink extends Model
{


    /**
     * 圖片路徑更改
     *
     * @param  string  $value
     * @return void
     */
    public function setImgPathAttribute($value)
    {
        $this->attributes['img_path'] = str_replace('public/', 'storage/', $value);
    }
}
