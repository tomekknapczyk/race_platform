<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
