<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryScheduleItem extends Model
{
    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

}
