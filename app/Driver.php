<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }

    public function getLastnameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }
}
