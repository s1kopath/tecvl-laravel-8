<?php

/**
 * @package RefundProcess model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 24-02-2022
 */

namespace Modules\Refund\Entities;

use App\Models\Model;

use Cache, Validator;

class RefundProcess extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation with Refund model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refund()
    {
        return $this->belongsTo(Refund::class);
    }

    /**
     * Relation with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Store Refund Process
     * @param  array  $data
     * @return mixed
     */
    public function store($data)
    {
        $response = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];

        $refund = Refund::where(['id' => $data['refund_id']]);
        if ($refund->count() == 0 || !in_array($refund->first()->status, ['Opened', 'In progress'])) {
            return $response;
        }

        $data['user_id'] = auth()->user()->id;
        if (parent::insert($data)) {
            if ($refund->first()->status == 'Opened') {
                $refund->update(['status' => 'In progress']);
            }
            $response = ['status' => 'success', 'message' => __('Message has been successfully send.')];
        }
        return $response;
    }
}
