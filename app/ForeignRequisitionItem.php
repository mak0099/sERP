<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForeignRequisitionItem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'quantity',
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function requisition(){
        return $this->belongsTo('App\ForeignRequisition', 'foreign_requisition_id');
    }
}
