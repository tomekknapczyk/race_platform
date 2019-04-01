<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundResult extends Model
{
    public function sign()
    {
        return $this->hasOne(Sign::class, 'id', 'sign_id');
    }

    public function getPenaltyAttribute($value)
    {
        if(!$value)
            return "00:00:00.00";

        return $value;
    }

    public function getLeadingLoseAttribute($value)
    {
        if(!$value)
            return "00:00:00.00";

        return $value;
    }

    public function getNextLoseAttribute($value)
    {
        if(!$value)
            return "00:00:00.00";

        return $value;
    }
}
