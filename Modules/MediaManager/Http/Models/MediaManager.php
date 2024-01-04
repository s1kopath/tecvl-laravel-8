<?php
/**
 * @package Media Manager Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 05-02-2022
 */

namespace Modules\MediaManager\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;

class MediaManager extends Model
{
    protected $table = 'object_files';
    use ModelTrait, hasFiles;

    public $timestamps = false;

    public function store($data = []) {
        $this->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'isMediaManager' => true, 'thumbnail' => true]);
        return true;
    }


}
