<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{

    /**
     * relation with search table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function search()
    {
        return $this->belongsTo('App\Models\Search', 'search_id');
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
            return $id;
        }
        return false;
    }
}
