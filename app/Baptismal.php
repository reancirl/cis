<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Baptismal extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('baptismals.is_deleted',0);
    } 

    public function scopeCommunions($query){
        $query->leftjoin('first_communions as f', 'f.baptismal_id', 'baptismals.id')
              ->whereNull('f.baptismal_id')
              ->orWhere('f.is_deleted',1)
              ->select('f.*','baptismals.*');
    } 

    public function scopeConfirmations($query){
        $query->leftjoin('confirmations as f', 'f.baptismal_id', 'baptismals.id')
              ->whereNull('f.baptismal_id')
              ->orWhere('f.is_deleted',1)
              ->select('f.*','baptismals.*');
    } 

    public function scopeHusband($query){
        $query->leftjoin('confirmations as c', 'c.baptismal_id', 'baptismals.id')
              ->leftjoin('marriages as m', 'm.husband_id', 'baptismals.id')
              ->whereNotNull('c.baptismal_id')
              ->whereNull('m.husband_id')
              ->where('baptismals.gender','Male')
              ->select('baptismals.*','c.*','m.*');
    }

    public function scopeWife($query){
        $query->leftjoin('confirmations as f', 'f.baptismal_id', 'baptismals.id')
              ->leftjoin('marriages as m', 'm.wife_id', 'baptismals.id')
              ->whereNotNull('f.baptismal_id')
              ->whereNull('m.wife_id')
              ->where('baptismals.gender','Female')
              ->select('baptismals.*','f.*','m.*');
    }

    public function scopeValidity($query){
        $query->leftjoin('confirmations as f', 'f.baptismal_id', 'baptismals.id')
              ->leftjoin('marriages as m', 'm.wife_id', 'baptismals.id')
              ->whereNotNull('f.baptismal_id')
              ->whereNull('m.wife_id')  
              ->whereNull('m.husband_id')              
              ->select('baptismals.*','f.*','m.*');
    } 

    public function scopeSearch($query,$name){
        $query->whereRaw('(baptismals.first_name LIKE "%' . $name. '%" 
                  OR baptismals.middle_name LIKE "%' . $name. '%" 
                  OR baptismals.last_name LIKE "%' . $name. '%"
                  OR concat(baptismals.first_name," ",baptismals.last_name) LIKE "%' . $name. '%"
                  OR concat(baptismals.last_name,", ",baptismals.first_name) LIKE "%' . $name. '%"
                  OR concat(baptismals.last_name,",",baptismals.first_name) LIKE "%' . $name. '%"
                  OR concat(baptismals.first_name," ",baptismals.middle_name," ",baptismals.last_name) LIKE "%' . $name. '%")');
    }

	public function church()
    {
        return $this->belongsTo('App\Church', 'church_id');
    }

    public function first_communion()
    {
        return $this->hasOne('App\FirstCommunion', 'baptismal_id','id');
    }

    public function confirmation()
    {
        return $this->hasOne('App\Confirmation', 'baptismal_id','id');
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

    public function getStatusAttribute(){
        if (Carbon::now() >= $this->enrolment_start_date && Carbon::now() <= $this->enrolment_end_date) 
        {
            return 'on-going';
        }
        return 'expired';
    }
}
