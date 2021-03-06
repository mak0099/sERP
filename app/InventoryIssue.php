<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryIssue extends Model{

	protected $guarded=['id'];

	public function requisition(){
		return $this->belongsTo('App\InventoryRequisition', 'inventory_requisition_id');
	}

	public function requisition_sender(){
		return $this->belongsTo('App\WorkingUnit', 'sender_working_unit_id');
	}

	public function requested_to(){
		return $this->belongsTo('App\WorkingUnit', 'requested_working_unit_id');
	}

	public function initial_approver(){
		return $this->belongsTo('App\User', 'initial_approver_id');
	}

	public function final_approver(){
		return $this->belongsTo('App\User', 'final_approver_id');
	}

	public function items(){
		return $this->hasMany('App\InventoryIssueItem', 'inventory_issue_id');
	}

	public function return_items(){
		return $this->hasMany('App\InventoryIssueReturnItem', 'inventory_issue_id');
	}

	public function receive(){
		return $this->hasOne('App\InventoryReceiveInternal', 'inventory_issue_id');
	}

	public function status(){
		return $this->belongsTo('App\InventoryIssueStatus', 'inventory_issue_status_id');
	}

	public function forward_working_unit(){
		return $this->belongsTo('\App\WorkingUnit', 'forward_working_unit_id');
	}

}
