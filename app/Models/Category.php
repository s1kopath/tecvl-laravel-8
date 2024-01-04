<?php
/**
 * @package Category
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 28-07-2021
 */
namespace App\Models;

use App\Rules\CheckValidFile;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use App\Models\Model;
use Cache;
use Validator;
use URL;

class Category extends Model
{
    use ModelTrait, hasFiles;

    /**
     * Default number of post to fetch from database
     */
    private static $limit = 10;

    /**
     * Foreign key with Category model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function getUrl()
    {
        return URL::to('/');
    }
    /**
     * Relation with Category model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availableChildrenCategory()
    {
        return $this->categories()->where('status', 'Active');
    }
    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function availableMainCategory() {
        return $this->childrenCategories()->where('status', 'Active');
    }
    /**
     * Relation with Category model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id')->with('categories');
    }
    /**
     * Return all parents item
     * @return array
     */
    public static function parents()
    {
       return Category::whereNull('parent_id')
        ->with('childrenCategories')
        ->where('status', 'Active')
        ->get();
    }
    /**
     * Relation with CategoryAttribute model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryAttribute()
    {
        return $this->hasMany('App\Models\CategoryAttribute', 'category_id', 'id');
    }

    /**
     * Relation with ItemCategory model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemCategory()
    {
        return $this->hasMany('App\Models\ItemCategory', 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'CATEGORY');
    }

    /**
     * Foreign key with Category model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_categories');
    }

    /**
     * Foreign key with item with order model
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function itemOrder() {
        return $this->hasManyThrough(OrderDetail::class, ItemCategory::class, 'category_id', 'item_id', 'id', 'item_id');
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:100',
            'parent_id' => ['nullable', 'exists:categories,id'],
            'slug' => 'required|max:120|unique:categories,slug',
            'status' => 'required|in:Active,Inactive',
            'is_searchable' => 'required|in:1,0',
            'is_featured' => 'required|in:1,0',
            'sell_commissions' =>'nullable|numeric',
            'image'  => [new CheckValidFile(getFileExtensions(3))],
        ]);

        return $validator;
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:100',
            'parent_id' => ['nullable', 'exists:categories,id'],
            'slug' => [
                'required',
                'unique:categories,slug,' . $id
            ],
            'status' => 'required|in:Active,Inactive',
            'is_searchable' => 'required|in:1,0',
            'is_featured' => 'required|in:1,0',
            'sell_commissions' =>'nullable|numeric',
            'image'  => [new CheckValidFile(getFileExtensions(3))],
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        $this->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);
        if (!empty($id)) {
            self::forgetCache();
            return $id;
        }
        return false;
    }

    /**
     * Update Category
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateCategory($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
            $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);
            self::forgetCache();
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            if ($record->item_counts > 0) {
                $data['message'] = __("Can not be deleted. This category has records!");
            } else {
                $record->delete();
                try {
                    #delete file region
                    $record->deleteFiles();
                    #end region
                    $data['status'] = 'success';
                    $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Category')]);
                } catch (Exception $e) {
                    $data['message'] = $e->getMessage();
                }
            }
        }

        return $data;
    }

    /**
     * update node position
     *
     * @param array $data
     * @return bool
     */
    public function nodeUpdate($data = [])
    {
        $position = $data['position'] + 1;
        $oldPosition = $data['old_position'] + 1;
        $parentId = $data['parent_id'] != '#' ? $data['parent_id'] : null;
        $oldParentId = $data['old_parent_id'] != '#' ? $data['old_parent_id'] : null;
        $category = parent::find($data['id']);
        if (!empty($category)) {
            $category->parent_id = $parentId;
            $category->order_by = $position;
            $category->save();
            Cache::forget(config('cache.prefix') . '-category');
            if ($this->reOrder($data['id'], $parentId, $oldParentId, $position, $oldPosition)) {
                Cache::forget(config('cache.prefix') . '-category');
                return true;
            }
        }
        return false;
    }

    /**
     * re-order node position
     *
     * @param null $id
     * @param null $parentId
     * @param null $oldParentId
     * @param null $position
     * @param null $oldPosition
     * @return bool
     */
    public function reOrder($id = null, $parentId = null, $oldParentId = null, $position = null, $oldPosition = null)
    {
        $flagReorder = 0;
        if ($parentId != null) {
            $new = 1;
            $parentReorder = parent::where('parent_id', $parentId)->orderBy('order_by', 'ASC')->get();
            foreach ($parentReorder as $key => $order) {
                if ($order->id != $id) {
                    parent::where('id', $order->id)->update(['order_by' => $new >= $position ? ++$new : $new++]);
                }
            }
            $flagReorder = 1;
        }
        if ($parentId != $oldParentId || $parentId == null) {
            if ($oldParentId == null || $parentId == null) {
                $root = 1;
                $RootParent = parent::whereNull('parent_id')->orderBy('order_by', 'ASC')->get();
                foreach ($RootParent as $rootOrder) {
                    if ($rootOrder->id != $id) {
                        if ($flagReorder == 1) {
                            parent::where('id', $rootOrder->id)->update(['order_by' => $root++]);
                        } else {
                            parent::where('id', $rootOrder->id)->update(['order_by' => $root >= $position ? ++$root : $root++]);
                        }
                    }
                }
            } if ($oldParentId != null) {
                $rootFromChild = 1;
                $RootParentFromChild = parent::where('parent_id', $oldParentId)->orderBy('order_by', 'ASC')->get();
                foreach ($RootParentFromChild as $FromChild) {
                    parent::where('id', $FromChild->id)->update(['order_by' => $rootFromChild++]);
                }
            }
        }
        return true;
    }

    /**
     * Best category of the month
     * @param int $limit
     * @return collection
     */
    public static function bestCategory($limit = 10) {
        return parent::select('id', 'name', 'slug')->whereHas('itemOrder', function($q) {
                $q->where('created_at', '>=', now()->subMonth());
            })->withCount('itemOrder')
            ->active()
            ->orderByDesc('item_order_count')
            ->limit(self::getLimit($limit))->get();
    }


    /**
     * Random category
     *
     * @param int $limit
     *
     * @return collection
     */
    public static function randomCategories($limit = 10) {
        return parent::inRandomOrder()->active()->limit(self::getLimit($limit))->get();
    }

    /**
     * Popular category
     *
     * @param int $limit
     *
     * @return collection
     */
    public static function popularCategories($limit = 10) {
        return parent::inRandomOrder()->active()->limit(self::getLimit($limit))->get();
    }

    /**
     * Top category
     *
     * @param int $limit
     *
     * @return collection
     */
    public static function topCategories($limit = 10) {
        return parent::inRandomOrder()->active()->limit(self::getLimit($limit))->get();
    }

    /**
     * Selected category
     *
     * @param array $categories Array of category ids
     *
     * @return collection
     */
    public static function selectedCategories($categories = []) {
        return parent::whereIn('id', $categories)->get();
    }


    /**
     * Active categories
     *
     * @param array $fields
     *
     * @return collection
     */
    public static function activeCategories($fields = ['id', 'name']) {
        return parent::where('status', 'Active')->select($fields)->get();
    }

    /**
     * Return the maximum limit
     * @param int|null $limit
     * @return int
     */
    private static function getLimit($limit = null)
    {
        return $limit && $limit > 0 ? $limit : self::$limit;
    }
}
