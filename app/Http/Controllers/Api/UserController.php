<?php
/**
 * @package UserController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 29-05-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Http\Requests\Admin\AuthUserRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Resources\{
    UserResource,
    userDetailResource,
};
use App\Models\{
    EmailTemplate,
    File,
    Language,
    Preference,
    User
};
use Illuminate\Http\Request;
use DB;
use Cache;

class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param EmailController $email
     */
    public function __construct(EmailController $email)
    {
        $this->email = $email;
    }

    /**
     * User List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs        = $this->initialize([], $request->all());
        $user           = User::with('avatarFile');
        $name           = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $user->where('name', strtolower($name));
        }
        $email = isset($request->email) ? $request->email : null;
        if (!empty($email)) {
            $user->where('email', strtolower($email));
        }
        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $user->where('status', strtolower($status));
        }
        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $user->where('id', $keyword);
            } else if (strlen($keyword) >= 2) {
                $user->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('email', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('status', $keyword);
                });
            }
        }
        return $this->response([
            'data' => UserResource::collection($user->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($user->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Store User
     * @param Request $request
     * @return json $data
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->isMethod('post')) {
            if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'active' => 'active', 'inactive' => 'inactive'])) {
                $request['status'] = strtolower($request->status);
            }
            try {
                DB::beginTransaction();
                $password            = $request->password;
                $request['password'] = \Hash::make($request->password);
                $request['email']    = validateEmail($request->email) ? strtolower($request->email) : null;
                $id                  = (new User)->store($request->only('name', 'email', 'password', 'status'));
                if (!empty($id)) {
                    if (isset($request->send_mail) && isset($request->email) && !empty($request->email) && validateEmail($request->email)) {
                        // Retrive preference value and field name and language id
                        $prefer     = preference();
                        $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                        // Retrive welcome user email template
                        $parent    = EmailTemplate::getAll()->where('slug', 'user')->where('language_id', $languageId)->first();
                        $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();

                        $subject = $emailInfo->subject;
                        $message = $emailInfo->body;

                        // Replacing template variable
                        // Need to change assigned by whom value with auth user
                        $subject = str_replace('{company_name}', $prefer['company_name'], $subject);
                        $message = str_replace('{user_name}', $request->name, $message);
                        $message = str_replace('{user_id}', $request->email, $message);
                        $message = str_replace('{user_pass}', $password, $message);
                        $message = str_replace('{company_url}', url('/login'), $message);
                        $message = str_replace('{company_name}', $prefer['company_name'], $message);
                        // Send Mail to the customer
                        $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

                        if ($emailResponse['status'] == false) {
                            DB::rollBack();
                            return $this->errorResponse([], 500, $emailResponse['message']);
                        }
                    }
                    // File Upload
                    if (isset($request->attachment) && !empty($request->attachment) && $request->hasFile('attachment')) {
                        $path       = createDirectory("public/uploads/user");
                        $fileIdList = (new File)->store([$request->attachment], $path, 'USER', $id, ['isUploaded' => false, 'isOriginalNameRequired' => true]);

                        if (isset($fileIdList[0]) && !empty($fileIdList[0])) {
                            $uploadedFileName = File::find($fileIdList[0])->file_name;
                            $uploadedFilePath = asset($path . '/' . $uploadedFileName);
                            $thumbnailPath    = createDirectory("public/uploads/user/thumbnail");
                            (new File)->resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath);
                        }
                    }
                    // File Upload End
                    DB::commit();
                    return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('User Info')]));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->errorResponse([], 500,  $e->getMessage());
            }
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'users', ['getData' => true]);
            if ($response['status'] === true) {
                $validator = User::updatePasswordValidation($request->all());
                if ($validator->fails()) {
                    return $this->unprocessableResponse($validator->messages());
                }
                $password              = $request->password;
                $request['updated_at'] = date('Y-m-d H:i:s');
                $request['password']   = \Hash::make(trim($request->password));
                if ((new User)->updateUser($request->only('password', 'updated_at'), $id)) {
                    if (isset($request->send_mail) && !empty($request->send_mail)) {
                        // Retrive preference value and field name and language id
                        $prefer     = preference();
                        $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                        // Retrive welcome user email template
                        $parent    = EmailTemplate::getAll()->where('slug', 'update-password')->where('language_id', $languageId)->first();
                        $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();
                        $subject   = $emailInfo->subject;
                        $message   = $emailInfo->body;

                        // Replacing template variable
                        $message = str_replace('{user_name}', $response['data']->name, $message);
                        $message = str_replace('{user_id}', $response['data']->email, $message);
                        $message = str_replace('{user_pass}', $password, $message);
                        $message = str_replace('{company_name}', $prefer['company_name'], $message);
                        $message = str_replace('{company_url}', route('login'), $message);

                        $emailResponse = $this->email->sendEmail($response['data']->email, $subject, $message, null, $prefer['company_name']);
                        if ($emailResponse['status'] == false) {
                            return $this->errorResponse([], 500, $emailResponse['message']);
                        }
                    }
                    return $this->okResponse([], __('Password update successfully.'));
                }
            }
            return $this->response([], 204, $response['message']);
        }

    }

    /**
     * Detail User
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response       = $this->checkExistance($id, 'users');
        $userData   = User::with('avatarFile')->where('id', $id)->first();
        if ($response['status'] === true && !empty($userData)) {
            return $this->response(['data' => new userDetailResource($userData)]);
        }
        return $this->response([], 204, $response['message']);
    }
    /**
     * Update User Information
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'users');
            if ($response['status'] === true) {
                if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'active' => 'active', 'inactive' => 'inactive'])) {
                    $request['status'] = strtolower($request->status);
                }
                $validator = User::updateValidation($request->all(), $id);
                if ($validator->fails()) {
                    return $this->unprocessableResponse($validator->messages());
                }
                try {
                    DB::beginTransaction();
                    $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;
                    if ((new User)->updateUser($request->only('name', 'email', 'status'), $id)) {
                        if (isset($request->attachment) && !empty($request->attachment)) {
                            #delete file region
                            $fileIds     = array_column(json_decode(json_encode(File::Where(['object_type' => 'USER', 'object_id' => $id])->get(['id'])), true), 'id');
                            $oldFileName = isset($fileIds) && !empty($fileIds) ? File::find($fileIds[0])->file_name : null;
                            if (isset($fileIds) && !empty($fileIds)) {
                                (new File)->deleteFiles('USER', $id, ['ids' => [$fileIds], 'isExceptId' => false], $path = 'public/uploads/user');
                            }
                            #end region

                            #region store files
                            if (isset($id) && !empty($id) && $request->hasFile('attachment')) {
                                $path       = createDirectory("public/uploads/user");
                                $fileIdList = (new File)->store([$request->attachment], $path, 'USER', $id, ['isUploaded' => false, 'isOriginalNameRequired' => true, 'resize' => false]);
                                if (isset($fileIdList[0]) && !empty($fileIdList[0])) {
                                    $uploadedFileName = File::find($fileIdList[0])->file_name;
                                    $uploadedFilePath = asset($path . '/' . $uploadedFileName);
                                    $thumbnailPath    = createDirectory("public/uploads/user/thumbnail");
                                    (new File)->resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath, $oldFileName);

                                    Cache::forget(config('cache.prefix') . '-user-0-avatar-' . $id);
                                    Cache::forget(config('cache.prefix') . '-user-1-avatar-' . $id);
                                }
                            }
                            #end region
                        }
                        DB::commit();
                        return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('User Info')]));
                    } else {
                        return $this->okResponse([], __('No changes found.'));
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $this->errorResponse([], 500,  $e->getMessage());
                }
            }
            return $this->response([], 204, $response['message']);
        }
    }

    /**
     * Remove the specified User from db.
     * @param Request $request
     * @return json $data
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'users');
            if ($response['status'] === true) {
                $result  = (new User)->remove($id);
                return  $this->okResponse([], $result['message']);
            }
            return $this->response([], 204, $response['message']);
        }
    }
}
