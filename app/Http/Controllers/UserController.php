<?php

/**
 * @package UserController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\UserListDataTable;
use App\DataTables\UserWalletDataTable;
use Illuminate\Support\Str;
use App\Models\{
    User,
    File,
    EmailTemplate,
    Language,
    Role,
    RoleUser
};
use App\Exports\{
    UserListExport,
};
use App\Http\Requests\Admin\StoreUserRequest;
use Excel, DB, Session, Cache, Auth;

class UserController extends Controller
{
    /**
     * Constructor
     * @param EmailController $email
     */
    public function __construct(EmailController $email)
    {
        $this->email = $email;
    }

    /**
     * User List
     * @param  UserListDataTable $dataTable
     * @return \Illuminate\Contracts\View\View
     */
    public function index(UserListDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index', ['roles' => Role::getAll()]);
    }

    /**
     * Create
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::getAll()]);
    }

    /**
     * Store
     * @param  Request $request [description]
     * @return \Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {

            $password = $request->password;
            $request['password'] = \Hash::make($request->password);
            $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;

            $request['activation_code'] = NULL;
            if ($request->status <> 'Active') {
                $request['activation_code'] = Str::random(10);
            }

            try {
                DB::beginTransaction();
                $id = (new User)->store($request->only('name', 'email', 'activation_code', 'password', 'status'));
                if (!empty($id)) {
                    $roleAll = Role::getAll();
                    $roles = [];
                    foreach ($request->role_ids as $role_id) {
                        $roles[] = ['user_id' => $id, 'role_id' => $role_id];
                        $role = $roleAll->where('id', $role_id)->first();
                    }
                    if (!empty($roles)) {
                        (new RoleUser)->store($roles);
                    }

                    $url = route('login');
                    if ($role->slug == 'customer') {
                        $url = route('site.login');
                    }

                    if ((isset($request->send_mail) && isset($request->email) && !empty($request->email) && validateEmail($request->email)) || ($request->status != 'Active') &&  validateEmail($request->email)) {
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
                        if ($request->status != 'Active') {
                            $url = url('admin/user/verify', $request->activation_code);
                            $message = str_replace('{verification_url}', $url, $message);
                        } else {
                            $message = str_replace('{company_url}', $url, $message);
                        }
                        $message = str_replace('{company_name}', $prefer['company_name'], $message);
                        // Send Mail to the customer
                        $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

                        if ($emailResponse['status'] == false) {
                            \DB::rollBack();
                            return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
                        }
                    }

                    $data['status'] = 'success';
                    $data['message'] = __('The :x has been successfully saved.', ['x' => __('User Info')]);
                    DB::commit();
                }
            } catch (Exception $e) {
                DB::rollBack();
                $data['status'] = 'fail';
                $data['message'] = $e->getMessage();
            }
        }

        Session::flash($data['status'], $data['message']);
        return redirect()->route('users.index');
    }

    /**
     * Verification
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function verification($code)
    {
        $user = User::where('activation_code', $code)->first();
        if (empty($user)) {
            $this->setSessionValue(['status' => 'fail', 'message' => __('Invalid Request')]);
            return redirect('/admin/login');
        } else if ($user->status == 'Active') {
            $this->setSessionValue(['status' => 'fail', 'message' => __('This account is already activated')]);
            return redirect('/admin/login');
        }

        User::where('activation_code', $code)->update(['status' => 'Active', 'activation_code' => NULL, 'email_verified_at' => now()]);
        $this->setSessionValue(['status' => 'success', 'message' => __('Your account is activated, please login')]);
        return redirect('/admin/login');
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id = null)
    {
        $data['profile'] = 'active';
        $data['user'] = User::getAll()->where('id', $id)->first();
        $data['roleIds'] = (new User)->getRoleIdsByUserId($id);
        $data['roles'] = Role::getAll();

        return view('admin.users.edit', $data);
    }

    /**
     * Update password
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function updatePassword(Request $request, $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'users', ['getData' => true]);
            if ($response['status'] === true) {
                $validator = User::updatePasswordValidation($request->all());
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $password = $request->password;
                $request['updated_at'] = date('Y-m-d H:i:s');
                $request['password'] = \Hash::make(trim($request->password));
                if ((new User)->updateUser($request->only('password', 'updated_at'), $id)) {
                    if (isset($request->send_mail) && !empty($request->send_mail)) {
                        // Retrive preference value and field name and language id
                        $prefer = preference();
                        $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                        // Retrive welcome user email template
                        $parent = EmailTemplate::getAll()->where('slug', 'update-password')->where('language_id', $languageId)->first();
                        $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();
                        $subject =  $emailInfo->subject;
                        $message =  $emailInfo->body;

                        // Replacing template variable
                        $message = str_replace('{user_name}', $response['data']->name, $message);
                        $message = str_replace('{user_id}', $response['data']->email, $message);
                        $message = str_replace('{user_pass}', $password, $message);
                        $message = str_replace('{company_name}', $prefer['company_name'], $message);
                        $message = str_replace('{company_url}', route('login'), $message);

                        $emailResponse = $this->email->sendEmail($response['data']->email, $subject, $message, null, $prefer['company_name']);
                        if ($emailResponse['status'] == false) {
                            return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
                        }
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

        Session::flash($data['status'], $data['message']);
        return redirect()->route('users.edit', ['id' => $id]);
    }
    /**
     * Update profile password
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function updateProfilePassword(Request $request, $id = null)
    {
        $this->updatePassword($request, $id);
        return redirect()->route('dashboard');
    }

    /**
     * Update
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'users');
            if ($result['status'] === true) {
                $validator =  User::updateValidation($request->all(), $id);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                try {
                    DB::beginTransaction();
                    $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;
                    $userStore = (new user)->updateUser($request->only('name', 'email', 'status'), $id);

                    if ($userStore) {
                        if (!isset($request->user_profile)) {
                            $request['user_id'] = $id;
                            (new RoleUser)->remove($id);

                            $roles = [];
                            foreach ($request->role_ids as $role_id) {
                                $roles[] = ['user_id' => $id, 'role_id' => $role_id];
                            }
                            if (!empty($roles)) {
                                (new RoleUser)->store($roles);
                            }
                        }

                        DB::commit();
                        $response['status'] = 'success';
                        $response['message'] = __('The :x has been successfully saved.', ['x' => __('User Info')]);
                    }
                } catch (Exception $e) {
                    DB::rollBack();
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        if (isset($request->user_profile)) {
            return redirect()->back();
        }
        return redirect()->route('users.index');
    }

    /**
     * Update Profile
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function updateProfile(Request $request, $id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'users');
            if ($result['status'] === true) {
                $validator =  User::updateProfileValidation($request->all(), $id);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                try {
                    DB::beginTransaction();
                    $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;
                    $data['userData'] = $request->only('name', 'email', 'status');
                    $data['userMetaData'] = $request->only('designation', 'description', 'facebook', 'twitter', 'instagram');
                    $userStore = (new user)->updateUser($data, $id);
                    if ($userStore) {
                        if (isset($request->attachment) && !empty($request->attachment)) {
                            #delete file region
                            $fileIds = array_column(json_decode(json_encode(File::Where(['object_type' => 'USER', 'object_id' => $id])->get(['id'])), true), 'id');
                            $oldFileName = isset($fileIds) && !empty($fileIds) ? File::find($fileIds[0])->file_name : null;
                            if (isset($fileIds) && !empty($fileIds)) {
                                (new File)->deleteFiles('USER', $id, ['ids' => [$fileIds], 'isExceptId' => false], $path = 'public/uploads/user');
                            }
                            #end region

                            #region store files
                            if (isset($id) && !empty($id) && $request->hasFile('attachment')) {
                                $path = createDirectory("public/uploads/user");
                                $fileIdList = (new File)->store([$request->attachment], $path, 'USER', $id, ['isUploaded' => false, 'isOriginalNameRequired' => true, 'resize' => false]);
                                if (isset($fileIdList[0]) && !empty($fileIdList[0])) {
                                    $uploadedFileName = File::find($fileIdList[0])->file_name;
                                    $uploadedFilePath = asset($path . '/' . $uploadedFileName);
                                    $thumbnailPath = createDirectory("public/uploads/user/thumbnail");
                                    (new File)->resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath, $oldFileName);

                                    Cache::forget(config('cache.prefix') . '-user-0-avatar-' . $id);
                                    Cache::forget(config('cache.prefix') . '-user-1-avatar-' . $id);
                                }
                            }
                            #end region
                        }
                        DB::commit();
                        $response['status'] = 'success';
                        $response['message'] = __('The :x has been successfully saved.', ['x' => strtolower(__('User Info'))]);
                    }
                } catch (Exception $e) {
                    DB::rollBack();
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('dashboard');
    }

    /**
     * Delete
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'users');
            if ($result['status'] === true) {
                $response = (new User)->remove($id);
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('users.index');
    }

    /**
     * Profile
     * @return view
     */
    public function profile()
    {
        $id = Auth::guard('user')->user()->id;
        $data['user'] = User::getAll()->where('id', $id)->first();
        $data['roleIds'] = (new User)->getRoleIdsByUserId($id);
        $data['roles'] = Role::getAll();
        return view('admin.users.profile', $data);
    }

    /**
     * Import User
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.users.import');
        } else if ($request->isMethod('post')) {
            $data = ['status' => 'fail', 'message' => __('Invalid Request')];

            $validator =  User::importValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('file')) {
                $path = $request->file('file')->getRealPath();
                $csv = [];

                if (is_uploaded_file($path)) {
                    $csv = readCSVFile($path, true);
                }

                if (empty($csv)) {
                    return back()->withErrors(__("Your CSV has no data to import"));
                }

                $requiredHeader  = array("Name", "Email", "Password", 'Status');
                $header = array_keys($csv[0]);

                // Check if required headers are available or not
                if (!empty(array_diff($requiredHeader, $header))) {
                    return back()->withErrors(__("Please Check CSV Header Name."));
                }

                $errorMessages = [];
                $emails = User::pluck('email')->toArray();
                $emails = array_change_key_case($emails, CASE_LOWER);
                foreach ($csv as $key => $value) {
                    $errorFails = [];

                    $value = array_map('trim', $value);

                    // check if first name is empty
                    if (empty($value['Name'])) {
                        $errorFails[] = __(':x is required', ['x' => __('Name')]);
                    }

                    // check if there is any value in the email field then the email is not used and a valid email
                    if (empty($value['Email'])) {
                        $errorFails[] = __(':x is required', ['x' => __('Email')]);
                    } else if (empty(validateEmail($value['Email']))) {
                        $errorFails[] = __('Enter a valid email');
                    } else if (in_array(strtolower($value['Email']), $emails)) {
                        $errorFails[] = __(':x is already taken.', ['x' => __('Email')]);
                    }

                    // check if the password is not empty and contains at least five characters
                    if (empty($value['Password'])) {
                        $errorFails[] = __(':x is required', ['x' => __('Password')]);
                    } else if (strlen($value['Password']) < 5) {
                        $errorFails[] = __('Password should be at least 5 characters');
                    }

                    // check if the status is valid
                    if (empty($value['Status'])) {
                        $errorFails[] = __(':x is required', ['x' => __('Status')]);
                    } else if (!(strtolower($value["Status"]) == 'active' || strtolower($value["Status"]) == 'inactive' || strtolower($value["Status"]) == 'pending' || strtolower($value["Status"]) == 'deleted')) {
                        $errorFails[] = __('Status can be either :x, :y, :z or :a.', ['x' => __('Active'), 'y' => __('Inactive'), 'z' => __('Pending'), 'a' => __('Deleted')]);
                    }

                    if (empty($errorFails)) {
                        try {
                            DB::beginTransaction();
                            if (!empty((new User)->store(array_change_key_case($value, CASE_LOWER)))) {
                                array_push($emails, $value['Email']);
                                DB::commit();
                            }
                        } catch (\Exception $e) {
                            DB::rollBack();
                            $errorFails[] = $e->getMessage();
                        }
                    }

                    // set the error messages
                    if (!empty($errorFails)) {
                        $errorMessages[$key] = ['fails' => $errorFails, 'data' => $value];
                    }
                }

                // redirect with success message if no error found.
                if (empty($errorMessages)) {
                    \Session::flash('success', __('Total Imported row: ') . count($csv));
                    return redirect()->route('users.index');
                } else {
                    $data['totalRow'] = count($csv);

                    return view('admin.layouts.includes.csv_import_errors', $data)->with('errorMessages', $errorMessages);
                }
            } else {
                return back()->withErrors(['fail' => __("Please upload a CSV file.")]);
            }
        }
    }

    /**
     * User list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['users'] = User::orderBy('id', 'desc')->get();

        return printPDF($data, 'user_list' . time() . '.pdf', 'admin.users.list_pdf', view('admin.users.list_pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * User list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new UserListExport(), 'user_list' . time() . '.csv');
    }

    /**
     * User wallet
     * @return \Illuminate\Contracts\View\View
     */
    public function wallet(UserWalletDataTable $dataTable, $id = null)
    {
        $data['user'] = User::getAll()->where('id', $id)->first();
        if (!empty($data['user'])) {
            $data['wallet'] = 'active';
            return $dataTable->with(['userId' => $id])->render('admin.users.wallet', $data);
        } else {
            return back()->withErrors(__('Invalid Request'));
        }
    }
}
