<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Email;
use App\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $customers = Customer::all();
        $companies = Company::all();

        return view('customers.index', compact('customers', 'companies'));


        //active() tuleb customeri modelist, milles on scope nimi 'Active'
        //$activeCustomers = Customer::active()->get();
        //$inactiveCustomers = Customer::inactive()->get();
    }

    public function create()
    {
        $companies = Company::all();
        $customer = new Customer();

        return view('customers.create', compact('companies', 'customer'));
    }

    public function store()
    {

        $customer = Customer::create($this->validateRequest());

        event(new NewCustomerHasRegisteredEvent($customer));

        Mail::to($customer->email)->send(new WelcomeNewUserMail());

        return redirect('customers');
    }

    public function show(Customer $customer)
    {
        $company = Company::all();

        return view('customers.show', compact('customer', 'company'));

    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();

        return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer, Request $request)
    {

        $customer->update($this->validateRequest());

        $this->storeImage($customer);

        //$this->displayImage();

        return redirect('customers/'.$customer->id)->with('message', 'Your data has been updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect('customers');
    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'number' => 'required|integer|min:6',
            'active' => 'required',
            'company_id' => 'required',

        ]), function () {

            if (request()->hasFile('image')) {
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });
    }

    public function storeImage($customer)
    {
        if (request()->hasFile('image')) {

            $customer->update([
                //'image' => request()->image->store(public_path('uploads'), $filename)
                'image' => request()->image->store('uploads', 'public')
            ]);

        }


    }

    /*public function displayImage($filename)
    {
        //$filename = request()->$customer->image->hashName();

        return response();
    }*/




    //public function storeImage($customer)
    //{
    //    if (request()->has('image')) {
    //        $customer->update([
    //            'image' => request()->image->store('uploads', 'public')
    //        ]);
    //    }
    //}
}
