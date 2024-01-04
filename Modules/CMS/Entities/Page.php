<?php

namespace Modules\CMS\Entities;

use App\Models\Model;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, ModelTrait;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\PageFactory::new();
    }

    public function scopeSlug($query, $slug)
    {
        $query->where('slug', $slug);
    }

    public function scopeDefault($query, $flag = 1)
    {
        $query->where('default', $flag);
    }

    public function components()
    {
        return $this->hasMany(\Modules\CMS\Entities\Component::class);
    }
}
