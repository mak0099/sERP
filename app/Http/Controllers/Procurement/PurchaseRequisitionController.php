<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use App\PurchaseRequisition;
use Illuminate\Http\Request;

class PurchaseRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('modules/procurement/purchase_requisition');
        // $view->with('foo', 'bar');
        // your code here
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pr = new PurchaseRequisition;
        $pr->fill($request->all());
        $pr->created_by_user_id = Auth::id;
        $pr->company_id = Auth::user()->getUserCompanyId();
        $pr->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequisition  $purchaseRequisition
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequisition $purchaseRequisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequisition  $purchaseRequisition
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequisition $purchaseRequisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequisition  $purchaseRequisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequisition $purchaseRequisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequisition  $purchaseRequisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequisition $purchaseRequisition)
    {
        //
    }
}
