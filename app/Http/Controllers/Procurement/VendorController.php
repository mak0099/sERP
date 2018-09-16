<?php

namespace App\Http\Controllers\Procurement;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Country;
use App\Enclosure;
use App\VendorCategory;
use App\VendorBank;
use App\VendorPaymentTerm;
use App\VendorContact;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $view_root = 'modules/procurement/setting/vendor/';
    public function index()
    {
        $view = view($this->view_root . 'index');
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view($this->view_root . 'create');
        $view->with('vendor_id', time());
        $view->with('country_list', Country::pluck('name', 'id')->prepend('--select country--', ''));
        $view->with('vendor_category_list', VendorCategory::pluck('name', 'id')->prepend('--select vendor--', ''));
        $view->with('enclosure_list', Enclosure::all());
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|unique:vendors',
            'name' => 'required',
        ]);
        $vendor = new Vendor;
        $vendor->fill($request->input());
        $vendor->business_type = serialize($request->business_type);
        $vendor->business_nature = serialize($request->business_nature);
        $vendor->save();
        $vendor->payment_term()->save(new VendorPaymentTerm($request->payment_term));
        $vendor->bank()->save(new VendorBank($request->bank));
        $contacts = Array();
        foreach($request->contacts as $contact){
            array_push($contacts, new VendorContact($contact));
        }
        $vendor->contacts()->saveMany($contacts);
        Session::put('alert-success', 'vendor created successfully');
        return redirect()->route('vendor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
