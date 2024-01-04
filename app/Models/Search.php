<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

    /**
     * relation with userSearch table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSearch()
    {
        return $this->hasMany('App\Models\UserSearch', 'search_id', 'id');
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (isset($data['name'])) {
            $searchData = parent::where('name', $data['name']);
            if (!$searchData->exists()) {
                $id = parent::insertGetId($data);
                if (!empty($id)) {
                    return $id;
                }
                return false;
            } else {
                $searchData->first()->incrementTotal();
                return $searchData->first()->id;
            }
        }
        return false;
    }

    /**
     * Increase countdown
     * @param float $amount
     * @return void
     */
    public function incrementTotal($data = 1)
    {
        $this->increment('total', $data);
    }
}
