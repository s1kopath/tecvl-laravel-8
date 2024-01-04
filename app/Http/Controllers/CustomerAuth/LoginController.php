<?php
/**
 * @package LoginController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Http\Controllers\CustomerAuth;

use DB;
use Auth;
use Cookie;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';
    protected $guard = 'customer';
    protected $data = ['page_title' => 'Login In'];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ckname = explode("_", Auth::getRecallerName())[2];
        $this->middleware('guest:customer')->except('logout');
    }

   /**
     * Customer Login form
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm()
    {
        return view('customer.login',$this->data);
    }

     /**
     * Authenticate login
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $data = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($data)) {
            return redirect('customer/dashboard');
        }
        return back()->withInput()->withErrors(['email' => __("Invalid email or password")]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/customer');
    }

}
