<?php

/**
 * @package User
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Models;

use App\Traits\ModelTraits\hasFiles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Rules\{
    CheckValidFile,
    CheckValidEmail,
    StrengthPassword
};
use App\Models\{
    Wishlist,
    Review
};
use Validator;
use DB;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\HasApiTokens;
use App\Models\Wallet;
use App\Traits\ModelTraits\Metable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, ModelTrait, HasApiTokens, hasFiles, Cachable, Metable;

    protected $guard = 'web';

    protected $metaTable = 'users_meta';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne('App\Models\RoleUser');
    }
    public function roleIds()
    {
        return $this->hasMany('App\Models\RoleUser');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_users');
    }

    public function review()
    {
        return $this->hasMany('App\Models\Review', 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }

    /**
     * Relation with StockManagement model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockManagement()
    {
        return $this->hasMany('App\Models\StockManagement', 'user_id', 'id');
    }

    /**
     * Relation with Favorite model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite', 'user_id', 'id');
    }

    /**
     * Relation with Wishlist model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist', 'user_id', 'id');
    }

    /**
     * Relation with VendorUser model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorUser()
    {
        return $this->hasOne('App\Models\VendorUser', 'user_id', 'id');
    }

    public function avatarFile()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'USER');
    }

    /**
     * Relation with CouponRedeem model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couponRedeem()
    {
        return $this->hasMany('Modules\Coupon\Http\Models\CouponRedeem', 'user_id');
    }

    /**
     * Relation with Address model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'user_id', 'id');
    }

    /**
     * Relation with Wallet model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Relation with Transaction model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relation with Refund model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refunds()
    {
        return $this->hasMany(\Modules\Refund\Entities\Refund::class);
    }

    /**
     * Relation with RefundProcess model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refundProcesses()
    {
        return $this->hasMany(\Modules\Refund\Entities\RefundProcess::class);
    }

    /**
     * User single wallet
     * @param mixed $currency
     * return mixed
     */
    public function wallet($currency = null)
    {
        if (optional($this->userWallet($currency))->count() == null && optional($this->createWallet($currency))) {
            return optional($this->userWallet($currency));
        }
        return optional($this->userWallet($currency));
    }

    /**
     * Relation with User withdrawal setting model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withdrawalSettings()
    {
        return $this->hasMany(UserWithdrawalSetting::class);
    }

    /**
     * Relation with Order note history model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderNoteHistories()
    {
        return $this->hasMany(OrderNoteHistory::class);
    }

    /**
     * User wallet
     * @param mixed $currency
     * return collection
     */
    private function userWallet($currency)
    {
        if (is_null($currency)) {
            return $this->wallets()->where('currency_id', preference('dflt_currency_id'))->first();
        }

        if (is_numeric($currency)) {
            return $this->wallets()->where('currency_id', $currency)->first();
        }

        if (is_string($currency)) {
            return $this->wallets()->whereHas('currency', function ($q) use ($currency) {
                return $q->where('name', $currency);
            })->first();
        }

        return collection();
    }

    /**
     * Create user wallet
     * @param mixed $currency
     * @return bool
     */
    private function createWallet($currency)
    {
        $data['currency_id'] = preference('dflt_currency_id');
        $data['user_id'] = $this->id;
        $data['is_default'] = 1;

        if (is_numeric($currency)) {
            $data['currency_id'] = $currency;
        }

        return (new Wallet)->store($data);
    }

    public function vendor()
    {
        return VendorUser::where('user_id', auth()->user()->id)->first();
    }

    protected static function siteStoreValidation($data = [])
    {
        $captchaRule = 'nullable';
        if (isRecaptchaActive()) {
            $data['gCaptcha'] = $data['g-recaptcha-response'] ?? null;
            $captchaRule = 'required|captcha';
        }
        $sendMail = isset($data['send_mail']) && strtolower($data['send_mail']) == 'on' ? 'on' : false;
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:191',
            'email' => ['required', 'max:191', 'unique:users,email', new CheckValidEmail],
            'password' => ['required', 'max:191', 'confirmed', new StrengthPassword],
            'status' => 'required|in:Pending,Active,Inactive,Deleted',
            'send_mail' => 'in:' . $sendMail,
            'attachment'  => [new CheckValidFile(getFileExtensions(2))],
            'gCaptcha' => $captchaRule
        ]);

        return $validator;
    }

    protected static function siteUpdateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:191',
            'email' => ['required', 'max:191', 'unique:users,email,' . $id, new CheckValidEmail],
            'phone' => ['nullable', 'max:45', 'regex:/^[0-9\-\,]*$/'],
            'birthday' => ['nullable', 'regex:/^[0-9]{1,4}[\/\-\.]{1}[0-9]{1,2}[\/\-\.]{1}[0-9]{1,4}$/'],
            'address' => 'nullable|max:200',
            'gender' => 'required|max:6|in:Male,Female',
            'attachment'  => ['nullable', new CheckValidFile(getFileExtensions(2))],
        ], [
            'gender.in' => __('Gender must be either Male or Female')
        ]);

        return $validator;
    }

    protected static function siteUpdatePasswordValidation($data = [])
    {
        $validator = Validator::make($data, [
            'old_password' => 'required|min:5|max:191',
            'new_password' => ['required', 'max:191', new StrengthPassword],
            'confirm_password' => 'required|min:5|max:191|same:new_password',

        ]);

        return $validator;
    }

    /**
     * Update password validation
     * @param  array  $data
     * @return mixed
     */
    protected static function updatePasswordValidation($data = [])
    {
        $sendMail = isset($data['send_mail']) && strtolower($data['send_mail']) == 'on' ? 'on' : false;
        $validator =  Validator::make($data, [
            'password'    => ['required', new StrengthPassword],
            'confirm_password' => 'required|same:password',
            'send_mail' => 'in:' . $sendMail
        ]);

        return $validator;
    }

    /**
     * Update validation
     * @param  array  $data
     * @param  string $id
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3',
            'email' => ['required', 'unique:users,email,' . $id, new CheckValidEmail],
            'status' => 'required|in:Pending,Active,Inactive,Deleted',
            'role_ids' => 'required',
            'attachment'  => [new CheckValidFile(getFileExtensions(2))],
        ]);

        return $validator;
    }

    /**
     * Update password validation
     * @param  array  $data
     * @param  string $id
     * @return mixed
     */
    protected static function updateProfileValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name'        => 'required|min:3|max:191',
            'email'       => ['required', 'max:191', 'unique:users,email,' . $id, new CheckValidEmail],
            'attachment'  => [new CheckValidFile(getFileExtensions(2))],
            'designation' => 'nullable|min:3|max:90',
            'description' => 'nullable|min:3|max:191',
            'facebook'    => 'nullable|url',
            'twitter'     => 'nullable|url',
            'instagram'   => 'nullable|url',
        ]);

        return $validator;
    }

    /**
     * Import validation
     * @param  array  $data
     * @return mixed
     */
    protected static function importValidation($data = [])
    {
        $validator = Validator::make($data, [
            'file' => 'required|mimes:csv,txt|max:1024',
        ], [
            'file.mimes' => __('The file must be a file of type: :x', ['x' => __('CSV')])
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [], $from = null, $url = null)
    {
        $id = parent::insertGetId($data);
        if ($from == 'url') {
            $this->uploadFilesFromUrl($url, ['isUploaded' => false, 'isOriginalNameRequired' => true]);
        } else {
            $this->uploadFiles(['isUploaded' => false, 'isSavedInObjectFiles' => true, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
        }
        if (!empty($id)) {
            self::forgetCache();
            return $id;
        }
        return false;
    }

    /**
     * Update User
     * @param  array  $data
     * @param  string $id
     * @return boolean
     */
    public function updateUser($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data['userData'] ?? $data);
            $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => false, 'isSavedInObjectFiles' => true]);
            $result = $result->first();
            if (isset($data['userMetaData'])) {
                $result->setMeta($data['userMetaData']);
                $result->save();
            }
            self::forgetCache();
            return true;
        }

        return false;
    }

    /**
     * Site Update User
     * @param  array  $data
     * @param  string $id
     * @return boolean
     */
    public function siteUpdatePassword($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
            self::forgetCache();
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];

        $checkSlugs = DB::table('roles')
            ->join('role_users', 'roles.id', '=', 'role_users.role_id')
            ->join('users', 'users.id', '=', 'role_users.user_id')
            ->select('roles.slug')
            ->where('users.id', $id)
            ->get();
        foreach ($checkSlugs as $key => $value) {
            if ($value->slug == 'super-admin') {
                $data['message'] = __("Admin account can't be deleted.");
                return $data;
            }
        }

        $user = parent::find($id);
        if (!empty($user)) {
            try {
                $user->delete();
                $user->deleteFiles(['thumbnail' => true]);

                DB::commit();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('User')]);
            } catch (Exception $e) {
                DB::rollBack();
                $data['message'] = $e->getMessage();
            }
        }
        return $data;
    }

    /**
     * Get user data
     * @param array $data
     * @return boolean
     */
    public function getData($token)
    {
        $reset = PasswordReset::where('otp', $token)->orWhere('token', $token)->first();
        $user = null;
        if (!empty($reset)) {
            $user = parent::where('email', $reset->email)->first();
        }

        if (!empty($user)) {
            return $user;
        }

        return false;
    }

    /**
     * Get username
     * @param array $email
     * @return boolean
     */
    public function getUsername($email)
    {
        $username = parent::where('email', $email)->first()->name;
        if (!empty($username)) {
            return $username;
        }

        return false;
    }

    /**
     * @param $id
     * @return array
     */
    public function getRoleIdsByUserId($id)
    {
        $idList = RoleUser::where('user_id', $id)->get();
        $roleIds = [];
        foreach ($idList as $value) {
            array_push($roleIds, $value->role_id);
        }
        return $roleIds;
    }

    /**
     * @return mixed
     */
    public static function totalWishlist()
    {
        return Wishlist::where('user_id', optional(\Auth::user())->id)->count();
    }

    /**
     * @return mixed
     */
    public static function totalReview()
    {
        return Review::where('user_id', optional(\Auth::user())->id)->count();
    }

    /**
     * @return mixed
     */
    public static function totalOrder()
    {
        return Order::where('user_id', optional(\Auth::user())->id)->count();
    }

    /**
     * Get user role slug
     * @param int $userId
     * @return array
     */
    public static function getSlug($userId)
    {
        $roles = Role::select('slug')->whereIn('id', parent::getRoleIdsByUserId($userId))->get();
        $array = [];
        foreach ($roles as $key => $value) {
            $array[] = $value->slug;
        }
        return $array;
    }

    /**
     * Check verified user
     * @param int $itemId
     * @return bool
     */
    public function verifiedUser($itemId)
    {
        $orderStatuses = OrderStatus::getAll();
        $itemDeliveredId = $orderStatuses->where('order_by', max($orderStatuses->pluck('order_by', 'id')->toArray()))->first()->id;
        return \DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('order_details.item_id', 'order_details.order_status_id', 'orders.user_id')
            ->where('order_details.item_id', $itemId)
            ->where('orders.user_id', $this->id)
            ->where('order_details.order_status_id', $itemDeliveredId)
            ->count() > 0 ? true : false;
    }

    /**
     * @param $currencyId
     * @return mixed
     */
    public function vendorCommission($currencyId = null)
    {
        if (is_null($currencyId)) {
            $currencyId = preference('dflt_currency_id');
        }

        return Transaction::where('vendor_id', session()->get('vendorId'))
            ->where('transaction_type', 'Commission')
            ->where('currency_id', $currencyId)
            ->where('status', 'Accepted')
            ->sum('total_amount');
    }

    /**
     * Check user verification type
     * @param string $type
     * @return boolean
     */
    public static function userVerification($type = null)
    {
        $verificationType = ['otp', 'token', 'both'];
        $preference =  preference('email');

        if (is_null($type) || !in_array($type, $verificationType)) {
            return false;
        }

        foreach ($verificationType as $key => $value) {
            if ($value == $type) {
                return $preference == 'both' || $preference == $value;
            }
        }
    }

    /**
     * Check user refund balance
     * @return float $balance
     */
    public static function refundBalance()
    {
        $refunds = auth()->user()->hasMany(\Modules\Refund\Entities\Refund::class)->where('status', 'Completed')->withSum('orderDetail as item_price', 'price')->get();
        $balance = 0;
        foreach ($refunds as $refund) {
            $balance += $refund->item_price * $refund->quantity_sent;
        }

        return $balance;
    }

    /**
     * Remove user profile picture
     * @return boolean
     */
    public function removeProfileImage()
    {
        if (parent::find(auth()->user()->id)->deleteFiles(['thumbnail' => false])) {
            return true;
        }
        return false;
    }
}
