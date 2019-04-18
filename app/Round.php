<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $dates = ['date', 'sign_date'];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function form()
    {
        return $this->hasOne(SignForm::class);
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    public function poster()
    {
        return $this->hasOne(File::class, 'id', 'poster_id');
    }

    public function map()
    {
        return $this->hasOne(File::class, 'id', 'map_id');
    }

    public function startList()
    {
        return $this->hasOne(StartList::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'round_id', 'id');
    }

    public function osy()
    {
        return $this->hasMany(Os::class, 'round_id', 'id')->orderBy('id', 'asc');
    }

    public function results()
    {
        return $this->hasMany(RoundResult::class, 'round_id', 'id')->orderBy('brutto_s', 'asc');
    }

    public function signsAll()
    {
        return Sign::where('form_id', $this->form->id)->orderBy('position', 'desc')->oldest()->get();
    }

    public function signs()
    {
        // $signs = Sign::where('form_id', $this->form->id)->where('active', 1)->orderBy('position', 'desc')->oldest()->get();

        // $sorted = $signs->sortByDesc(function($sign){
        //     return $sign->race_points($this->race);
        // });

        // return $signs;

        $signs = Sign::where('form_id', $this->form->id)->where('active', 1)->orderBy('position', 'desc')->oldest()->get();

        $sorted = $signs->sortByDesc(function($sign){
            $rp = $sign->race_points($this->race);
            if(!$rp)
                return $sign->position;
            return $rp + 100; // +100 żeby pozycja 2 nie była większa od ilości punktów 1
        });

        return $sorted;
    }

    public function canceled()
    {
        return Sign::where('form_id', $this->form->id)->where('active', 0)->orderBy('position', 'desc')->oldest()->get();
    }

    public function startPositions($start_list_id)
    {
        return StartListItem::where('start_list_id', $start_list_id)->orderBy('position', 'desc')->with('sign')->get();
    }

    public function endPositions($start_list_id)
    {
        return StartListItem::where('start_list_id', $start_list_id)->orderBy('points', 'desc')->with('sign')->get();
    }

    public function podium($start_list_id, $klasa)
    {
        return StartListItem::where('start_list_id', $this->startList->id)->where('points', '>', 0)->where('klasa', $klasa)->orderBy('points', 'desc')->with('user', 'user.profile')->take(3)->get();
    }

    public function rank()
    {
        return StartListItem::where('start_list_id', $this->startList->id)->where('points', '>', 0)->groupBy('email')->orderBy('points', 'desc')->get();
    }

    public function klasy($start_list_id)
    {
        return $this->startPositions($start_list_id)->sortBy('klasa')->pluck('klasa', 'klasa');
    }

    public function kolejnosc()
    {
        return explode(',',$this->order);
    }

    public function accreditations()
    {
        return $this->hasMany(PressSign::class, 'round_id', 'id')->groupBy('user_id');
    }
}