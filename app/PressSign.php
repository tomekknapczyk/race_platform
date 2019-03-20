<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PressSign extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('driver', 2);
    }

    public function round()
    {
        return $this->belongsTo(Round::class, 'round_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Press::class, 'press_id', 'id');
    }
}
