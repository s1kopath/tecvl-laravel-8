<?php
/**
 * @package Review
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 25-07-2021
 */
namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use App\Models\Model;
use Validator;

class Review extends Model
{
    use ModelTrait, hasFiles;
    public $timestamps = false;
    /**
     * Foreign key with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required',
            'rating' => 'required',
            'status' => 'required|in:Active,Inactive',
            'is_public'  => 'required|in:1,0',
        ]);

        return $validator;
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'status' => 'required|in:Active,Inactive',
        ]);

        return $validator;
    }
    /**
     * User Review Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function userUpdateValidation($data = [])
    {
        $validator = Validator::make($data, [
            'rating' => 'required'
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);

        $this->uploadFiles(['isUploaded' => false, 'isSavedInObjectFiles' => true, 'isOriginalNameRequired' => true, 'thumbnail' => false]);

        if (!empty($id)) {
            return $id;
        }
        return false;
    }

    /**
     * Update Brand
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateReview($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {

            $result->update($data);
            $this->uploadFiles(['isUploaded' => false, 'isSavedInObjectFiles' => true, 'isOriginalNameRequired' => true, 'thumbnail' => false]);
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            try {
                $record->delete();

                #delete file region
                $record->deleteFiles(['thumbnail' => false]);

                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Review')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    /**
     * Get specific vendor review
     * @return array
     */
    public static function getVendorReviews($vendorId = null, $item = null) {
        if (empty($vendorId)) {
            return false;
        }
        $data = parent::select('id', 'comments', 'rating', 'is_public', 'status', 'item_id', 'user_id')
        ->whereHas('item', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with(['item:id,name', 'user:id,name']);

        if (empty($item)) {
            return $data;
        }
        return $data->where('item_id', $item);
    }

    /**
     * Check verified user
     * @return bool
     */
    public function verifiedUser($userId, $itemId) {
        return \DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('order_details.item_id', 'orders.user_id')
            ->where('order_details.item_id', $itemId)
            ->where('orders.user_id', $userId)
            ->count() > 0 ? true : false;
    }
}
