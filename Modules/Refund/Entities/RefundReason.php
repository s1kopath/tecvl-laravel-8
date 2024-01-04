<?php

/**
 * @package RefundReason model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 24-02-2022
 */

namespace Modules\Refund\Entities;

use App\Models\Model;
use Cache, Validator;

class RefundReason extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation with Refund model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
