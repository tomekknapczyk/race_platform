<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
