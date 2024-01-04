<?php
/**
 * @package Slider Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 01-05-2022
 */

namespace Modules\CMS\Http\Models;

use App\Models\Model;

class Slider extends Model
{

    /**
     * Foreign key with Slider model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
        $data['slug'] = \Str::slug($data['name']);
        if (parent::insertGetId($data)) {
            return true;
        }
        return false;
    }
   /**
     * Update
     * @param  array  $data
     * @param  string $id
     * @return array
     */
    public function updateData($data = [])
    {
        $result = $this->where('id', $data['id']);
        if ($result->exists()) {
                if( $result->update($data)) {
                return true;
            }
        }

        return false;
    }
    /**
     * Delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        $result = $this->where('id', $id)->first();
        if (empty($result)) {
            $data = ['status' => 'fail', 'message' =>  __('Slider does not found.')];
        } else {
            if ($result->delete()) {
                $data = ['status' => 'success', 'message' =>  __('Slider has been successfully deleted.')];
            } else {
                $data = ['status' => 'fail', 'message' =>  __('Something went wrong.')];
            }
        }
        return $data;
    }

    protected function getAllCategory($name = null, $status = null)
    {
        $category = BannerCategory::select('id', 'name', 'status', 'created_at');
        if (!empty($name)) {
        $category->where('name', $name);
        }
        if (!empty($status)) {
        $category->where('status', $status);
        }
        return $category;
    }

}
