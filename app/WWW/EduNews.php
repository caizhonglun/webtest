<?php

namespace App\WWW;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EduNews extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 圖片路徑更改
     *
     * @param  string  $value
     * @return void
     */
    public function setThemeImgPathAttribute($value)
    {
        $this->attributes['theme_img_path'] = str_replace('public/', 'storage/', $value);
    }
}
