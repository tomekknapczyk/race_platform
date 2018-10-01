<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    public function form()
    {
        return $this->belongsTo(SignForm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function pilot()
    {
        return $this->belongsTo(User::class, 'pilot_email', 'email')->where('driver', 0);
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'nr_rej', 'nr_rej');
    }

    public function race_points(Race $race)
    {
        $points = 0;
        $points += StartListItem::whereIn('start_list_id', $race->lists->pluck('id'))->where('email', $this->email)->where('klasa', $this->klasa)->sum('points');

        return $points;
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

    public function remaining_payment()
    {
        return ($this->form->round->price - $this->advance > 0)?$this->form->round->price - $this->advance:0;
    }

    public function remaining($price)
    {
        return ($price - $this->advance > 0)?$price - $this->advance:0;
    }

    public function round_points(Round $round)
    {
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
