<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
