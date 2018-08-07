<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function rounds()
    {
        return $this->hasMany(Round::class)->orderBy('name', 'asc');
    }

    public function lists()
    {
        return $this->hasManyThrough(StartList::class, Round::class);
    }

    public function klasy()
    {
        $klasy = [];
        foreach ($this->rounds as $round) {
            if($round->startList){
                $is_rank = $round->startPositions()->where('points', '>', 0)->first();

                if($is_rank)
                    $klasy = array_merge($klasy, $round->startPositions()->sortBy('klasa')->pluck('klasa', 'klasa')->toArray());
            }
        }

        return array_sort($klasy);
    }

    public function klasa_rank($klasa)
    {
        $lists = [];

        foreach ($this->rounds as $round) {
            if($round->startList)
                $lists[] = $round->startList->id;
        }

        $positions = StartListItem::where('klasa', $klasa)->whereIn('start_list_id', $lists)->groupBy('email')->get();

        $sorted = $positions->sortByDesc(function($position){
            return $position->sign->points();
        });

        return $sorted;
    }
}
