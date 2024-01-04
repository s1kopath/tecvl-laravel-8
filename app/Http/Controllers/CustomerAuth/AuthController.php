<?php
/**
 * @package AuthController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Http\Controllers\CustomerAuth;

use App\Model\Customer;
use App\Model\Preference;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    /**
     * Customer Login form
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm()
    {
        $prefer = Preference::getAll()->pluck('value', 'field')->toArray();
        $data = [
            'companyData' => $prefer['company_name'],
            'title' => 'Login In'
        ];

        return view('customer.login', $data);
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

        if (Auth::guard('customer')->attempt($data, $request->remember)) {
            return redirect()->intended('/customer/dashboard');
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
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/customer');
    }
}
