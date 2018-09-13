<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model{

    protected $gaurded=['id'];

    public function division(){
        return $this->belongsTo('App\Division');
    }

    public function country(){
        return $this->belongsTo('App\Country');
    }

}
