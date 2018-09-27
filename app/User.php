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
        'login', 'email', 'password', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function driver()
    {
        return $this->hasOne(Driver::class);
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
        if(auth()->user()->driver() && auth()->user()->pilots()->first() && auth()->user()->cars()->first())
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
        $sign = Sign::where('user_id', auth()->user()->id)->where('form_id', $form_id)->first();

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

    public function klasy()
    {
        $klasy = StartListItem::where('email', $this->email)->groupBy('klasa')->get();
        if(!$klasy)
            return '';

        // dd($klasy->pluck('klasa')->toArray());
        
        return implode(" ",$klasy->pluck('klasa')->toArray());
    }
}
