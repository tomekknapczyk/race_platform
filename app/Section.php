<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function map()
    {
        return $this->hasOne(File::class, 'id', 'map_id');
    }
}
