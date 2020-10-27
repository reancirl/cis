<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstCommunion extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('is_deleted',0);
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
}
