<?php
/**
 * @package VendorController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 23-10-2021
 */

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\{
    EmailTemplate,
    File,
    Language,
    Role,
    User,
    Vendor
};
use Illuminate\Http\Request;
use Auth, Cache, DB;

class VendorController extends Controller
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
     * Profile
     * @return view
     */
    public function profile()
    {
        $userId = Auth::guard('user')->user()->id;
        $data['user'] = isset($userId) && !empty($userId) ? User::getAll()->where('id', $userId)->first() : null;
        $data['roleIds'] = (new User)->getRoleIdsByUserId($userId);
        $data['roles'] = Role::getAll();

        return view('vendor.profile.index', $data);
    }

    /**
     * Update Vendor
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
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

                    $userStore = (new user)->updateUser($request->only('name', 'email'), $id);
                    if ($userStore) {

                        if (isset($request->attachment) && ! empty($request->attachment)) {
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

                                  Cache::forget(config('cache.prefix') . '-user-0-avatar-'. $id);
                                  Cache::forget(config('cache.prefix') . '-user-1-avatar-'. $id);
                                }
                            }
                            #end region
                        }
                        DB::commit();
                        $response['status'] = 'success';
                        $response['message'] = __('The :x has been successfully saved.', ['x' => strtolower(__('Vendor Info'))]);
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
        return redirect()->route('vendor-dashboard');
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
                        $message = str_replace('{user_pass}', $password , $message);
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

        $this->setSessionValue($data);
        return redirect()->route('vendor-dashboard');
    }

    /**
     * logout operation.
     *
     * @return redirect login page view
     */
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');
    }
}
