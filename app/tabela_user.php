<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tabela_user extends Model
{
    public function user()
    {
        return $this->hasOne(import_user::class, 'id', 'user_id');
    }

    public function tabela()
    {
        return $this->hasOne(tabela::class, 'id', 'tabela_id');
    }
}
