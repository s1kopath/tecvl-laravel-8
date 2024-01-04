<?php
/**
 * @package ItemDetail
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 29-01-2022
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'item_id','warranty_type','warranty_period','warranty_policy','is_track_inventory','is_discount','shipping_id','is_hide_stock','is_featured','is_cash_on_delivery','tax_id'
    ];
    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * relation with item_options table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemOption()
    {
        return $this->belongsTo('App\Models\ItemOption', 'item_id', 'item_id');
    }

    /**
     * Foreign key with Shop model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping()
    {
        return $this->belongsTo('Modules\Shipping\Entities\Shipping', 'shipping_id');
    }

    /**
     * Foreign key with Tax model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo('App\Models\Tax', 'tax_id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (parent::create($data)) {
            return true;
        }
        return false;
    }

    /**
     * Update Option
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItemDetail($data = [], $id = null)
    {
        if (parent::updateOrInsert(['item_id' => $id], $data)) {
            return true;
        }

        return false;
    }
}
