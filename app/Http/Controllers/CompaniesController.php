<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Email;
use App\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Http\Controllers\Auth;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $company = new Company();

        return view('companies.create', compact('company'));
    }


    public function store()
    {
        $company = Company::create($this->validaterequest());

        return redirect('companies');
    }

    public function show(Company $company)
    {

        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {

        return view('companies.edit', compact('company'));

    }

    public function update(Company $company)
    {
        $company->update($this->validaterequest());

        return redirect('companies/'. $company->id)->with('message', 'Your data has been updated');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect('companies');
    }

    private function validaterequest()
    {
        return request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'contact_email' => 'required',
        ]);
    }
}

