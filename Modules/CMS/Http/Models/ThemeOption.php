<?php
/**
 * @package Theme Option Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 29-01-2022
 */

namespace Modules\CMS\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;


class ThemeOption extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'name';
    protected $fillable = ['name', 'value'];
    public $timestamps = false;
    use ModelTrait, hasFiles;
    /**
     * Relation wirh File Model
     * @var boolean
     */

    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'themeOption');
    }
    public function store($data = [])
    {
        foreach($data as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            parent::updateOrInsert(['name' => $key], ['value' => $value]);
        }
        $this->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);
        self::forgetCache();
        return true;
    }

    public function getKeyValueAttribute()
    {
        if($this->isJson($this->value)) {
            return json_decode($this->value, true);
        }

        return $this->value;
    }

    public function isJson($string) {
        return  is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
