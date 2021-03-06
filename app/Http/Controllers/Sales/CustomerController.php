<?php
namespace App\Http\Controllers\Sales;

use App\CustomerBank;
use App\CustomerContactPerson;
use App\Customer;
use App\CustomerType;
use App\Enclosure;
use App\CustomerZone;
use App\CustomerEnclosure;
use App\Country;
use App\Division;
use App\District;
use App\City;
use App\CustomerAddress;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\CustomerRequest;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $view_root = 'modules/sales/setting/customer/';
    public function index()
    {
        $view = view($this->view_root . 'index');
        $view->with('customer_list', Customer::all());
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
        $view->with('country_list', Country::pluck('name', 'id')->prepend('',''));
        $view->with('division_list', Division::pluck('name', 'id')->prepend('',''));
        $view->with('distric_list', District::pluck('name', 'id')->prepend('',''));
        $view->with('city_list', City::pluck('name', 'id')->prepend('',''));
        $view->with('customer_type_list', CustomerType::pluck('name', 'id'));
        $view->with('customer_zone_list', CustomerZone::pluck('name', 'id'));
        $view->with('enclosure_list', Enclosure::all());
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {

        // dd($request->input());
        $customer = new Customer;
        $customer->fill($request->input());
        $customer->creator_user_id = Auth::id();
        $customer->establishment_date = date('Y-m-d', strtotime($request->establishment_date));
        $customer->trade_license_issue_date = date('Y-m-d', strtotime($request->trade_license_issue_date));
        $customer->incorporation_date = date('Y-m-d', strtotime($request->incorporation_date));
        $customer->save();

        // Customer address
        $customer_addresses = array();
        foreach ($request->addresses as $address) {
            array_push($customer_addresses, new CustomerAddress($address));
        }
        $customer->customer_addresses()->saveMany($customer_addresses);

        // Customer Bank
        $customer_banks = array();
        foreach ($request->banks as $bank) {
            array_push($customer_banks, new CustomerBank($bank));
        }
        $customer->customer_banks()->saveMany($customer_banks);
        // Customer Contact Person
        $contact_person = array();
        foreach ($request->persons as $person) {
            array_push($contact_person, new CustomerContactPerson($person));
        }
        $customer->contact_person()->saveMany($contact_person);
        // Customer enclosures
        $enclosures = array();
        if ($request->enclosures) {
            foreach ($request->enclosures as $key => $item) {
                if ($item['enclosure_file']) {
                    $file = $item['enclosure_file'];
                    $file_directory = 'storage/';
                    $file_name = time() . "-" . $file->getClientOriginalName();
                    $file->move($file_directory, $file_directory . $file_name);
                    $enclosure = new CustomerEnclosure;
                    $enclosure->file_directory = $file_directory;
                    $enclosure->file_name = $file_name;
                    $enclosure->enclosure_id = $item['enclosure_id'];
                    array_push($enclosures, $enclosure);
                }
            }
        }
        $customer->customer_enclosure()->saveMany($enclosures);

        Session::put('alert-success', 'Customer created successfully');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $Customer)
    {
        $view = view($this->view_root . 'show');
        $view->with('customer' , $Customer);
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $Customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $Customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $Customer)
    {
        //
    }
}
