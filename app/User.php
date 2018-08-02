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
        'login', 'email', 'password',
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
}
