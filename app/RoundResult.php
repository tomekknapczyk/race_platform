<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoundResult extends Model
{
    public function sign()
    {
        return $this->hasOne(Sign::class, 'id', 'sign_id');
    }

    public function nr()
    {
        return $this->hasOne(StartListItem::class, 'sign_id', 'sign_id')->orderBy('position', 'asc');
    }

    public function round()
    {
        return $this->belongsTo(Round::class, 'round_id', 'id');
    }

    public function start_nr()
    {
        $positions = $this->round->startPositions($this->round->startList->id);

        $i = 1;

        $class = $positions->sortBy('klasa')->pluck('klasa', 'klasa')->toArray();
        $order = explode(',', $this->round->order);

        usort($class, function ($a, $b) use ($order) {
            $pos_a = array_search($a, $order);
            $pos_b = array_search($b, $order);
            return $pos_a - $pos_b;
        });

        foreach ($class as $cl) {
            foreach ($positions->where('klasa', $cl) as $position){
                if($position->sign_id == $this->sign_id)
                    return $i;
                $i++;
            }
        }

        return $i;
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
