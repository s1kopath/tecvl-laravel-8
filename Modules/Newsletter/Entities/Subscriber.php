<?php

namespace Modules\Newsletter\Entities;

use App\Models\Model;

class Subscriber extends Model
{

    protected $fillable = [];

    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
        $response = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        if (parent::insert($data)) {
            self::forgetCache();
            $response = ['status' => 'success', 'message' => __('A confirmation mail has been send to your email address.')];
        }

        return $response;
    }

    /**
     * Update
     * @param  array  $request
     * @param  string $id
     * @return array
     */
    public function updateData($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Subscriber not found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $request['confirmation_date'] = DbDateFormat($request['confirmation_date']);
            $result->update($request);
            self::forgetCache();
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Subscriber information')])];
        }
        return $data;
    }

    /**
     * delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Subscriber not found.')];
        $record = parent::find($id);
        if (!empty($record)) {
            $record->delete();
            self::forgetCache();
            $data = ['status' => 'success', 'message' =>  __('The :x has been successfully deleted.', ['x' => __('Subscriber')])];
        }
        return $data;
    }

}
