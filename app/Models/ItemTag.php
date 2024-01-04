<?php

namespace App\Models;

use App\Models\Model;

class ItemTag extends Model
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
     * Foreign key with Tag model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (parent::insert($data)) {
            return true;
        }
        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null, $tagId = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::where('item_id', $id)->where('tag_id', $tagId);
        if ($record->exists()) {
            try {
                $record->delete();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Attribute')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }


}
