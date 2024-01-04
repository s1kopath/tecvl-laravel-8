<?php

/**
 * @package Page Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 26-12-2021
 */

namespace Modules\CMS\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;

class Page extends Model
{
    use ModelTrait, hasFiles;

    protected $fillable = ['name', 'slug', 'description', 'status', 'meta_title', 'default', 'type', 'meta_description', 'default'];

    /**
     * Relation wirh File Model
     * @var boolean
     */
    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'pages');
    }
    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
        $page = parent::create($data);
        if ($page->default) {
            $this->updateDefault($page->id);
        }
        $this->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);

        return $page->id;
    }
    /**
     * Update
     * @param  array  $data
     * @param  string $id
     * @return boolean
     */
    public function updatePage($data = [], $id = null)
    {
        try {
            $update = $this->whereId($id)->update($data);
            return $update;
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        $page = Page::where('id', $id)->first();
        if (empty($page)) {
            $data = ['status' => 'fail', 'message' =>  __('page does not found.')];
        } else {
            $page->delete();
            $data = ['status' => 'success', 'message' =>  __('Page has been successfully deleted.')];
        }
        return $data;
    }
    /**
     * Pages
     * @return array
     */
    public static function getAllPages()
    {
        return Page::where('status', 'Active')->get();
    }

    /**
     * Pages except home page
     * @return collection
     */
    public function pages()
    {
        return Page::where('type', '!=', 'home')->get();
    }

    /**
     * Update default status
     * @param integer id
     */
    public function updateDefault($id)
    {
        return parent::where('id', '!=', $id)->where('default', 1)->update(['default' => 0]);
    }
}
