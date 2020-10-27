<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $guarded = [];

    public function baptismal()
    {
        return $this->hasOne('App\Baptismal');
    }

    public function firstCommunion()
    {
        return $this->hasOne('App\FirstCommunion');
    }
}
