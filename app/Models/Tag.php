<?php

namespace App\Models;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Cache;

class Tag extends Model
{
    use ModelTrait;
    /**
     * Relation with ItemTag model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemTag()
    {
        return $this->hasMany('App\Models\ItemTag', 'tag_id', 'id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        if (!empty($id)) {
            self::forgetCache();
            return $id;
        }
        return false;
    }

}
