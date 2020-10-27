<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Baptismal extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('is_deleted',0);
    } 

    public function scopeCommunions($query){
        $query->leftjoin('first_communions as f', 'f.baptismal_id', 'baptismals.id')
              ->whereNull('f.baptismal_id')
              ->select('f.*','baptismals.*');
    } 

	public function church()
    {
        return $this->belongsTo('App\Church', 'church_id');
    }

	public function baptismalSponsors()
    {
        return $this->hasMany('App\BaptismalSponsor', 'baptismal_id','id');
    }
    
    public function baptismalFacilitator()
    {
        return $this->hasOne('App\BaptismalFacilitator', 'baptismal_id','id');
    }

    public function firstCommunion()
    {
        return $this->hasOne('App\FirstCommunion', 'baptismal_id','id');
    }    

    public function getBirthdayAttribute(){
    	return date('F d, Y', strtotime($this->date_of_birth));
    }

    public function getBaptismalDateAttribute(){
        return date('F d, Y', strtotime($this->date_of_baptismal));
    }

    public function getFullNameAttribute(){
    	return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
}
