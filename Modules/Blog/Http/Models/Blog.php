<?php

/**
 * @package Blog Model
 * @author techvillage <support@techvill.org>
 * @contributor Kabir Ahmed <[kabir.techvill@gmail.com]>
 * @created 30-12-2021
 */

namespace Modules\Blog\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use Carbon\Carbon;
use Modules\MediaManager\Http\Models\ObjectFile;
use DB;

class Blog extends Model
{
    use ModelTrait, hasFiles;

    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'blogs');
    }
    public function objectImage()
    {
        return $this->hasOne('Modules\MediaManager\Http\Models\ObjectFile', 'object_id')->where('object_type', 'blogs');
    }
    /**
     * Relation with User Model
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    /**
     * Relation with blogCategory Model
     */
    public function blogCategory()
    {
        return $this->belongsTo('Modules\Blog\Http\Models\BlogCategory', 'category_id');
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
            if (request()->has('file_id')) {
                foreach (request()->file_id as $data) {
                    $fileIds[] = $data;
                }
            }
            ObjectFile::storeInObjectFiles($this->objectType(), $this->objectId(), $fileIds);
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
    public function updateBlog($data = [], $id = null)
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

    public function getAllBlogDT($from = null, $to = null, $categoryId = null, $authorId = null)
    {
        $result = Blog::with(['user', 'blogCategory'])->select('blogs.*');
        if (!empty($from)) {
            $result->whereDate('created_at', '>=', DbDateFormat($from));
        }
        if (!empty($to)) {
            $result->whereDate('created_at', '<=', DbDateFormat($to));
        }
        if (!empty($categoryId)) {
            $result->where('category_id', $categoryId);
        }

        if (!empty($authorId)) {
            $result->where('user_id', $authorId);
        }

        return $result;
    }

    /**
     * Get the latest blogs
     * @param int $limit
     *
     * @return collection
     */
    public function latestBlogs($limit = 10)
    {
        return parent::latest()->limit($limit)->with('user')->get();
    }


    /**
     * Scope a query to only archives filters
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeArchiveFilter($query, $filters)
    {
        if ($filters && $filters['year']) {
            $query->whereYear('created_at', $filters['year']);
        }
    }

    /**
     * Scope a query to only include active posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActivePost($query)
    {
        $query->where('status', 'active');
    }

    /**
     * Get archives
     *
     * @return collection
     */
    public static function archives()
    {
        $archives = Blog::SelectRaw('YEAR(created_at) as year, COUNT(*) as post_count')
            ->where('status', 'Active')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        return $archives;
    }
}
