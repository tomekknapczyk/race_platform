<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartList extends Model
{
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function items()
    {
        return $this->hasMany(StartListItem::class);
    }
}
