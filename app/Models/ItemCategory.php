<?php

namespace App\Models;

use App\Models\Model;

class ItemCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['item_id','category_id'];
    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * Foreign key with Category model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $lastItem = parent::create($data);
        if (!empty($lastItem)) {
            self::forgetCache();
            return $lastItem->id;
        }
        return false;
    }

    /**
     * Update Item Category
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItemCategory($data = [], $id = null)
    {
        $result = parent::where('item_id', $id);
        if ($result->exists()) {
            $result->update($data);
            self::forgetCache();
            return true;
        }

        return false;
    }
}
