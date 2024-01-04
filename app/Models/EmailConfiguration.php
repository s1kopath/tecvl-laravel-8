<?php
/**
 * @package EmailConfiguration
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Models;

use App\Models\Model;
use App\Rules\{
  CheckValidEmail
};
use Validator;

class EmailConfiguration extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function validation($data = [])
    {
        $validator = Validator::make($data, [
            'protocol' => 'required|in:smtp,sendmail',
            'encryption' => 'required',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_email' => ['required', 'email', new CheckValidEmail],
            'from_address' => ['required', 'email', new CheckValidEmail],
            'from_name' => ['required'],
            'smtp_username' => ['required'],
            'smtp_password' => 'required'
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $request
     * @return boolean
     */
    public function store($request = [])
    {
        if (parent::updateOrInsert(['id' => 1], $request)) {
            self::forgetCache();
            return true;
        }

       return false;
    }

}
