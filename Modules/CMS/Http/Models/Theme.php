<?php
/**
 * @package Slide Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 26-12-2021
 */

namespace Modules\CMS\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;

class Theme extends Model
{
    use ModelTrait, hasFiles;

    /**
     * Relation wirh File Model
     * @var boolean
     */


    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
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
    public function updateBanner($data = [], $id = null)
    {
        $result = $this->where('id', $id);
        if ($result->exists()) {
            if ($result->update($data)) {
                $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
                return true;
            }
        }

        return false;
    }

    /**
     * delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' =>  __('Slide does not found.')];
        $slide = $this->where('id', $id)->first();
        if (empty($slide)) {
            return $data;
        }

        if ($slide->delete()) {
            $slide->deleteFiles(['thumbnail' => true]);
            $data = ['status' => 'success', 'message' =>  __('Slide has been successfully deleted.')];
        }
        return $data;
    }
}
