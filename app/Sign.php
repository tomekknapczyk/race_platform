<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    public function form()
    {
        return $this->belongsTo(SignForm::class);
    }

    public function points()
    {
        $id = $this->form->round->race_id;

        $race = Race::where('id', $id)->first();

        if(!$race->lists)
            return 0;

        $points = 0;

        foreach ($race->lists as $list) {
            $points += $list->items()->where('email', $this->email)->where('klasa', $this->klasa)->sum('points');
        }

        return $points;
    }

    public function round_points($id)
    {
        $round = Round::where('id', $id)->first();

        if(!$round->startList)
            return 0;

        return $round->startList->items()->where('email', $this->email)->where('klasa', $this->klasa)->sum('points');
    }

    public function getTurboAttribute($value)
    {
        if(!$value)
            return 0;
        else
            return 1;
    }

    public function getRwdAttribute($value)
    {
        if(!$value)
            return 0;
        else
            return 1;
    }
}
