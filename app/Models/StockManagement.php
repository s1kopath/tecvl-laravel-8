<?php

namespace App\Models;

use App\Models\Model;

class StockManagement extends Model
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
     * Foreign key with Location model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    /**
     * Relation with StockManagementDetail model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockManagementDetail()
    {
        return $this->hasMany('App\Models\StockManagementDetail', 'stock_management_id', 'id');
    }
}
