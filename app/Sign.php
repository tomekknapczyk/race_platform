<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    public function getNameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }

    public function getLastnameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }

    public function getPilotNameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }

    public function getPilotLastnameAttribute($value)
    {
        return mb_convert_case(str_replace("\"", "'", $value), MB_CASE_TITLE, "UTF-8");
    }

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

    public function pilotSimple()
    {
        return $this->belongsTo(Pilot::class, 'pilot_email', 'email');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'nr_rej', 'nr_rej');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function os($os)
    {
        return OsData::where('sign_id', $this->id)->where('os_id', $os)->first();
    }

    public function osDataFull()
    {
        return $this->hasMany(OsData::class, 'sign_id', 'id');
    }

    public function osData(\App\Round $round)
    {
        $osy = $round->osy->pluck('id')->toArray();
        return OsData::where('sign_id', $this->id)->whereIn('os_id', $osy)->count();
    }

    public function result($round_id)
    {
        return RoundResult::where('sign_id', $this->id)->where('round_id', $round_id)->first();
    }

    public function os_class_rank($os)
    {
        $rank_klasa = OsData::where('klasa', $this->klasa)->where('os_id', $os)->orderBy('brutto_s', 'asc')->get();

        $position = $rank_klasa->search(function ($person, $key){
            return $person->sign_id == $this->id;
        });

        if($position !== false)
            return $position + 1;

        return "-";
    }

    public function os_rank($os)
    {
        $rank = OsData::where('os_id', $os)->orderBy('brutto_s', 'asc')->get();

        $position = $rank->search(function ($person, $key){
            return $person->sign_id == $this->id;
        });

        if($position !== false)
            return $position + 1;

        return "-";
    }

    public function total_class_rank($round)
    {
        $rank_klasa = RoundResult::where('klasa', $this->klasa)->where('round_id', $round)->orderBy('brutto_s', 'asc')->get();

        $position = $rank_klasa->search(function ($person, $key){
            return $person->sign_id == $this->id;
        });

        if($position !== false)
            return $position + 1;

        return "-";
    }

    public function total_rank($round)
    {
        $rank = RoundResult::where('round_id', $round)->orderBy('brutto_s', 'asc')->get();

        $position = $rank->search(function ($person, $key){
            return $person->sign_id == $this->id;
        });

        if($position !== false)
            return $position + 1;

        return "-";
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
