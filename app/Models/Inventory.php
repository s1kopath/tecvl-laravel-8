<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemOption()
    {
        return $this->belongsTo('App\Models\ItemOption', 'item_option_id');
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
            return $id;
        }
        return false;
    }

    /**
     * Update inventory
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateInventory($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
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
        $record = parent::where('item_option_id', $id);
        if ($record->exists()) {
            try {
                $record->delete();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Inventory')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    /**
     * Delete with Label
     * @param string $id
     * @return array
     */
    public function removeLabel($id = null, $label = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::where('item_option_id', $id)->where('label', $label);
        if ($record->exists()) {
            try {
                $record->delete();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Inventory')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }
}
