<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('marriages.is_deleted',0);
    }

    public function husband()
    {
        return $this->belongsTo('App\Baptismal', 'husband_id');
    }

    public function wife()
    {
        return $this->belongsTo('App\Baptismal', 'wife_id');
    }

    public function church()
    {
        return $this->belongsTo('App\Church', 'church_id');
    }
    
    public function sponsors()
    {
        return $this->hasMany('App\MarriageSponsor', 'marriage_id','id');
    }
    
    public function facilitator()
    {
        return $this->hasOne('App\MarriageFacilitator', 'marriage_id','id');
    }

    public function getMarriageDateAttribute(){
        return date('F d, Y', strtotime($this->date_of_marriage));
    }

    public function scopeSearch($query,$name){
        $query->join('baptismals as b', 'b.id', 'marriages.husband_id')
        		->join('baptismals as c', 'c.id', 'marriages.wife_id')
	            ->select('b.*','marriages.*','c.*')
	            ->whereRaw('(b.first_name LIKE "%' . $name. '%" 
	                OR b.middle_name LIKE "%' . $name. '%" 
	                OR b.last_name LIKE "%' . $name. '%"
	                OR concat(b.first_name," ",b.last_name) LIKE "%' . $name. '%"
	                OR concat(b.last_name,", ",b.first_name) LIKE "%' . $name. '%"
	                OR concat(b.last_name,",",b.first_name) LIKE "%' . $name. '%"
	                OR concat(b.first_name," ",b.middle_name," ",b.last_name) LIKE "%' . $name. '%"
	            	OR c.first_name LIKE "%' . $name. '%" 
	                OR c.middle_name LIKE "%' . $name. '%" 
	                OR c.last_name LIKE "%' . $name. '%"
	                OR concat(c.first_name," ",c.last_name) LIKE "%' . $name. '%"
	                OR concat(c.last_name,", ",c.first_name) LIKE "%' . $name. '%"
	                OR concat(c.last_name,",",c.first_name) LIKE "%' . $name. '%"
	                OR concat(c.first_name," ",c.middle_name," ",c.last_name) LIKE "%' . $name. '%")');
    }
}
