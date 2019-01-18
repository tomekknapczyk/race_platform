<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function rounds()
    {
        return $this->hasMany(Round::class)->orderBy('date', 'asc');
    }

    public function lists()
    {
        return $this->hasManyThrough(StartList::class, Round::class);
    }

    public function forms()
    {
        return $this->hasManyThrough(SignForm::class, Round::class);
    }

    public function klasy()
    {
        $klasy = [];
        foreach ($this->rounds->load('startList') as $round) {
            if($round->startList){
                $start_list_id = $round->startList->id;
                $startPositions = $round->startPositions($start_list_id);
                $is_rank = $startPositions->where('points', '>', 0)->first();

                if($is_rank)
                    $klasy = array_merge($klasy, $startPositions->sortBy('klasa')->pluck('klasa', 'klasa')->toArray());
            }
        }

        $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');

        usort($klasy, function ($a, $b) use ($order) {
          $pos_a = array_search($a, $order);
          $pos_b = array_search($b, $order);
          return $pos_a - $pos_b;
        });

        return $klasy;
    }

    public function klasa_rank($klasa)
    {
        $lists = [];

        $rounds = $this->rounds;

        foreach ($rounds as $round) {
            if($round->startList)
                $lists[] = $round->startList->id;
        }

        $positions = StartListItem::where('klasa', $klasa)->whereIn('start_list_id', $lists)->groupBy('email')->with('sign', 'user', 'user.profile', 'user.profile.file')->get();

        $sorted = $positions->sortByDesc(function($position) use ($rounds){
            $rp = $position->sign->race_points($this);
            $position->rp = $rp;
            return $rp;
        });

        return $sorted;
    }

    public function generateLaurels()
    {
        Laurel::where('race_id', $this->id)->delete();

        $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');

        foreach ($order as $klasa) {
            $rank = $this->klasa_rank($klasa)->take(3);

            foreach ($rank as $key => $position) {
                $laurel = new Laurel;
                $laurel->user_id = $position->user->id;
                $laurel->place = $key + 1;
                $laurel->klasa = $klasa;
                $laurel->year = $this->year;
                $laurel->auto = 1;
                $laurel->race_id = $this->id;
                $laurel->save();
            }
        }
    }
}
