<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Baptismal extends Model
{
	public function church()
    {
        return $this->belongsTo('App\Church', 'church_id','id');
    }

	public function baptismalSponsors()
    {
        return $this->hasMany('App\BaptismalSponsor', 'baptismal_id','id');
    }
    
    public function baptismalFacilitator()
    {
        return $this->hasOne('App\BaptismalFacilitator', 'baptismal_id','id');
    }    

    public function getBirthdayAttribute(){
    	return date('F d, Y', strtotime($this->date_of_birth));
    }

    public function getFullNameAttribute(){
    	return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
}
