<?php
/**
 * @package WithdrawalMethod
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 20-02-2022
 */
namespace App\Models;
use App\Models\Model;

class WithdrawalMethod extends Model
{
    public $timestamps = false;


    /**
     * Relation with UserWithdrawalSetting model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function withdrawalSetting()
    {
        return $this->hasOne(UserWithdrawalSetting::class);
    }

    /**
     * Update
     * @param  array  $request
     * @return array
     */
    public function updateData($data = [])
    {
        $result = parent::where('id', $data['id']);
        if ($result->exists()) {
            $result->update(array_intersect_key($data, array_flip((array) ['status'])));
            self::forgetCache();
            return 1;
        }
        return 0;

    }
}
