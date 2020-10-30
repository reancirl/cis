<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstCommunion extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('first_communions.is_deleted',0);
    } 
    
    public function baptismal()
    {
        return $this->belongsTo('App\Baptismal', 'baptismal_id');
    }

    public function church()
    {
        return $this->belongsTo('App\Church', 'church_id');
    }

    public function getCommunionDateAttribute(){
        return date('F d, Y', strtotime($this->date_of_communion));
    }

    public function scopeSearch($query,$name){
        $query->join('baptismals as b', 'b.id', 'first_communions.baptismal_id')
                    ->select('b.*','first_communions.*')
                    ->whereRaw('(b.first_name LIKE "%' . $name. '%" 
                        OR b.middle_name LIKE "%' . $name. '%" 
                        OR b.last_name LIKE "%' . $name. '%"
                        OR concat(b.first_name," ",b.last_name) LIKE "%' . $name. '%"
                        OR concat(b.last_name,", ",b.first_name) LIKE "%' . $name. '%"
                        OR concat(b.last_name,",",b.first_name) LIKE "%' . $name. '%"
                        OR concat(b.first_name," ",b.middle_name," ",b.last_name) LIKE "%' . $name. '%")');
    }
}
