<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Paginate;

class IssueController extends Controller{

    protected function path(string $suffix){
        return "modules.inventory.issue.{$suffix}";
    }

    public function index(){

        $working_unit=\Auth::user()->working_unit();
        $inventory_issues=\App\InventoryIssue::whereHas('requisition', function($query) use($working_unit){
            $query->where('requested_depot_id', $working_unit->id);
        });
        
        $data=[
            'paginate'=>new Paginate($inventory_issues, ['id'=>'ID']),
            'carbon'=>new \Carbon\Carbon
        ];

        return view($this->path('index'), $data);

    }


    public function create(){

        return back();
        $data=[];
        return view($this->path('create'), $data);
        
    }


    public function store(Request $request){
        
    }


    public function show(\App\InventoryIssue $issue){

        $data=[
            'issue'=>$issue,
            'carbon'=>new \carbon\Carbon
        ];

        return view($this->path('show'), $data);
        
    }


    public function edit(\App\InventoryIssue $issue){

        $data=[
            'issue'=>$issue,
            'inventory_requisition_types'=>\App\InventoryRequisitionType::pluck('name', 'id'),
            'working_units'=>\App\WorkingUnit::pluck('name', 'id'),
            'product_statuses'=>\App\ProductStatus::pluck('name', 'id'),
            'product_patterns'=>\App\ProductPattern::pluck('name', 'id'),
            'carbon'=>new \Carbon\Carbon
        ];

        $products=[];

        foreach($issue->allocated_items as $row){
            $products[$row->product_id]=$row->requested_quantity;
        }

        //dd($requisition->requested_items);

        \Session::put('vue_products', $products);
        return view($this->path('create'), $data);
        
    }


    public function update(Request $request, \App\InventoryIssue $issue){

        //dd($request->all());

        \Session::put('vue_products', $request->get('products'));

        $request->validate([
            'products'=>'required|array'
        ]);


        if($request->get('forward_working_unit_id')){

            $issue->requisition->requested_depot_id=$request->get('forward_working_unit_id');
            $issue->requisition->save();
            $issue->initial_approver_id=null;
            $issue->final_approver_id=null;
            $issue->save();
            return redirect()->route('issue.index')->with('success', 'Requisition forwarded successfully!.');

        }else{


            $products=$request->get('products');

            foreach($products as $id=>$quantity){
                
                $product=\App\Product::find($id);
                $balance=stock_balance($issue->requisition->requested_to, $product, [
                    'product_status_id'=>$issue->requisition->product_status_id,
                    'product_pattern_id'=>$issue->requisition->product_pattern_id
                ]);

                if($balance < $quantity){
                    return back()
                    ->with('failed', 'Sorry!, your issue product quantity exceeds stock quantity.')
                    ->withInput();
                }

            }

            $approval=$request->get('approval');

            if($approval=='initial' && \Auth::user()->can('approve_initial_issue')){

                $issue->initial_approver()->associate(\Auth::user());

            }elseif($approval=='final' && \Auth::user()->can('approve_final_issue')){

                $issue->final_approver()->associate(\Auth::user());

            }else{

                return back()->withInput()->with('failed', 'Sorry!, you can\'t perform this action.');

            }

            $issue->allocated_items()->delete();
            $issue->save();

            foreach($products as $id=>$quantity){
                
                $product=\App\Product::find($id);

                \App\InventoryIssueItem::create([
                    'inventory_issue_id'=>$issue->id,
                    'product_id'=>$product->id,
                    'requested_quantity'=>$quantity,
                    'product_status_id'=>$issue->requisition->product_status_id,
                    'product_pattern_id'=>$issue->requisition->product_pattern_id
                ]);

                if($approval=='final'){

                    \App\Stock::create([
                        'working_unit_id'=>$issue->requisition->requested_depot_id,
                        'inventory_issue_id'=>$issue->id,
                        'product_id'=>$product->id,
                        'issue_quantity'=>$quantity,
                        'product_status_id'=>$issue->requisition->product_status_id,
                        'product_pattern_id'=>$issue->requisition->product_pattern_id
                    ]);

                }

            }

            \Session::forget('vue_products');
            return redirect()->route('issue.index')->with('success', 'Form submitted successfully!.');

        }

    }


    public function destroy(Issue $issue){
        
    }
}
