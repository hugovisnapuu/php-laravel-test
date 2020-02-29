<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\Customer;
use App\Email;
use App\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUserMail;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        $this->storeImage($customer);

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

        return redirect('customers/' . $customer->id)->with('message', 'Your data has been updated');
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

            $date = time();
            $file_name = md5(md5_file(request()->image) . $date) . '.' . request()->image->guessExtension();
            $derived_path = substr($file_name, 0, 2) . '/' . substr($file_name, 2, 2);
            $path = implode('/', ['Customers', $derived_path]);
            $full_path = Storage::putFileAs($path, request()->image, $file_name);

            $customer->update([
                'image' => $file_name
            ]);
        }
    }

    public function getImage($filename)
    {
        return Storage::download($this->getFilePath($filename));
    }

    public function getFilePath($filename): string
    {
        $derived_path = substr($filename, 0, 2) . '/' . substr($filename, 2, 2);
        $path = implode('/', ['Customers', $derived_path, $filename]);

        return $path;
    }

    public function deleteImage(Request $request, Customer $customer)
    {
        //Nii kustutad ära kõik kellel on vähemalt 1 pilt andmebaasis
        //DB::table('customers')->where('image', '>', 0)->delete();

        $image_name = $customer->image;

        $image_directory = substr($image_name, 0, 2);

        $customer->update([
            'image' => null
        ]);

        //Storage::delete($this->getFilePath($image_name));
        Storage::deleteDirectory('Customers'. '/' . $image_directory);

        return back()->with('message', 'Your profile image has been deleted');
    }


}
