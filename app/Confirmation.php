<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('confirmations.is_deleted',0);
    }

    public function scopeSearch($query,$name){
        $query->join('baptismals as b', 'b.id', 'confirmations.baptismal_id')
	            ->select('b.*','confirmations.*')
	            ->whereRaw('(b.first_name LIKE "%' . $name. '%" 
	                OR b.middle_name LIKE "%' . $name. '%" 
	                OR b.last_name LIKE "%' . $name. '%"
	                OR concat(b.first_name," ",b.last_name) LIKE "%' . $name. '%"
	                OR concat(b.last_name,", ",b.first_name) LIKE "%' . $name. '%"
	                OR concat(b.last_name,",",b.first_name) LIKE "%' . $name. '%"
	                OR concat(b.first_name," ",b.middle_name," ",b.last_name) LIKE "%' . $name. '%")');
    }
}
