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
use App\Traits\ModelTraits\Cachable;
use App\Traits\ModelTraits\hasFiles;
use Modules\MediaManager\Http\Models\ObjectFile;

class Slide extends Model
{
    use ModelTrait, hasFiles, Cachable;

    /**
     * Relation wirh File Model
     * @var boolean
     */
    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'pages');
    }

    public function objectImage()
    {
        return $this->hasOne('Modules\MediaManager\Http\Models\ObjectFile', 'object_id')->where('object_type', 'slides');
    }

    /**
     * Foreign key with Slide Category model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

     /**
     * Animation style value
     */
    protected function animationStyle()
    {
        return array(
            "fadeIn" =>  __('fadeIn'),
            "fadeInDown" => __('fadeInDown'),
            "fadeInLeft" => __('fadeInLeft'),
            "fadeInRight" => __('fadeInRight'),
            "fadeInUp" => __('fadeInUp'),
            "flip" => __('flip'),
            "flipInX" => __('flipInX'),
            "flipInY" => __('flipInY'),
            "slideInUp" => __('slideInUp'),
            "slideInDown" => __('slideInDown'),
            "slideInLeft" => __('slideInLeft'),
            "slideInRight" => __('slideInRight'),
            "rollIn" => __('rollIn'),
          );
    }

    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
        if (parent::insertGetId($data)) {
            $fileIds = [];
		if(request()->has('file_id')) {
			foreach(request()->file_id as $data) {
				$fileIds[] = $data;
			}
		}
        ObjectFile::storeInObjectFiles($this->objectType(), $this->objectId(), $fileIds);
        self::forgetCache();
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
    public function updateData($data = [], $id = null)
    {
        $result = $this->where('id', $id);
        if ($result->exists()) {
            if ($result->update($data)) {
                $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
                self::forgetCache();
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
            self::forgetCache();
        }
        return $data;
    }
}
