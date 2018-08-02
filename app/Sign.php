<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    public function form()
    {
        return $this->belongsTo(SignForm::class);
    }
}
