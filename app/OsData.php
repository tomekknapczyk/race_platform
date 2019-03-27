<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OsData extends Model
{
    public function sign()
    {
        return $this->hasOne(Sign::class, 'id', 'sign_id');
    }

    public function getPenaltyAttribute($value)
    {
        if(!$value)
            return "00:00";

        return substr($value, 3,5);
    }

    public function getLeadingLoseAttribute($value)
    {
        if(!$value)
            return "00:00:00.00";

        return $value;
    }
}
