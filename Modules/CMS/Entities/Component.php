<?php

namespace Modules\CMS\Entities;

use App\Models\Model;
use App\Traits\ModelTraits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Component extends Model
{
    use HasFactory, Cachable;

    protected $fillable = ['page_id', 'layout_id', 'level'];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\ComponentFactory::new();
    }

    public function properties()
    {
        return $this->hasMany(\Modules\CMS\Entities\ComponentProperty::class, 'component_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(\Modules\CMS\Entities\Page::class);
    }

    public function layout()
    {
        return $this->belongsTo(\Modules\CMS\Entities\Layout::class);
    }

    public static function componentReorder($page_id, $oldLevel, $newLevel)  // 2   1
    {
        $updatableComponents = self::where('page_id', $page_id);
        if ($oldLevel) {
            if ($newLevel == $oldLevel) {
                return;
            } elseif ($newLevel > $oldLevel) {
                $updatableComponents->where('level', '>', $oldLevel)
                    ->where('level', '<=', $newLevel)
                    ->decrement('level');
            } else {
                $updatableComponents->where('level', '<', $oldLevel)
                    ->where('level', '>=', $newLevel)
                    ->increment('level');
            }
        } else {
            $updatableComponents->where('level', '>=', $newLevel)->increment('level');
        }
        return;
    }
}
