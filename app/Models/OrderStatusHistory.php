<?php
/**
 * @package OrderStatusHistory
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 03-02-2022
 */
namespace App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use ModelTrait;

    /**
     * Foreign key with item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Foreign key with item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status_id');
    }

    /**
     * Foreign key with item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
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
     * Update
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateOrder($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
            return true;
        }

        return false;
    }
}
