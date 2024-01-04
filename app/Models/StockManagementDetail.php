<?php

namespace App\Models;

use App\Models\Model;

class StockManagementDetail extends Model
{
    /**
     * Foreign key with StockManagement model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockManagement()
    {
        return $this->belongsTo('App\Models\StockManagement', 'stock_management_id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
