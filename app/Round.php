<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $dates = ['date'];

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

    public function startList()
    {
        return $this->hasOne(StartList::class);
    }

    public function signs()
    {
        $signs = Sign::where('form_id', $this->form->id)->where('active', 1)->orderBy('position', 'desc')->oldest()->get();

        $sorted = $signs->sortByDesc(function($sign){
            return $sign->race_points($this->race);
        });

        return $sorted;
    }

    public function canceled()
    {
        return Sign::where('form_id', $this->form->id)->where('active', 0)->orderBy('position', 'desc')->oldest()->get();
    }

    public function startPositions($start_list_id)
    {
        return StartListItem::where('start_list_id', $start_list_id)->orderBy('position', 'desc')->get();
    }

    public function endPositions($start_list_id)
    {
        return StartListItem::where('start_list_id', $start_list_id)->orderBy('points', 'desc')->get();
    }

    public function podium($start_list_id, $klasa)
    {
        return StartListItem::where('start_list_id', $this->startList->id)->where('points', '>', 0)->where('klasa', $klasa)->orderBy('points', 'desc')->with('user', 'user.driver')->get();
    }

    public function rank()
    {
        return StartListItem::where('start_list_id', $this->startList->id)->where('points', '>', 0)->groupBy('email')->orderBy('points', 'desc')->get();
    }

    public function klasy($start_list_id)
    {
        return $this->startPositions($start_list_id)->sortBy('klasa')->pluck('klasa', 'klasa');
    }
}