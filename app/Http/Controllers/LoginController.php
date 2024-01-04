<?php
/**
 * @package LoginController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @contributor Md Abdur Rahaman Zihad <[zihad.techvill@gmail.com]>
 * @created 20-05-2021
 * @modified 30-05-2022
 */

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AuthUserRequest;
use Illuminate\Support\Facades\Route;
use Auth;
use Session;
use DB;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{
    EmailTemplate,
    Language,
    User,
    PasswordReset,
    VendorUser
};
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Constructor
     * @param EmailController $email
     */
    public function __construct(EmailController $email)
    {
        $this->email = $email;
        $this->ckname = explode("_", Auth::getRecallerName())[2];
        $this->middleware('guest:user')->except('logout', 'impersonate', 'cancelImpersonate');
    }

    // use AuthenticatesUsers;
    /**
     * @return login page view
     */
    public function showLoginForm()
    {
        $value = Cookie::get($this->ckname);
        if (!is_null($value)) {
            $rememberedUser = explode(".", explode($this->ckname, decrypt($value))[1]);
            if ($rememberedUser[1] == 'user' && Auth::guard('user')->loginUsingId($rememberedUser[0]))
            {
                $ckkey = encrypt($this->ckname.Auth::user()->id.".user");
                Cookie::queue($this->ckname, $ckkey, 2592000);
                return redirect()->intended(route('dashboard'));
            }
        }
        return view('admin.auth.login');
    }

    /**
     * Login authenticate operation.
     *
     * @return redirect dashboard page
     */
    public function authenticate(AuthUserRequest $request)
    {
        $data = $request->only('email', 'password');
        $data['status'] = 'Active';
        $userData = User::where('email', $data['email'])->first();
        if (\Hash::check($data['password'], $userData->password)) {
            if ($userData->status != 'Active') {
                return back()->withInput()->withErrors(['error' => __("Inactive User")]);
            }
            if (isset($userData->role->role_id) && $userData->roles[0]->type == "global" &&  $userData->roles[0]->slug == "super-admin"|| isset($userData->role->role_id) && $userData->roles[0]->type == "vendor" && $userData->roles[0]->slug == "vendor-admin") {
                if (Auth::guard('user')->attempt($data)) {
                    session()->put('vendorId', optional(auth()->user()->vendor())->vendor_id);
                    if (!is_null($request->remember)) {
                        $ckkey = encrypt($this->ckname.Auth::user()->id.".user");
                        Cookie::queue($this->ckname, $ckkey, 2592000);
                    }
                    if (Auth::user()->roles[0]->type == 'global') {
                        return redirect()->intended(route('dashboard'));
                    }
                    return redirect()->intended(route('vendor-dashboard'));
                }
            }
            return back()->withInput()->withErrors(['error' => __("Invalid User")]);
        } else {
            return back()->withInput()->withErrors(['email' => __("Invalid email or password")]);
        }
    }

    /**
     * logout operation.
     *
     * @return redirect login page view
     */
    public function logout()
    {
        $cookie = Cookie::forget($this->ckname);
        Auth::guard('user')->logout();
        Session::flush();
        return redirect()->route('login')->withCookie($cookie);
    }

    /**
     * forget password
     *
     * @return forget password form
     */
    public function reset()
    {
        $this->data = ['page_title' => __('Reset Password')];
        return view('admin.auth.passwords.email', $this->data);
    }

    /**
     * Opt form
     *
     * @return forget password form
     */
    public function resetOtp()
    {
        return view('admin.auth.passwords.otp');
    }

    /**
     * Send reset password link
     *
     * @return Null
     */
    public function sendResetLinkEmail(Request $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        $validator =  PasswordReset::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userName = (new User)->getUsername($request->email);

        $request['token'] = Password::getRepository()->createNewToken();
        $request['otp'] = random_int(1111, 9999);
        $request['created_at'] = date('Y-m-d H:i:s');
        try {
            \DB::beginTransaction();
            (new PasswordReset)->storeOrUpdate($request->only('email', 'token', 'otp', 'created_at'));

            // Retrive preference value and field name and language id
            $prefer = preference();
            $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

            $link = route('password.reset', ['token' => $request['token']]);
            // Retrive subject and body from email template
            $parent = EmailTemplate::getAll()->where('slug', 'reset-password')->where('language_id', $languageId)->first();
            $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();

            $subject =  $emailInfo->subject;
            $message =  $emailInfo->body;

            // Replacing template variable

            $message = str_replace('{user_name}', $userName, $message);
            $message = str_replace('{password_reset_url}', $link, $message);
            $message = str_replace('{password_reset_otp}', $request->otp, $message);
            $message = str_replace('{company_name}', $prefer['company_name'], $message);
            $message = str_replace('{otp_active}', !User::userVerification('otp') ? 'display: none;' : '', $message);
            $message = str_replace('{token_active}', !User::userVerification('token') ? 'display: none;' : '', $message);
            $message = str_replace('{token_otp_active}', User::userVerification('token') && User::userVerification('otp') ? '' : 'display: none;', $message);

            $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

            if ($emailResponse['status'] == false) {
                \DB::rollBack();
                return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
            }
            $data['status'] = 'success';
            $data['message'] = __('Password reset link sent to your email address.');
            \DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $data['status'] = 'fail';
            $data['message'] = $e->getMessage();
        }
        $this->setSessionValue($data);

        if (User::userVerification('otp')) {
            return redirect()->route('reset.otp')->withInput();
        }
        return redirect()->back();
    }

    /**
     * showResetForm method
     * @param  string $tokens
     * @return show reset password page view
     */
    public function showResetForm(Request $request, $tokens = null)
    {
        if (!empty($tokens)) {
            $tokens = $request->token;
        }
        $token = (new PasswordReset)->tokenExist($tokens);

        if (empty($token) || empty($request->token)) {
            return redirect()->route('reset.otp')->withErrors(['email' => __("Invalid password token")]);
        }

        $data = ['token' => $tokens];
        $data['user'] = (new User)->getData($tokens);

        if (!$data['user']) {
            return redirect()->back()->withErrors(['email' => __("Invalid password token")]);
        }

        return view('admin.auth.passwords.reset', $data);
    }

    /**
     *
     * @return redirect login page view
     */
    public function setPassword(Request $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($request->id, 'users', ['getData' => true]);
            if ($response['status'] === true) {
                $validator = PasswordReset::passwordValidation($request->all());
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $password = $request->password;
                $request['updated_at'] = date('Y-m-d H:i:s');
                $request['password'] = \Hash::make(trim($request->password));
                if ((new PasswordReset)->updatePassword($request->only('password', 'token', 'updated_at'), $request->id)) {

                    // Retrive preference value and field name and language id
                    $prefer = preference();
                    $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                    // Retrive welcome new password set email template
                    $parent = EmailTemplate::getAll()->where('slug', 'new-password-set')->where('language_id', $languageId)->first();
                    $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();
                    $subject =  $emailInfo->subject;
                    $message =  $emailInfo->body;

                    // Replacing template variable
                    $message = str_replace('{user_name}', $response['data']->name, $message);
                    $message = str_replace('{user_id}', $response['data']->email, $message);
                    $message = str_replace('{user_pass}', $password , $message);
                    $message = str_replace('{company_name}', $prefer['company_name'], $message);
                    $message = str_replace('{company_url}', route('login'), $message);

                    $emailResponse = $this->email->sendEmail($response['data']->email, $subject, $message, null, $prefer['company_name']);
                    if ($emailResponse['status'] == false) {
                        return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
                    }

                    $data['status'] = 'success';
                    $data['message'] = __('Password updated successfully.');
                } else {
                    $data['message'] = __('Nothing is updated.');
                }
            } else {
                $data['message'] = $response['message'];
            }
        }

        $this->setSessionValue($data);
        return redirect()->route('login');
    }


    /**
     * Impersonate as another user
     * @param Request $request
     * @return redirect
     */
    public function impersonate(Request $request)
    {
        $impersonate = base64_decode($request->impersonate);
        if (!session()->has('impersonator')) {
            session(['impersonator' => auth()->id()]);
        }
        Auth::loginUsingId($impersonate);
        return redirect(route('site.index'));
    }


    public function cancelImpersonate()
    {
        Auth::loginUsingId(session('impersonator'));
        session()->forget('impersonator');
        return redirect(route('dashboard'));
    }
}
