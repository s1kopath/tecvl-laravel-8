<?php

namespace App\Http\Controllers\Api;

use App\Compare\Compare;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\{
    EmailTemplate,
    Language,
    PasswordReset,
    Role,
    RoleUser,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Auth, Validator, Cart;
use DB;

class AuthController extends Controller
{
    public function __construct(EmailController $email)
    {
        $this->email = $email;
    }

    public function signUp(Request $request)
    {
        $role = Role::getAll()->where('slug', 'customer')->first();
        $request['status'] = "Pending";
        $validator =  User::siteStoreValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }

        $password = $request->password;
        $request['password'] = \Hash::make($request->password);
        $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;
        $request['activation_code'] = \Str::random(10);
        $request['activation_otp'] = random_int(1111, 9999);

        try {
            \DB::beginTransaction();
            $id = (new User)->store($request->only('name', 'email', 'activation_code', 'activation_otp', 'password', 'status'));
            if (!empty($id)) {
                if (!empty($role)) {
                    (new RoleUser())->store(['user_id' => $id, 'role_id' => $role->id]);
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
                    $message = str_replace('{verification_otp}',  $request['activation_otp'], $message);
                } else {
                    $message = str_replace('{company_url}', url('/user/login'), $message);
                }
                $message = str_replace('{company_name}', $prefer['company_name'], $message);
                // Send Mail to the customer
                $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

                if ($emailResponse['status'] == false) {
                    \DB::rollBack();
                    return $this->badRequestResponse([], $emailResponse['message']);
                }

               \DB::commit();
                return $this->createdResponse([], __('Registration successful. Please verify your email.'));
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->badRequestResponse([], $e->getMessage());
        }
    }

    /**
     * Login
     * @param  Request $request
     * @return json $data
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'email|required|exists:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }

        if (!auth()->attempt($request->only(['email', 'password']))) {
            return $this->unprocessableResponse(['message' => __('Invalid Credentials')]);
        }
        Cart::cartDataTransfer();
        Compare::compareDataTransfer();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        $userInfo = ['name', 'email', 'email_verified_at', 'status', 'activation_code', 'created_at', 'updated_at'];
        foreach ($userInfo as $value) {
            $data[$value] = auth()->user()->$value;
        }
        $data['image'] = auth()->user()->fileUrl();

        $roleList = [];
        foreach (auth()->user()->roles as $role) {
            $roleList[] = $role->type;
        }
        return $this->response(['user_roles' => $roleList, 'user' => $data, 'access_token' => $accessToken]);
    }

    /**
     * Send Password Reset Link
     * @param  Request $request
     * @return json $data
     */
    public function sendResetLinkEmail(Request $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        $validator =  PasswordReset::storeValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
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

            $link = url('password/resets', $request['token']);
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
                return $this->response(['fail' => $emailResponse['message']]);
            }
            $data['status'] = 'success';
            $data['message'] = __('Password reset link sent to your email address.');
            \DB::commit();
        } catch (Exception $e) {
            \DB::rollBack();
            $data['status'] = 'fail';
            $data['message'] = $e->getMessage();
        }
        return $this->response($data);
    }

    /**
     * Check OTP validity
     * @param number $otp
     * @return json $data
     */
    public function checkOtp($otp)
    {
        $token = (new PasswordReset)->tokenExist($otp);

        if (empty($token)) {
            return $this->unprocessableResponse(['otp' => __("Invalid OTP")]);
        }

        $data = ['token' => $otp];
        $data['user'] = (new User)->getData($otp);

        if (!$data['user']) {
            return $this->unprocessableResponse(['otp' => __("Invalid OTP")]);
        }

        return $this->successResponse(__('OTP verification successful.'));
    }

    /**
     * Reset Password
     * @param Request $request
     * @return json $data
     */
    public function setPassword(Request $request)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $data['user'] = (new User)->getData($request->token);
            $validator = PasswordReset::passwordValidation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            $password = $request->password;
            $request['updated_at'] = date('Y-m-d H:i:s');
            $request['password'] = \Hash::make(trim($request->password));
            if ((new PasswordReset)->updatePassword($request->only('password', 'token', 'updated_at'), $data['user']->id)) {

                // Retrive preference value and field name and language id
                $prefer = preference();
                $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                // Retrive welcome new password set email template
                $parent = EmailTemplate::getAll()->where('slug', 'new-password-set')->where('language_id', $languageId)->first();
                $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();
                $subject =  $emailInfo->subject;
                $message =  $emailInfo->body;

                // Replacing template variable
                $message = str_replace('{user_name}', $data['user']->name, $message);
                $message = str_replace('{user_id}', $data['user']->email, $message);
                $message = str_replace('{user_pass}', $password , $message);
                $message = str_replace('{company_name}', $prefer['company_name'], $message);
                $message = str_replace('{company_url}', route('login'), $message);

                $emailResponse = $this->email->sendEmail($data['user']->email, $subject, $message, null, $prefer['company_name']);
                if ($emailResponse['status'] == false) {
                    return $this->unprocessableResponse(['fail' => $emailResponse['message']]);
                }

                $response['status'] = 'success';
                $response['message'] = __('Password update successfully.');
            } else {
                $response['message'] = __('Nothing is updated.');
            }
        }

        return $this->response($response);
    }

    /**
     * User Logout
     * @return json $success
     */
    public function logout()
    {
        Auth::guard('api')->user()->token()->delete();
        $success['status']  = __("Ok");
        $success['message'] = __("Logout successfully");
        return $this->response(['response' => $success]);
    }

    /**
     * save user data
     *
     * @param $data
     */
    public function registerOrLoginUser(Request $request)
    {
        $user = User::where('email', '=', $request->email ?? null)->first();
        if (!$user) {
            try {
                $validator = User::siteStoreValidation($request->all());
                if ($validator->fails()) {
                    return $this->unprocessableResponse($validator->messages());
                }
                DB::beginTransaction();
                $id = (new User)->store(['name' => $request->name, 'email' => $request->email, 'password' => \Hash::make(Str::random(5)), 'status' => 'Active', 'sso_account_id' => $request->id, 'sso_service' => $request->service], "url", $request->avatar);
                if (!empty($id)) {
                    $role = Role::getAll()->where('slug', 'customer')->first();
                    if (!empty($role)) {
                        (new RoleUser)->store(['user_id' => $id, 'role_id' => $role->id]);
                    }
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
                return $this->badRequestResponse([], $e->getMessage());
            }
            $user = User::where('id', '=', $id)->first();
        }
        Auth::guard('user')->login($user);
        Cart::cartDataTransfer();
        Compare::compareDataTransfer();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        $userInfo = ['name', 'email', 'email_verified_at', 'status', 'activation_code', 'created_at', 'updated_at'];
        foreach ($userInfo as $value) {
            $data[$value] = auth()->user()->$value;
        }

        $roleList = [];
        foreach (auth()->user()->roles as $role) {
            $roleList[] = $role->type;
        }
        return $this->response(['user_roles' => $roleList, 'user' => $data, 'access_token' => $accessToken]);
    }
    /**
     * Verify email
     * @param  string $otp
     * @return json $response
     */
    public function verifyEmail($otp = null)
    {
        $response['status'] = 'fail';
        if (empty($otp)) {
            $response['message'] = __('The OTP is required.');
            return $this->notFoundResponse($response);
        }

        $user = User::where('activation_otp', $otp);
        if ($user->count() == 0) {
            $response['message'] = __('Your OTP is invalid.');
            return $this->notFoundResponse($response);
        }

        if ($user->update(['activation_otp' => null, 'activation_code' => null, 'status' => 'Active'])) {
            $response['status'] = 'success';
            $response['message'] = __('Account activation successful. Please login');
            return $this->createdResponse($response);
        }

        $response['message'] = __('Something went wrong, please try again.');
        return $this->response($response);
    }
}
