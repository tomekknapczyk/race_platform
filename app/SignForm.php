<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignForm extends Model
{
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function signs()
    {
        return $this->hasMany(Sign::class);
    }
}
