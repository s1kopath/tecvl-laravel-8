<?php
/**
 * @package Option Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 05-09-2021
 */
namespace App\Models;

use App\Models\Model;

class Option extends Model
{
    public $timestamps = false;
    /**
     * Foreign key with OptionGroup model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroup()
    {
        return $this->belongsTo('App\Models\OptionGroup', 'option_group_id');
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
            return true;
        }
        return false;
    }

    /**
     * Update Option Value
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateOption($data = [], $id = null)
    {
        $result = parent::where('id', $id);
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
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::where('id',$id);
        if (($record->exists())) {
            try {
                $record->delete();
                self::forgetCache(['options', 'option_groups']);
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Option')]) . __('Value');
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }
}
