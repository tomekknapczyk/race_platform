<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function pilots()
    {
        $members = $this->hasMany(TeamMember::class)->get();

        $filtered = $members->filter(function ($teamMember, $key) {
            return $teamMember->user->driver == 0;
        });
        return $filtered;
    }

    public function drivers()
    {
        $members = $this->hasMany(TeamMember::class)->get();

        $filtered = $members->filter(function ($teamMember, $key) {
            return $teamMember->user->driver == 1;
        });
        return $filtered;
    }

    public function other_members()
    {
        return $this->hasMany(TeamMember::class)->where('user_id', '!=', $this->user_id);
    }

    public function team_requests()
    {
        return $this->hasMany(TeamRequest::class);
    }

    public function rounds()
    {
        return $this->hasMany(StartListItem::class)->groupBy('start_list_id')->latest();
    }

    public function race_rounds($race_id)
    {
        $race = Race::where('id', $race_id)->first();
        $ids = $race->lists->pluck('id');

        return $this->hasMany(StartListItem::class)->whereIn('start_list_id', $ids)->groupBy('start_list_id')->latest();
    }

    public function crews($round)
    {
        return $this->hasMany(StartListItem::class)->where('start_list_id', $round);
    }

    public function results()
    {
        $rounds = $this->rounds;

        $best = [];

        foreach ($rounds as $key => $round) {
            $crews = $this->crews($round->start_list_id);
            $min = $round->startList->round->race->minTeam;
            
            if($crews->count() >= $min){
                $best[$key]['round'] = $round->startList->round;
                $best[$key]['crew'] = $crews->where('points', '>', 0)->orderBy('points', 'desc')->take(2)->get();
            }
        }

       return $best;
    }

    public function race_results($race_id)
    {
        $rounds = $this->race_rounds($race_id)->get();

        $best['points'] = 0;
        $best['rounds'] = [];

        foreach ($rounds as $key => $round) {
            $crews = $this->crews($round->start_list_id);
            $min = $round->startList->round->race->minTeam;
            if($crews->count() >= $min){
                $best['rounds'][$round->startList->round->id]['round'] = $round->startList->round;
                $best['rounds'][$round->startList->round->id]['crew'] = $crews->where('points', '>', 0)->orderBy('points', 'desc')->take(2)->get();
                $best['rounds'][$round->startList->round->id]['points'] = $best['rounds'][$round->startList->round->id]['crew']->sum('points');
                $best['points'] += $best['rounds'][$round->startList->round->id]['points'];
            }
        }

       return $best;
    }

    public function round($id)
    {
        return $this->hasMany(StartListItem::class)->where('start_list_id', $id);
    }
}
