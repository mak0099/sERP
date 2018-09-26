<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\CompanyLicense;
use App\CompanyProfile;
use Illuminate\Http\Request;
use Session;
use Auth;


class CompanyLicenseController extends Controller
{
    private $view_root = 'modules/company/company_license/';

    public function index()
    {
        $view = view($this->view_root . 'index');
        $view->with('company_license_list', CompanyLicense::all());
        return $view;
    }

    
    public function create()
    {
        $view = view($this->view_root . 'create');
        $view->with('company_profile_list', CompanyProfile::pluck('name', 'id')->prepend('-- Select Company --', ''));
        return $view;
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_name'=> 'required'
        ]);
        $companyLicense = new CompanyLicense;
        $companyLicense->fill($request->input());
        $companyLicense->creator_user_id = Auth::id();
        $companyLicense->save();
        Session::put('alert-success', $companyLicense->name .' created successfully.');
        return redirect()->route('company-license.index');
    }

    public function show(CompanyLicense $companyLicense)
    {
        $view = view($this->view_root . 'show');
        $view->with('companyLicense', $companyLicense);
        return $view;
    }

    public function edit(CompanyLicense $companyLicense)
    {
        //
    }

    public function update(Request $request, CompanyLicense $companyLicense)
    {
        //
    }

    public function destroy(CompanyLicense $companyLicense)
    {
        //
    }
}
