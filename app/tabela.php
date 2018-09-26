<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tabela extends Model
{
    public function items()
    {
        return $this->hasMany(tabela_user::class, 'tabela_id');
    }
}
