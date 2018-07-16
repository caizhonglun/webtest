<?php

namespace App\WWW;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * Set the item's announce start date.
     *
     * @param  string  $value
     * @return void
     */
    public function setAnnounceStartAttribute($value)
    {
        $this->attributes['announce_start'] = date('Y-m-d H:i', strtotime($value));
    }

    /**
     * Set the item's announce end date.
     *
     * @param  string  $value
     * @return void
     */
    public function setAnnounceEndAttribute($value)
    {
        $this->attributes['announce_end'] = date('Y-m-d H:i', strtotime($value));
    }
}
