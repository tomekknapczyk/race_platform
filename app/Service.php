<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }

    public function partner()
    {
        return $this->belongsTo(Sign::class, 'partner_sign_id', 'id');
    }
}
