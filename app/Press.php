<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    public function getNameAttribute($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }
}
