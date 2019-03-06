<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'confirmation_code', 'driver', 'uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile()
    {
        return $this->hasOne(Driver::class);
    }

    public function signs()
    {
        return $this->hasMany(Sign::class);
    }

    public function pilotSigns()
    {
        return $this->hasMany(Sign::class, 'pilot_id', 'id');
    }

    public function pilots()
    {
        return $this->hasMany(Pilot::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function ready()
    {
        if(auth()->user()->profile && auth()->user()->cars()->first())
            return true;
        else
            return false;
    }

    public function availableForms()
    {
        $forms = SignForm::where('active', 1)->get();

        $filtered = $forms->filter(function ($value, $key) {
            return !$this->signed($value->id);
        });

        return $filtered;
    }

    public function signed($form_id)
    {
        if(auth()->user()->driver)
            $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $form_id)->first();
        else
            $sign = Sign::where('pilot_id', auth()->user()->id)->where('form_id', $form_id)->first();

        if($sign)
            return true;

        return false;
    }

    public function onList($list_id)
    {
        $sign = StartListItem::where('email', auth()->user()->email)->where('start_list_id', $list_id)->first();

        if($sign)
            return true;

        return false;
    }

    public function racesTaken()
    {
        return StartListItem::where('email', $this->email)->count();
    }

    public function races()
    {
        return $this->hasMany(StartListItem::class, 'email', 'email');
    }

    public function pilot_races()
    {
        $signs = $this->pilotSigns->pluck('id')->toArray();
        $races = StartListItem::whereIn('sign_id', $signs)->get();
        return $races;
    }

    public function klasy()
    {
        $klasy = StartListItem::where('email', $this->email)->groupBy('klasa')->get();
        if(!$klasy)
            return '';

        // dd($klasy->pluck('klasa')->toArray());
        
        return implode(" ",$klasy->pluck('klasa')->toArray());
    }

    public function savedIds()
    {
        return $this->hasMany(SavedId::class);
    }

    public function laurels()
    {
        return $this->hasMany(Laurel::class);
    }

    public function laurel_place($place)
    {
        return $this->hasMany(Laurel::class)->where('place', $place)->orderBy('klasa', 'asc')->orderBy('year', 'desc');
    }

    public function laurel_first()
    {
        return $this->hasMany(Laurel::class)->where('place', 1)->orderBy('klasa', 'asc')->orderBy('year', 'desc');
    }

    public function laurel_second()
    {
       return $this->hasMany(Laurel::class)->where('place', 2)->orderBy('klasa', 'asc')->orderBy('year', 'desc');
    }

    public function laurel_third()
    {
        return $this->hasMany(Laurel::class)->where('place', 3)->orderBy('klasa', 'asc')->orderBy('year', 'desc');
    }

    public function laurels_class()
    {
        $laurels_1 = $this->laurel_place(1);
        $laurels_2 = $this->laurel_place(2);
        $laurels_3 = $this->laurel_place(3);

        $laurels[1] = [];
        $laurels[2] = [];
        $laurels[3] = [];
        $laurels[1]['q'] = 0;
        $laurels[2]['q'] = 0;
        $laurels[3]['q'] = 0;

        foreach ($laurels_1 as $laurel) {
            
        }
    }

    public function laurels_auto()
    {
        $races = Race::where('complete', 1)->get();
        $positions = [];

        if($races){
            foreach ($races as $race) {
                $positions[$race->year] = $this->race_position($race->id);
            }
        }

        return $positions;
    }

    public function all_laurels()
    {
        $laurels_auto = $this->laurels_auto();
        $laurels_hand = $this->laurels->toArray();

        $laurels[1] = [];
        $laurels[2] = [];
        $laurels[3] = [];
        $laurels[1]['q'] = 0;
        $laurels[2]['q'] = 0;
        $laurels[3]['q'] = 0;

        foreach ($laurels_auto as $year => $auto) {
            foreach ($auto as $miejsce => $pos) {
                foreach ($pos as $key3 => $klasa) {
                    if($miejsce == 1){
                        if(!array_key_exists($klasa, $laurels[1])){
                            $laurels[1][$klasa] = [];
                            $laurels[1][$klasa][] = $year;
                            $laurels[1]['q']++;
                        }
                        else{
                            $laurels[1][$klasa][] = $year;
                            $laurels[1]['q']++;
                        }
                    }

                    if($miejsce == 2){
                        if(!array_key_exists($klasa, $laurels[2])){
                            $laurels[2][$klasa] = [];
                            $laurels[2][$klasa][] = $year;
                            $laurels[2]['q']++;
                        }
                        else{
                            $laurels[2][$klasa][] = $year;
                            $laurels[2]['q']++;
                        }
                    }

                    if($miejsce == 3){
                        if(!array_key_exists($klasa, $laurels[3])){
                            $laurels[3][$klasa] = [];
                            $laurels[3][$klasa][] = $year;
                            $laurels[3]['q']++;
                        }
                        else{
                            $laurels[3][$klasa][] = $year;
                            $laurels[3]['q']++;
                        }
                    }
                }
            }
        }

        foreach ($laurels_hand as $laurel_h) {
            if($laurel_h['place'] == 1){
                if(!array_key_exists($laurel_h['klasa'], $laurels[1])){
                    $laurels[1][$laurel_h['klasa']] = [];
                    $laurels[1][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[1]['q']++;
                }
                else{
                    $laurels[1][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[1]['q']++;
                }
            }

            if($laurel_h['place'] == 2){
                if(!array_key_exists($laurel_h['klasa'], $laurels[2])){
                    $laurels[2][$laurel_h['klasa']] = [];
                    $laurels[2][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[2]['q']++;
                }
                else{
                    $laurels[2][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[2]['q']++;
                }

            }

            if($laurel_h['place'] == 3){
                if(!array_key_exists($laurel_h['klasa'], $laurels[3])){
                    $laurels[3][$laurel_h['klasa']] = [];
                    $laurels[3][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[3]['q']++;
                }
                else{
                    $laurels[3][$laurel_h['klasa']][] = $laurel_h['year'];
                    $laurels[3]['q']++;
                }
            }
        }
        return $laurels;
    }

    public function race_position($id)
    {
        $places = [];
        $order = array('k4', 'k7', 'k3', 'k2', 'k1', 'k6', 'k5');
        foreach ($order as $klasa) {
            $race = Race::where('id', $id)->first();

            $lists = [];

            $rounds = $race->rounds;

            foreach ($rounds as $round) {
                if($round->startList)
                    $lists[] = $round->startList->id;
            }

            $positions = StartListItem::where('klasa', $klasa)->whereIn('start_list_id', $lists)->groupBy('email')->with('sign', 'user', 'user.profile', 'user.profile.file')->get();

            $sorted = $positions->sortByDesc(function($position) use ($rounds, $race){
                $rp = $position->sign->race_points($race);
                $position->rp = $rp;
                return $rp;
            });

            foreach ($sorted as $key => $value) {
                if($value->email == $this->email){
                    $places[$key + 1][] = $klasa;
                }
            }
        }
        return $places;
    }

    public function team()
    {
        if($this->team_member)
            return $this->team_member->team;

        return 0;
    }

    public function team_member()
    {
        return $this->hasOne(TeamMember::class);
    }

    public function team_requests()
    {
        return $this->hasMany(TeamRequest::class);
    }

    public function team_admin()
    {
        if($this->team() && $this->team()->user_id == auth()->user()->id)
            return 1;

        return 0;
    }
}
