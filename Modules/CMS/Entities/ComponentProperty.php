<?php

namespace Modules\CMS\Entities;

use App\Models\Model;
use App\Traits\ModelTraits\Cachable;
use App\Traits\ModelTraits\hasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function PHPUnit\Framework\isJson;

class ComponentProperty extends Model
{
    use HasFactory, Cachable, hasFiles;
    public $timestamps = false;
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\ComponentPropertyFactory::new();
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function getValueAttribute()
    {
        $value = $this->attributes['value'];
        if (in_array(substr($value, 0, 1), ['{', '['])) {
            $return = json_decode($value);
            if (json_last_error() == JSON_ERROR_NONE) {
                return $return;
            }
            return [];
        }
        return $value;
    }

    public function getObjectType()
    {
        return $this->objectType();
    }

    public function getObjectId()
    {
        return $this->objectId();
    }
}
