<?php
/**
 * @package ItemOption
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 05-10-2021
 */
namespace App\Models;

use App\Traits\ModelTraits\hasFiles;
use App\Models\Model;

class ItemOption extends Model
{
    use hasFiles;
    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory', 'item_option_id', 'id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        if (!empty($id)) {
            self::forgetCache();
            return $id;
        }
        return false;
    }

    /**
     * Update Option
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItemOption($data = [], $id = null)
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
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Option')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    /**
     * Upload Image
     * @return null
     */
    public function uploadImage()
    {
        $this->uploadFiles(['isUploaded' => true, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
    }

    /**
     * Import
     * @param  array  $data
     * @return int|null
     */
    public function import($data = [])
    {
        $data = parent::insert($data);
        if (!empty($data)) {
            self::forgetCache();
            return true;
        }
        return false;
    }
}
