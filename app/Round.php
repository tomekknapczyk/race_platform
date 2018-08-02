<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function form()
    {
        return $this->hasOne(SignForm::class);
    }
}
