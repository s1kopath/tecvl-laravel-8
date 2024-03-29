<?php
/**
 * @package ItemRelate
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 16-10-2021
 */
namespace App\Models;

use App\Rules\CheckDuplicateItem;
use App\Models\Model;
use Validator;

class ItemRelate extends Model
{
    public $timestamps = false;
    protected $fillable = ['item_id','related_item_id'];

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relatedItem()
    {
        return $this->belongsTo('App\Models\Item', 'related_item_id');
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [], $id = null)
    {
        $validator = Validator::make($data, [
            'related_item_id' => ['required', new CheckDuplicateItem('relate', $id)],
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (parent::insert($data)) {
            self::forgetCache();
        }
        return false;
    }

    /**
     * Update Item Relate
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItemRelated($data = [], $id = null)
    {
        $result = parent::where('item_id', $id);
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
    public function remove($id = null, $relatedId = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::where('item_id', $id)->where('related_item_id', $relatedId);
        if ($record->exists()) {
            try {
                $record->delete();
                self::forgetCache();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Related Items')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }
}
