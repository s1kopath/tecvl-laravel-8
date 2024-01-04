<?php

namespace App\Models;

use App\Models\Model;

class Wishlist extends Model
{
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

    public function store($data)
    {
        $data['browser_agent'] = browserAgent();
        $data['ip_address'] = getIpAddress();
        $response = ['status' => 0, 'message' => __('Something went wrong, please try again.')];
        
        if (parent::insert(array_intersect_key($data, array_flip((array) ['item_id', 'user_id', 'browser_agent', 'ip_address'])))) {
            $response = ['status' => 1, 'message' => __('Item added to your wishlist.')];
        }
        return $response;
    }

    public function checkExistence($userId, $itemId)
    {
        $check = parent::where('user_id', $userId)->where('item_id', $itemId)->first();
        if (!empty($check)) {
            return true;
        }
        return false;

    }
}
