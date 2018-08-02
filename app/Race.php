<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
