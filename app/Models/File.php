<?php

namespace App\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use Auth;
use Image;
use Illuminate\Support\Facades\DB;

class File extends Model
{
	use ModelTrait, hasFiles;
    public $timestamps = false;
    private $_tempDirectory = "public/contents/temp/";
	protected $casts = [
        'params' => 'array'
    ];
    /**
     * Foreign key with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userAvatar()
    {
    	return $this->belongsTo('App\Models\User', 'object_id');
    }

    /**
     * Foreign key with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'uploaded_by');
    }

    /**
      * [store description]
      * @param  [array] $files      [description]
      * @param  [string] $uploadPath [description]
      * @param  [string] $objectType [description]
      * @param  [int] $objectId   [description]
      * @return [array]             [description]
    */
    public function store($files = null, $uploadPath = null, $options = [], $uploadFrom = 'web')
	{
        $userId = Auth::user()->id;
		$ids = [];
		$params = [];
		if (empty($files) || empty($uploadPath) ) {
			return $ids;
		}

		$options = array_merge(['isOriginalNameRequired' => false, 'isUploaded' => false, 'size' => []], $options);
		$filePath	  = $options['isUploaded'] ? $this->_tempDirectory : "";
        foreach($files as $file) {
			$attribute = [
				'size' => $file->getSize() / 1024,
				'type' => $file->extension()
			];
            $continue = false;
			switch ($options['isUploaded']) {
            	case true:
            		$filename = $file;
            		$originalFileName = implode(array_slice(explode('_', $filename), 2));
            		if (file_exists($filePath . $filename)) {
            			$continue = rename($filePath . $filename, $uploadPath . "/" . $filename);
            		}
            		break;
            	default:
            		$filename = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(" ", "_", $file->getClientOriginalName()));
            		$originalFileName = $file->getClientOriginalName();
                	$filename = $this->checkDirectory().DIRECTORY_SEPARATOR.md5(uniqid()) . "." . $file->getClientOriginalExtension();

                	if (!empty($options['size'])) {
                		try {
							$img = Image::make($file->getRealPath());
						} catch (Intervention\Image\Exception\NotReadableException $e) {
							$img = Image::make(public_path() . '/dist/img/default-image.png');
						}
                		$continue = $img->resize($options['size'][0], $options['size'][1], function ($constraint) {
			                $constraint->aspectRatio();
			            })->save($uploadPath . '/' . $filename);
                	} else {
                		$continue = $file->move($uploadPath, $filePath . $filename);
                	}
            		break;
            }
	        if ($continue) {
				$list = [];
				foreach ($attribute as $key => $array_item) {
					if (!is_null($array_item)) {
						$list[$key] = $array_item;
					}
				}
				$data                     = new File();
				$data->params        = $list;
				$data->original_file_name = $options['isOriginalNameRequired'] ? $originalFileName : NULL;
				$data->file_name          = $filename;
				$data->uploaded_by        = !empty($userId) ? $userId : NULL;
				if ($data->save()) {
					$ids[] = $data->id;
				}
	        }
        }
        return $ids;
	}

    public function storeFromUrl($url = null, $uploadPath = null, $objectType = null, $objectId = null, $options = [])
    {
        $ids = null;
        if (empty($url) || empty($uploadPath) || empty($objectType) || empty($objectId) ) {
            return $ids;
        }
        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $originalFileName = $info['basename'];
        $filename = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(" ", "_", $originalFileName));
        $filename = strtolower(md5(time()) . "_" . "_" . $filename . "." . "jpg");
        $file = $uploadPath .'/'. $filename;
        $continue = file_put_contents($file, $contents);
        if ($continue) {
            $data                     = new File();
            $data->object_id          = $objectId;
            $data->object_type        = $objectType;
            $data->original_file_name = $options['isOriginalNameRequired'] ? $originalFileName.".jpg" : NULL;
            $data->file_name          = $filename;
            $data->uploaded_by        = !empty($options['uploaded_by']) ? $options['uploaded_by'] : NULL;
            if ($data->save()) {
                $ids = $data->id;
            }
        }
        return $ids;
    }


	/**
	 * [getFiles description]
	 * @param  [string] $objectType [description]
	 * @param  [int] $objectId   [description]
	 * @param  [array] $options   [description]
	 * @return [array]             [description]
	 */
	public function getFiles($objectType = null, $objectId = null,	$options = [])
	{
		$options = array_merge(['ids' => [], 'isExcept' => false, 'limit' => null], $options);
		if (empty($objectType) && empty($objectId) && empty($options['ids'])) {
			return [];
		}
		$query = $this->whereNotNull('file_name')->select();
		if (!empty($objectType) && !empty($objectId)) {
			$objectId = !is_array($objectId) ? [$objectId] : $objectId;
			$query->where('object_type', $objectType)->whereIn('object_id', $objectId);
		}
		if (!empty($options['ids'])) {
			if ($options['isExcept']) {
				$query->whereNotIn('id', $options['ids']);
			} else {
				$query->whereIn('id', $options['ids']);
			}
		}
		if (!empty($options['limit'])) {
			$query->limit($options['limit']);
		}

		return $query->get();
	}

	public function allFiles()
	{
		return  File::select(['id', 'file_name'])->orderBy('id', 'desc')->get();
	}

	public static function getAllFiles($options = [])
	{
		$sortValue = request()->sort_value ?? null;
		$name = request()->search ?? null;
		$sortName = request()->sort_name ?? null;
		$result = File::query();
		if ($sortValue) {
			if ($sortValue == 'newest') {
				$result = $result->orderBy('id', 'desc');
			} else if ($sortValue == 'oldest') {
				$result = $result->orderBy('id', 'asc');
			} else if ($sortValue == 'smallest') {
			 $result = $result->orderBy('params->size', 'asc');
			} else if ($sortValue == 'largest') {
			 $result = $result->orderBy('params->size', 'desc');
			}
		} else {
			$result = $result->orderBy('id', 'desc');
		}
		if ($name) {
			$result = $result->where('original_file_name', $name);
		}
		if ($sortName) {
			$result = $result->where('original_file_name', 'like', '%' . $sortName . '%');
		}

		return $result->paginate(preference('row_per_page', 10));

	}

	/**
	 * [getFiles description]
	 * @param  [string] $objectType [description]
	 * @param  [int] $objectId   [description]
	 * @param  [array] $options  [description]
	 * @return [array]           [description]
	 */
	public function copyFiles($source, $destination, $fromObjectType = null, $fromObjectId = null, $toObjectType = null, $toObjectId = null, $options = [])
	{
		$fileList = ["status" => 0, "fileStatus" => __(':x does not exist.', ['x' => __('Attachment')]), "files" => []];
		if (empty($source) || empty($destination) || empty($fromObjectType) || empty($fromObjectId)) {
			return $fileList;
		}
		$options = array_merge(['ids' => [], 'isTemporary' => false, 'isOriginalNameRequired' => false], $options);
		$files = $this->getFiles($fromObjectType, $fromObjectId, $options);
		if (!empty($files)) {
			$fileList['status'] = 1;
			$fileList['fileStatus'] = __("Attachment found");
			foreach ($files as $key => $file) {
				$originalName = implode('_', array_slice(explode("_", $file->file_name), 2));
				$copiedName = md5(time()) . '_' . Auth::user()->id . '_' . $originalName;
				if ($options['isTemporary']) {
					if (copy ( $source . "/" . $file->file_name , $this->_tempDirectory . "/" . $copiedName)) {
						$fileList["files"][] = $copiedName;
					}
				} else {
					if (file_exists($source . "/" . $file->file_name) && copy ( $source ."/". $file->file_name , $destination . "/" . $copiedName)) {
						$data               	  = new File();
						$data->object_id	  	  = $toObjectId;
						$data->object_type 		  = $toObjectType;
						$data->file_name 		  = $copiedName;
						$data->original_file_name = $options['isOriginalNameRequired'] ? $originalName : null;
						if ($data->save()) {
							$fileList["files"][] = $copiedName;
						}
					}
				}
			}
		}
		return json_encode($fileList);
	}

	/**
	 * [deleteFiles description]
	 * @param  [string] $objectType [description]
	 * @param  [int] $objectId   [description]
	 * @param  [int]  $id           [description]
	 * @return [json]                [description]
	 */
	public function deleteFiles($objectType = null, $objectId = null, $options = [], $path = null)
	{
		$result['status'] = 0;
		$result['fileStatus'] = __(':x does not exist.', ['x' => __('Attachment')]);
		$files = $this->getFiles($objectType, $objectId, $options);
		if (!empty($files)) {
			foreach ($files as $key => $value) {
				if ($this->where('id', $value->id)->delete()) {
					$result = $this->unlinkFile($path . "/" . $value->file_name);
                    if (isset($options['thumbnail']) && isset($options['thumbnailPath']) && $options['thumbnail'] == true) {
                        $this->unlinkFile($options['thumbnailPath'] . "/" . $value->file_name);
                    }
					$result['status'] = 1;
				}
			}
		}
		return json_encode($result);
	}

	/**
	 * [unlinkFile description]
	 * @param  [string] $file [description]
	 * @return [array]       [description]
	 */
	public function unlinkFile($file)
	{
		$result['status'] = 0;
		$result['fileStatus'] = __(':x does not exist.', ['x' => __('Attachment')]);
		if (file_exists($file)) {
			@unlink($file);
			$result['status'] = 1;
			$result['fileStatus'] = __("Attachment deleted");
		}
		return $result;
	}

	public function resizeImageThumbnail($uploadedFilePath, $uploadedFileName, $thumbnailPath, $oldFileName = null)
	{
		$height = isset($_ENV['imgThumbnailHeight']) && !empty($_ENV['imgThumbnailHeight']) ? $_ENV['imgThumbnailHeight'] : 50;
		$width = isset($_ENV['imgThumbnailWidth']) && !empty($_ENV['imgThumbnailWidth']) ? $_ENV['imgThumbnailWidth'] : 50;
		if (isset($oldFileName) && !empty($oldFileName)) {
			if (file_exists($thumbnailPath . '/' . $oldFileName)) {
				unlink(base_path() . '/' . $thumbnailPath . '/' . $oldFileName);
			}
		}

        $nameWithSlash = strstr($uploadedFileName, '/');
        $replacedFilename = str_replace('/', '', $nameWithSlash);
		try {
			$img = Image::make($uploadedFilePath.'/'. $replacedFilename);
		} catch (Intervention\Image\Exception\NotReadableException $e) {
			$img = Image::make(public_path() . '/dist/img/default-image.png');
		}
		$extension = substr($uploadedFileName, strrpos($uploadedFileName, '.') + 1);
		$ratio = $this->sizeRatio();
		foreach($ratio as $key => $value) {
			$img->resize($key, $value, function ($constraint) {
				$constraint->aspectRatio();
			})->save($thumbnailPath . '/' . $replacedFilename .'_'. $key . '×'. $value. '.'. $extension);
		}

	}

	public function sizeRatio()
	{
		return	$size = [
				50 => 50,
				60 => 60,
				70 => 70
			];
	}
}
