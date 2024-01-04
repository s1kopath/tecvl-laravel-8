<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Hash;
use Validator;
use Auth;
use App\Models\Customer;

class CustomerRegistrationController extends Controller
{
    protected $guard = 'customer';
    public function create()
    {
        return view('admin.auth.customer_register');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'                 => 'required | email | unique:customers,email',
            'name'            => 'required',
            'password'              => 'required | min:6',
            'password_confirmation' => 'required | same:password',
        ]);


        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        return redirect('/customer');

    }
}
