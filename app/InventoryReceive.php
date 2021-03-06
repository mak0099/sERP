<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryReceive extends Model{

	protected $guarded=['id'];

	public function foreign(){
		return $this->hasOne('App\InventoryReceiveForeign', 'inventory_receive_id');
	}

	public function local(){
		return $this->hasOne('App\InventoryReceiveLocal', 'inventory_receive_id');
	}

	public function internal(){
		return $this->hasOne('App\InventoryReceiveInternal', 'inventory_receive_id');
	}

	public function return(){
		return $this->hasOne('App\InventoryReceiveReturn', 'inventory_receive_id');
	}

	public function stocks(){
		return $this->hasMany('App\Stock', 'inventory_receive_id');
	}

	public function creator(){
		return $this->belongsTo('App\User', 'creator_user_id');
	}

	public function editor(){
		return $this->belongsTo('App\User', 'updator_user_id');
	}

	public function item_status(){
		return $this->belongsTo('App\ProductStatus', 'product_status_id');
	}

	public function item_type(){
		return $this->belongsTo('App\ProductType', 'product_type_id');
	}

	public function working_unit(){
		return $this->belongsTo('App\WorkingUnit', 'working_unit_id');
	}

}
