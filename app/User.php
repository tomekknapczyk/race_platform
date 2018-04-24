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

    public function pilot()
    {
        return $this->hasOne(Pilot::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
