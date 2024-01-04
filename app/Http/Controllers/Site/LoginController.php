<?php
/**
 * @package LoginController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 08-11-2021
 */
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Requests\Admin\AuthUserRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\{
    EmailTemplate,
    File,
    Language,
    PasswordReset,
    Role,
    RoleUser,
    User,
    Wishlist
};
use Illuminate\Support\Facades\Password;
use Modules\CMS\Http\Models\Slide;
use Str, DB, Session, Auth, Cart, Compare, Cookie;

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
        $this->middleware('guest:user')->except('logout');
    }

    /**
     * @return login page view
     */
    public function login($verifyMsg = null)
    {

        $value = Cookie::get($this->ckname);
        if (!is_null($value)) {
            $rememberedUser = explode(".", explode($this->ckname, decrypt($value))[1]);
            if ($rememberedUser[1] == 'user' && Auth::guard('user')->loginUsingId($rememberedUser[0]))
            {
                $ckkey = encrypt($this->ckname . Auth::user()->id . ".user");
                Cookie::queue($this->ckname, $ckkey, 2592000);
                return redirect()->intended(session()->get('nextUrl'));
            }
        }



        if (session()->get('prev1') == session()->get('prev3')) {
            return redirect('/')->with('loginRequired', true);
        }
        if (isset(Auth::user()->id)) {
            return back();
        }
        if (!is_null($verifyMsg)) {
            return redirect('/')->with('loginRequired', true)->with('verifyMsg', $verifyMsg);
        }

        return back()->with('loginRequired', true);
    }

    /**
     * @return sign up page view
     */
    public function showSignUpform()
    {
        if (isset(Auth::user()->id)) {
            return back();
        }
        return view('site.auth.sign_up');
    }

    public function signUp(Request $request)
    {
        $response = ['status' => 0];
        $role = Role::getAll()->where('slug', 'customer')->first();
        $request['status'] = "Pending";
        $validator =  User::siteStoreValidation($request->all());
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['error'] = $validator->errors();
            return $response;
        }

        $password = $request->password;
        $request['password'] = \Hash::make($request->password);
        $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;
        $request['activation_code'] = Str::random(10);
        $request['activation_otp'] = random_int(1111, 9999);

        try {
            DB::beginTransaction();
            $id = (new User)->store($request->only('name', 'email', 'activation_code', 'activation_otp', 'password', 'status'));
            if (!empty($id)) {
                if (!empty($role)) {
                    (new RoleUser)->store(['user_id' => $id, 'role_id' => $role->id]);
                }

                // Retrive preference value and field name and language id
                $prefer = preference();
                $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;
                // Retrive welcome user email template
                if ($request->status == 'Active') {
                    $parent = EmailTemplate::getAll()->where('slug', 'user')->where('language_id', $languageId)->first();
                    $parentId = EmailTemplate::getAll()->where('slug', 'user')->first()->id;
                } else {
                    $parent = EmailTemplate::getAll()->where('slug', 'email-verification')->where('language_id', $languageId)->first();
                    $parentId = EmailTemplate::getAll()->where('slug', 'email-verification')->first()->id;
                }
                $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parentId)->where('language_id', $languageId)->first();
                $subject =  $emailInfo->subject;
                $message =  $emailInfo->body;

                // Replacing template variable
                // Need to change assigned by whom value with auth user
                $subject = str_replace('{company_name}', $prefer['company_name'], $subject);
                $message = str_replace('{user_name}', $request->name, $message);
                $message = str_replace('{user_id}', $request->email, $message);
                $message = str_replace('{user_pass}', $password, $message);
                $message = str_replace('{otp_active}', !User::userVerification('otp') ? 'display: none;' : '', $message);
                $message = str_replace('{token_active}', !User::userVerification('token') ? 'display: none;' : '', $message);
                $message = str_replace('{token_otp_active}', User::userVerification('token') && User::userVerification('otp') ? '' : 'display: none;', $message);
                if ($request->status != 'Active') {
                    $url = url('/user-verify', $request->activation_code);
                    $message = str_replace('{verification_url}', $url, $message);
                    $message = str_replace('{verification_otp}', $request->activation_otp, $message);
                } else {
                    $message = str_replace('{company_url}', url('/user/login'), $message);
                }
                $message = str_replace('{company_name}', $prefer['company_name'], $message);
                // Send Mail to the customer
                $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

                if ($emailResponse['status'] == false) {
                    \DB::rollBack();
                    $response['error'] = $emailResponse['message'];
                    return $response;
                }

                DB::commit();
                $response['status'] = 1;
                return $response;
            }
        } catch (Exception $e) {
            DB::rollBack();
            $response['status'] = 0;
            $response['error'] = $e->getMessage();
            return $response;
        }
    }

    /**
     * Login authenticate operation.
     */
    public function authenticate(AuthUserRequest $request)
    {
        $data = $request->only('email', 'password');
        $data['status'] = 'Active';
        $userData = User::where('email', $data['email'])->first();
        if (!empty($userData) && \Hash::check($data['password'], $userData->password)) {
            if ($userData->status == 'Deleted') {
                $response['status'] = 0;
                $response['message'] =  __("Invalid email or password");
                return $response;
            } else if ($userData->status == 'Pending') {
                $response['status'] = 0;
                $response['message'] =  __("Please verify your email address.");
                return $response;
            } elseif ($userData->status == 'Inactive') {
                $response['status'] = 0;
                $response['message'] =  __("Sorry, your account is not activated.");
                return $response;
            }

            if (Auth::guard('user')->attempt($data)) {
                Cart::cartDataTransfer();
                Compare::compareDataTransfer();
                $response['status'] = 1;
                $response['message'] =  __("You are now logged in!");
                if (!is_null($request->remember_me)) {
                    $ckkey = encrypt($this->ckname . Auth::user()->id . ".user");
                    Cookie::queue($this->ckname, $ckkey, 2592000);
                }
                if (!empty($_COOKIE['item_id'])) {
                    if (!(new Wishlist)->checkExistence(auth()->user()->id, $_COOKIE['item_id'])) {
                        (new Wishlist)->store(['item_id' => $_COOKIE['item_id'], 'user_id' => auth()->user()->id]);
                    }
                    setcookie("item_id", "", time() - 3600);
                }
                session()->put('welcomeUser', true);
                return $response;
            }
            $response['status'] = 0;
            $response['message'] =  __("Invalid User");
            return $response;

        } else {
            $response['status'] = 0;
            $response['message'] =  __("Email or Password is incorrect!");
            return $response;
        }
    }

    /**
     * User Verification
     *
     * @param $code
     * @return $msg
     */
    public function verification($code)
    {
        $user = User::where('activation_code', $code)->first();
        if (empty($user)) {
            $msg = __('Invalid Request');
            return $this->login($msg);
        } else if ($user->status == 'Active') {
            $msg = __('This account is already activated.');
            return $this->login($msg);
        }

        if((new User)->updateUser(['status' =>'Active', 'activation_code' => NULL, 'activation_otp' => NULL, 'email_verified_at' => now()], $user->id)) {
            $msg = __('Your account is activated, please login.');
            return $this->login($msg);
        }
    }

    /**
     * use Google driver
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * take data from Google and save in db & redirect in main page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handelGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user, 'Google');
        return redirect()->route('site.index');
    }

    /**
     * use Facebook driver
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * take data from Facebook and save in db & redirect in main page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handelFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user, 'Facebook');
        return redirect()->route('site.index');
    }

    /**
     * save user data
     *
     * @param $data
     */
    protected function _registerOrLoginUser($data, $service = null)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            try {
                DB::beginTransaction();
                $id = (new User)->store(['name' => $data->name, 'email' => $data->email, 'password' => \Hash::make(Str::random(5)), 'status' => 'Active',  'sso_account_id' => $data->id, 'sso_service' => $service], "url", $data->avatar);
                if (!empty($id)) {
                    $role = Role::getAll()->where('slug', 'customer')->first();
                    if (!empty($role)) {
                        (new RoleUser)->store(['user_id' => $id, 'role_id' => $role->id]);
                    }
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
            }
            $user = User::where('id', '=', $id)->first();
        }
        Auth::guard('user')->login($user);
        Cart::cartDataTransfer();
        Compare::compareDataTransfer();
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
        return redirect()->route('site.index')->withCookie($cookie);
    }

    /**
     * forget password
     *
     * @return forget password form
     */
    public function reset()
    {
        return view('site.auth.forgot');
    }

    /**
     * Opt form
     *
     * @return forget password form
     */
    public function resetOtp()
    {
        return view('site.auth.otp');
    }

    /**
     * Opt form
     *
     * @return forget password form
     */
    public function verificationOtp()
    {
        return view('site.auth.verification');
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

            $link = route('site.password.reset', ['token' => $request['token']]);
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
            return redirect()->route('site.reset.otp');
        }
        return redirect()->back();

    }

    /**
     * showResetForm method
     * @param  string $tokens
     * @return show reset password page view
     */
    public function showResetForm(Request $request, $tokens)
    {
        if ($tokens == 'otp') {
            $tokens = $request->token;
        }

        $token = (new PasswordReset)->tokenExist($tokens);

        if (empty($token)) {
            return redirect()->route('site.reset.otp')->withErrors(['email' => __("Invalid password token")]);
        }

        $data = ['token' => $tokens];
        $data['user'] = (new User)->getData($tokens);
        if (!$data['user']) {
            return redirect()->route('site.reset.otp')->withErrors(['email' => __("Invalid password tokens")]);
        }

        return view('site.auth.reset', $data);
    }

    /**
     * User verification with OTP
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function userVerification(Request $request)
    {
        if (empty($request->token)) {
            return redirect()->back()->withErrors(['otp' => __("The OTP field is required.")]);
        }

        $user = User::where('activation_otp', $request->token);
        if ($user->count() == 0) {
            $response['message'] = __('Your OTP is invalid.');
            return redirect()->back()->withErrors(['otp' =>__('Your OTP is invalid.')]);
        }

        $user->update(['activation_otp' => null, 'activation_code' => null, 'status' => 'Active']);
        return redirect()->route('site.login');
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
                    $message = str_replace('{company_url}', route('site.login'), $message);

                    $emailResponse = $this->email->sendEmail($response['data']->email, $subject, $message, null, $prefer['company_name']);
                    if ($emailResponse['status'] == false) {
                        return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
                    }

                    $data['status'] = 'success';
                    $data['message'] = __('Password update successfully.');
                } else {
                    $data['message'] = __('Nothing is updated.');
                }
            } else {
                $data['message'] = $response['message'];
            }
        }
        $this->setSessionValue($data);
        return $this->login(__('Password reset successfully.'));
    }

    /**
     * @param string $email
     * @return json $response
     */
    public function checkEmailExistence($email)
    {
        $response['status'] = 1;

        if (!empty($email) && User::where('email', $email)->count() > 0) {
            $response['message'] =  __("Email already has been taken.");
            return $response;
        }
        $response['message'] =  '';
        return $response;

    }

}
