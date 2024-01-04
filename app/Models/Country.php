<?php
/**
 * @package Country
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 20-05-2021
 */

namespace App\Models;
use App\Models\Model;

class Country extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Get Country
     * @param  string $id
     * @return string
     */
    public static function getCountry($id = null)
    {
        $country = self::getAll()->where('id', $id)->first();
        return $country->name;
    }
}
