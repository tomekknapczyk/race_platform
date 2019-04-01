<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartListItem extends Model
{
    public function startList()
    {
        return $this->belongsTo(StartList::class);
    }

    public function sign()
    {
        return $this->belongsTo(Sign::class);
    }

    public function rank()
    {
        switch ($this->points) {
            case 10:
                return 1;
                break;
            case 8:
                return 2;
                break;
            case 6:
                return 3;
                break;
            case 5:
                return 4;
                break;
            case 4:
                return 5;
                break;
            case 3:
                return 6;
                break;
            case 2:
                return 7;
                break;
            case 1:
                return 8;
                break;
            default:
                return '-';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function pilot()
    {
        return $this->sign->pilot;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function result()
    {
        return $this->hasMany(OsData::class, 'sign_id', 'sign_id');
    }
}
