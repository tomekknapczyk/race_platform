<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Os extends Model
{
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function items()
    {
        return $this->hasMany(OsData::class, 'os_id', 'id');
    }
}
