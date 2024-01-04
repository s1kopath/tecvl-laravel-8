<?php

namespace App\Models;

use App\Models\Model;

class VendorUser extends Model
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
     * Foreign key with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Store
     * @param  array  $data
     * @return boolean
     */
    public function store($data = [])
    {
    	if (parent::insert($data)) {
            self::forgetCache();
    		return true;
    	}

        return false;
    }
}
