<?php
/**
 * @package ItemAttribute
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 05-10-2021
 */
namespace App\Models;

use App\Models\Model;

class ItemAttribute extends Model
{
    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * Foreign key with Attribute model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute', 'attribute_id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (parent::insert($data)) {
            self::forgetCache();
            return true;
        }
        return false;
    }

    /**
     * Update Item Attribute
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItemAttribute($data = [], $id = null, $itemId = null)
    {
        $result = parent::where('attribute_id', $id)->where('item_id', $itemId);
        if ($result->exists()) {
            $result->update($data);
            self::forgetCache();
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null, $itemId = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::where('attribute_id', $id)->where('item_id', $itemId);
        if ($record->exists()) {
            try {
                $record->delete();
                self::forgetCache();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Attribute')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }
}
