<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStockAdjustment extends Model{
    
    protected $guarded=['id'];

    public function purpose(){
    	return $this->belongsTo('App\InventoryAdjustmentPurpose', 'inventory_adjustment_purpose_id');
    }

    public function working_unit(){
    	return $this->belongsTo('App\WorkingUnit', 'working_unit_id');
    }

    public function item_status(){
    	return $this->belongsTo('App\InventoryItemStatus', 'inventory_item_status_id');
    }

    public function item_pattern(){
    	return $this->belongsTo('App\InventoryItemPattern', 'inventory_item_pattern_id');
    }

    public function creator(){
    	return $this->belongsTo('App\User', 'creator_user_id');
    }

    public function editor(){
    	return $this->belongsTo('App\User', 'updator_user_id');
    }

    public function stocks(){
    	return $this->hasMany('App\Stock', 'stock_adjustment_id');
    }

}
