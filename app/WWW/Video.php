<?php

namespace App\WWW;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * 路徑更改
     *
     * @param  string  $value
     * @return void
     */
    public function setPathAttribute($value)
    {
        $this->attributes['path'] = str_replace('public/', 'storage/', $value);
    }
}
