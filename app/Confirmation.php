<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('confirmations.is_deleted',0);
    }

    public function baptismal()
    {
        return $this->belongsTo('App\Baptismal', 'baptismal_id');
    }

    public function church()
    {
        return $this->belongsTo('App\Church', 'church_id');
    }
    
    public function confirmationSponsors()
    {
        return $this->hasMany('App\ConfirmationSponsor', 'confirmation_id','id');
    }
    
    public function confirmationFacilitator()
    {
        return $this->hasOne('App\ConfirmationFacilitator', 'confirmation_id','id');
    }

    public function getConfirmationDateAttribute(){
        return date('F d, Y', strtotime($this->date_of_confirmation));
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
