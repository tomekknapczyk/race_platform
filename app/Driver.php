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
}
