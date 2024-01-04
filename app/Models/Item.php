<?php
/**
 * @package Item
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 25-07-2021
 */
namespace App\Models;

use App\Rules\{
    CheckAttribute,
    CheckOptionData,
    CheckPrice
};
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use App\Models\Model;
use Modules\MediaManager\Http\Models\ObjectFile;
use Validator;
use Cart;
class Item extends Model
{
    use ModelTrait, hasFiles;
    protected $fillable = [
        'item_code', 'name', 'description', 'summary', 'video_url', 'review_count', 'review_average',
        'available_from', 'available_to', 'vendor_id', 'brand_id', 'status', 'is_virtual', 'is_shippable', 'is_shareable',
        'favourite_count', 'wish_count', 'price', 'discount_amount', 'discount_type', 'discounted_price', 'discount_from', 'discount_to',
         'maximum_discount_amount', 'minimum_order_for_discount', 'sku', 'is_inventory_enabled', 'item_quantity', 'stock_availability',
        'shop_id'
        ];

    /**
     * Default number of post to fetch from database
     */
    private static $limit = 10;

    /**
     * Relation with FlashSale model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flashSale()
    {
        return $this->hasMany('App\Models\FlashSale', 'item_id', 'id');
    }

    /**
     * Relation with ItemCategory model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemCategory()
    {
        return $this->hasOne('App\Models\ItemCategory', 'item_id', 'id');
    }

    /**
     * Relation with Seo model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seo()
    {
        return $this->hasOne('App\Models\Seo', 'item_id', 'id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'item_categories');
    }

    /**
     * Relation with ItemOption model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemOption()
    {
        return $this->hasMany('App\Models\ItemOption', 'item_id', 'id')->orderBy("order_by", "ASC");
    }

    /**
     * Relation with ItemAttribute model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemAttributes()
    {
        return $this->hasMany('App\Models\ItemAttribute', 'item_id', 'id');
    }

    /**
     * Relation with ItemTag model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemTag()
    {
        return $this->hasMany('App\Models\ItemTag', 'item_id', 'id');
    }

    /**
     * Relation with Review model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review()
    {
        return $this->hasMany('App\Models\Review', 'item_id', 'id');
    }

    /**
     * Relation with Favorite model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite', 'item_id', 'id');
    }

    /**
     * Relation with Wishlist model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist', 'item_id', 'id');
    }

    /**
     * Relation with StockManagementDetail model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockManagementDetail()
    {
        return $this->hasMany('App\Models\StockManagementDetail', 'item_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasMany('App\Models\File', 'object_id')->where('object_type', 'ITEM');
    }

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Foreign key with Brand model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    /**
     * Foreign key with Brand model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'item_id');
    }

    /**
     * Relation with itemDetail
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemDetail()
    {
        return $this->hasOne('App\Models\ItemDetail', 'item_id', 'id');
    }

    /**
     * Foreign key with Shop model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo('Modules\Shop\Http\Models\Shop', 'shop_id');
    }

    public function objectImage()
    {
        return $this->hasMany('Modules\MediaManager\Http\Models\ObjectFile', 'object_id')->where('object_type', 'items');
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected function storeValidation($data = [])
    {
        $rules = [
            'name' => 'required|min:3|max:191',
            'category_id' => 'required|exists:categories,id',
            'vendor_id' => 'required|exists:vendors,id',
            'brands_id' => 'nullable|exists:brands,id',
            'attribute_data' => [new CheckAttribute($data['category_id'] ?? null)],
            'option_data' => [new CheckOptionData(isset($data['is_track_inventory']) && $data['is_track_inventory'] == 'on' ? 1 : 0)],
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date',
            'price' => ['required', new CheckPrice('single')],
            'maximum_discount_amount' => ['nullable', new CheckPrice('single')],
            'minimum_order_for_discount' => ['nullable', new CheckPrice('single')],
            'warranty_type' => 'required|in:No Warranty,Brand Warranty,Seller Warranty',
            'tax_id' => 'nullable|exists:taxes,id',
            'status' => 'required|in:Active,Inactive',
            'sku' => 'nullable|max:45',
            'summary' => 'nullable|max:191',
        ];
        if (isActive('Shipping')) {
            $rules['shipping_id'] = ['required', 'exists:shippings,id'];
        }

        if (isset($data['warranty_type']) && $data['warranty_type'] != "No Warranty") {
            $rules['warranty_period'] = ['required'];
        }

        if (isset($data['is_discount']) && $data['is_discount'] == "on") {
            $rules['discount_price'] = ['required', new CheckPrice('single')];
            $rules['discount_amount'] = ['required', new CheckPrice('single')];
            $rules['discount_type'] = ['required', 'in:Flat,Percent'];
            $rules['discount_from'] = ['required', 'date'];
            $rules['discount_to'] = ['required', 'date'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id = null)
    {
        $rules = [
            'name' => 'required|min:3|max:191',
            'category_id' => 'required|exists:categories,id',
            'vendor_id' => 'required|exists:vendors,id',
            'brands_id' => 'nullable|exists:brands,id',
            'attribute_data' => [new CheckAttribute($data['category_id'] ?? null)],
            'option_data' => [new CheckOptionData(isset($data['is_track_inventory']) && $data['is_track_inventory'] == 'on' ? 1 : 0, $id)],
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date',
            'price' => ['required', new CheckPrice('single')],
            'maximum_discount_amount' => ['nullable', new CheckPrice('single')],
            'minimum_order_for_discount' => ['nullable', new CheckPrice('single')],
            'warranty_type' => 'required|in:No Warranty,Brand Warranty,Seller Warranty',
            'tax_id' => 'nullable|exists:taxes,id',
            'status' => 'required|in:Active,Inactive',
            'sku' => 'nullable|max:45',
            'summary' => 'nullable|max:191',
        ];
        if (isActive('Shipping')) {
            $rules['shipping_id'] = ['required', 'exists:shippings,id'];
        }

        if (isset($data['warranty_type']) && $data['warranty_type'] != "No Warranty") {
            $rules['warranty_period'] = ['required'];
        }

        if (isset($data['is_discount']) && $data['is_discount'] == "on") {
            $rules['discount_price'] = ['required', new CheckPrice('single')];
            $rules['discount_amount'] = ['required', new CheckPrice('single')];
            $rules['discount_type'] = ['required', 'in:Flat,Percent'];
            $rules['discount_from'] = ['required', 'date'];
            $rules['discount_to'] = ['required', 'date'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Import Validation
     * @param array $data
     * @return mixed
     */
    protected static function importValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|unique:items,name',
            'category_id' => 'required|exists:categories,id',
            'shop_id' => 'required|exists:shops,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'required|min:10',
            'summary' => 'required|min:10',
            'item_quantity' => 'required|numeric',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date',
            'discount_from' => 'nullable|date',
            'discount_to' => 'nullable|date',
            'price' => ['required', new CheckPrice('single')],
            'discount_price' => ['nullable', new CheckPrice('single')],
            'discount_amount' => ['nullable', new CheckPrice('single')],
            'discount_type' => 'nullable|in:Flat,Percent',
            'maximum_discount_amount' => ['nullable', new CheckPrice('single')],
            'minimum_order_for_discount' => ['nullable', new CheckPrice('single')],
            'status' => 'required|in:Active,Inactive',
            'video_url' => ['nullable', 'regex:/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/'],
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
        $lastItem = parent::create($data);
        if (!empty($lastItem)) {
            if(request()->has('file_id')) {
                foreach(request()->file_id as $data) {
                    $fileIds[] = $data;
                }
            }
            if (isset($fileIds)) {
                ObjectFile::storeInObjectFiles($this->objectType(), $this->objectId(), $fileIds);
            }
            return $lastItem->id;
        }
        return false;
    }

    /**
     * Update Item
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateItem($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
            $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
            self::forgetCache(['item_attributes', 'item_options', 'item_categories', 'loadItem.' . $id]);
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
            try {
                $record->delete();
                $record->deleteFileObjects(['thumbnail' => true]);
                self::forgetCache(['item_attributes', 'item_options', 'item_categories', 'loadItem.' . $id]);
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Item')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    /**
     * item search
     *
     * @param $request
     */
    public function search($key, $itemId, $type, $from = "web", $action = null)
    {
        $data              = array();
        $data['status_no'] = 0;
        $data['message']   = __('No Item Found');
        $data['item']    = array();
        $return_arr        = [];
        $item_ids = [];
        if ($type == 'relate') {
            $item_ids = ItemRelate::getAll()->where('item_id',$itemId)->pluck('related_item_id')->toArray();
        }
        if ($type == 'cross') {
            $item_ids = ItemCrossSale::getAll()->where('item_id',$itemId)->pluck('cross_sale_item_id')->toArray();
        }
        if ($type == 'up') {
            $item_ids = ItemUpsale::getAll()->where('item_id',$itemId)->pluck('upsale_item_id')->toArray();
        }
        if (count($item_ids) > 0) {
            array_push($item_ids, $itemId);
        } else {
            $item_ids = [$itemId];
        }
        if ($action == 'vendor') {
            $items = Item::where('name', 'LIKE', '%' . $key . '%')->where('vendor_id', session()->get('vendorId'))->whereNotIn('id', $item_ids)->take(10)->get();
        } elseif ($action == 'vendorApi'){
            $items = Item::where('name', 'LIKE', '%' . $key . '%')->where('vendor_id', auth()->user()->vendorUser->vendor_id ?? null)->whereNotIn('id', $item_ids)->take(10)->get();
        } else {
            $items = Item::where('name', 'LIKE', '%' . $key . '%')->whereNotIn('id', $item_ids)->take(10)->get();
        }
        if (!$items->isEmpty()) {
            $data['status_no'] = 1;
            $data['message']   = __('Item Found');
            $i                 = 0;
            foreach ($items as $key => $value) {
                $return_arr[$i]['id']          = $value->id;
                $return_arr[$i]['item_code']   = $value->item_code;
                $return_arr[$i]['sku']         = $value->sku;
                $return_arr[$i]['name']        = strlen($value->name) < 50 ? $value->name : substr($value->name, 0, 50) . "...";
                $i++;
            }
            $data['item'] = $return_arr;
        }
        if ($from == "api") {
            return $data;
        }
        echo json_encode($data);
        exit;
    }

    /**
     * Find discount percent
     * @param int itemId
     * @return string
     */
    public function discountPercent($itemId)
    {
        $item = parent::select('id', 'price', 'discount_amount', 'discount_from', 'discount_to')->find($itemId);
        if (!is_null($item->price) && $item->price > 0 && $item->discount_to >= now() && $item->discount_from <= now()) {
            return floor(($item->discount_amount / $item->price) * 100);
        }
        return 0;
    }

    /**
     * Find discount
     * @param int itemId
     * @return string
     */
    public function isDiscountable()
    {
        if (isset($this->itemDetail->is_discount) && $this->itemDetail->is_discount == 1) {
            if (!empty($this->discount_amount) && ($this->discount_to >= now()->toDateString() || $this->discount_to == null) && ($this->discount_from <= now()->toDateString() || $this->discount_from == null)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Find item wishlist
     * @param int itemId
     * @return bool
     */
    public function isWishlist($itemId, $userId)
    {
        return Wishlist::where('item_id', $itemId)->where('user_id', $userId)->count() > 0 ? 1 : 0;
    }

    /**
     * Find item average rating
     * @param int itemId
     * @return double
     */
    public function rating($itemId)
    {
        return round(Review::where('item_id', $itemId)->where('status', 'Active')->where('is_public', 1)->avg('rating'), 1);
    }

    /**
     * Find item review count
     * @param int itemId
     * @return int
     */
    public function reviewCount($itemId)
    {
        return Review::where('item_id', $itemId)->where('status', 'Active')->where('is_public', 1)->count();
    }
     /* filter page data
     *
     * @return array
     */
    protected function itemFilter($searchKeyword = null, $categoryId = null, $min = null, $max = null, $requestedBrands = [], $labels = [], $requestedRating = null, $sortBy = null, $start = 0)
    {
        $brands = []; $itemOptions = []; $ratings = []; $optionArray = []; $optionArrayDup = []; $optionName = []; $relatedCategory = []; $catFlag = false; $otherItemData = [];
        $category = $categoryId;
        $status = 0;
        $brandEntry = false;
        $ratingEntry = false;
        $optionEntry = false;
        $items = parent::where('status', 'Active');
        if (!empty($searchKeyword)) {
            $status = 1;
            $tags = Tag::where('name', 'LIKE', '%' . $searchKeyword .'%')->pluck('id')->toArray();
            if (is_array($tags) && count($tags) > 0) {
                $items->whereHas("itemTag", function ($q) use ($tags) {
                    $q->whereIn('tag_id', $tags);
                })->with('itemTag');
            } else {
                $items->where(function ($query) use ($searchKeyword) {
                    $query->WhereLike('name', $searchKeyword)
                        ->OrWhereLike('sku', $searchKeyword)
                        ->orwhereHas("brand", function ($q) use ($searchKeyword) {
                            $q->WhereLike('name', $searchKeyword);
                        })->with('brand');
                });
            }
            $preItems = $items;
            $brands = $preItems->get()->pluck('brand_id')->toArray();
            $itemOptions = $preItems->get()->pluck('itemOption');
            $relatedCategory = $preItems->get()->pluck('itemCategory.category_id')->toArray();

        }
        if (!empty($category)) {
            $status = 1;
            $parentCat = Category::getAll()->where('id', $category)->first();
            if (!empty($parentCat)) {
                $items->whereHas("itemCategory", function ($q) use ($category) {
                    $q->where('category_id', $category);
                })->with('itemCategory');
            }
        }
        if (!empty($min)) {
            $status = 1;
            $items->where('price', '>=', $min);
        }
        if (!empty($max)) {
            $status = 1;
            $items->where('price', '<=', $max);
        }
        if (!empty($requestedBrands)) {
            $status = 1;
            $items->whereIn('brand_id', $requestedBrands);
            $relatedCategory = $items->get()->pluck('itemCategory.category_id')->toArray();
            $itemOptions = $items->get()->pluck('itemOption');
        }
        if (!empty($requestedRating)) {
            $incRating = $requestedRating + 1;
            $items->where('review_average', '>=', $requestedRating)->where('review_average', '<', $incRating);
        }
        if (!empty($labels)) {
            $status = 1;
            foreach ($labels as $lb) {
            $items->whereHas("itemOption", function ($q) use ($lb) {
                    $q->whereJsonContains('payloads->label', $lb);
            })->with('itemOption');
            }
        }
        $column = "price";
        $order = "ASC";
        if ($sortBy == "Price High to Low") {
            $order = "DESC";
        } elseif ($sortBy == "Price Low to High") {
            $order = "ASC";
        } else {
            $column = "review_average";
            $order = "DESC";
        }
        $data['status'] = $status;
        if ($data['status'] == 1) {
            $data['items'] = $items->offset($start)->limit(totalItemPerPage())->orderBy($column, $order)->get();
        } else {
            $data['message'] = __('No Item Found');
            return $data;
        }
        $data['status'] = count($data['items']) == 0 ? 0 : 1;
        $totalItem = $items->count();
        $totalPage = $totalItem/totalItemPerPage();
        $totalPageFloor = floor($totalPage);
        if ($totalPageFloor < $totalPage) {
            $totalPageFloor += 1;
        }
        $data['totalPageFloor'] = $totalPageFloor;
        $data['totalItem'] = $totalItem;
        foreach ($data['items'] as $item) {
            if(count($relatedCategory) == 0 || $catFlag == true) {
                $catFlag = true;
                $itemCat = ItemCategory::getAll()->where('item_id', $item->id)->first();
                $relatedCategory[] = optional($itemCat)->category_id;
                optional($item->itemCategory)->category_id != null ? $relatedCategory[] = optional($item->itemCategory)->category_id : '';
            }

            $price =  $item->isDiscountable() ? $item->discounted_price : $item->price;
            $discountAmount = $item->isDiscountable() ? $item->price - $item->discounted_price : $item->price;
            $availability = 0;
            if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from)) {
                if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                    $availability = 1;
                }
            }
            $otherItemData[$item->id] = [
                'image' => $item->fileUrl(),
                'price' => $price,
                'discountAmount' => $discountAmount,
                'wishList' => $this->isWishlist($item->id, optional(auth()->user())->id),
                'hasOption' => hasOption($item->id),
                'is_available' => $availability
            ];
            if (count($brands) == 0 || $brandEntry == true) {
                $brandEntry = true;
                isset($item->brand_id) && !empty($item->brand_id) ? $brands[] = $item->brand_id : '';
            }
            if (count($ratings) == 0 || $ratingEntry == true) {
                $ratingEntry = true;
                isset($item->review_average) && !empty($item->review_average) ? $ratings[] = $item->review_average : $ratings[] = 0;
            }
            if (count($itemOptions) == 0 || $optionEntry == true) {
                $optionEntry = true;
                isset($item->itemOption) && !empty($item->itemOption) ? $itemOptions[] = $item->itemOption : '';
            }
        }
        foreach ($itemOptions as $option) {
            if (!empty($option) && count($option) > 0) {
                foreach ($option as $op) {
                    if (!in_array($op->name, $optionName)) {
                        if(isset(json_decode($op->payloads)->label)) {
                            $optionName[] = $op->name;
                            $optionArray[] = [
                                'option' => $op->name,
                                'label' => json_decode($op->payloads)->label
                            ];
                        }
                    } else {
                        if(isset(json_decode($op->payloads)->label)) {
                            $optionArrayDup[] = [
                                "option" => $op->name,
                                "label" => json_decode($op->payloads)->label
                            ];
                        }
                    }

                }
            }
        }
        if (count($optionArray) > 0 && count($optionArrayDup) > 0) {
            foreach ($optionArray as $key => $arr) {
                foreach ($optionArrayDup as $arrDup) {
                    if ($arrDup['option'] == $arr['option']) {
                        foreach ($arrDup['label'] as $lb) {
                            array_push($optionArray[$key]['label'],$lb);
                        }
                        $unique = array_unique($optionArray[$key]['label']);
                        $optionArray[$key]['label'] = $unique;
                    }
                }
            }
        }
        $brands = array_unique($brands);
        $data['ratings'] = array_unique($ratings);
        $data['itemOptions'] = $optionArray;
        $relatedCategory = array_unique($relatedCategory);
        $allCategories = Category::getAll()->where('status', "Active");
        $allBrands = Brand::getAll()->where('status', "Active");
        $brandIdNames = [];
        foreach ($allBrands as $brand) {
            if (in_array($brand->id, $brands)) {
                $brandIdNames[] = [
                    "id" => $brand->id,
                    "name" => $brand->name,
                    "image" => $brand->fileUrl()
                ];
            }
        }
        $categories = [];
        foreach ($allCategories as $cat) {
            if (in_array($cat->id, $relatedCategory)) {
                $categories[] = [
                    "id" => $cat->id,
                    "name" => $cat->name,
                    "image" => $cat->fileUrl()
                ];
            }
        }
        $data['categories'] = $categories;
        $data['brandIdNames'] = $brandIdNames;
        $data['selectedCategory'] = $categoryId;
        $data['otherItemData'] = $otherItemData;

        return $data;
    }

    /**
     * Import
     * @param  array  $data
     * @return int|null
     */
    public function import($data = [], $filesUrl)
    {
        $id = parent::insertGetId($data);
        if (!empty($id)) {
            $filesUrl = explode(',', $filesUrl);
            foreach ($filesUrl as $key => $url) {
                $this->uploadFilesFromUrl(trim($url), ['isUploaded' => true, 'isOriginalNameRequired' => true]);
            }
            return $id;
        }
        return false;
    }

    /**
     * Best seller item
     * @param  int limit
     * @return collection
     */
    public static function bestSeller($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                ->whereNotNull('purchase_count')
                ->orderBy('purchase_count', 'DESC')
                ->take(self::getLimit($limit))
                ->get();
    }

    /**
     * Popular items
     * @param  int limit
     * @return collection
     */
    public static function popularItems($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                ->whereNotNull('review_average')
                ->take(self::getLimit($limit))
                ->orderByDesc('review_average')
                ->get();
    }

    /**
     * Feature items
     * @param  int limit
     * @return collection
     */
    public static function featureItems($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                    ->where('status', 'Active')
                    ->inRandomOrder()->take(self::getLimit($limit))->get();
    }

    /**
     * New arrival items
     * @param  int limit
     * @return collection
     */
    public static function newArrivals($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discount_amount', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                    ->where('status', 'Active')->orderBy('id', 'desc')->take(self::getLimit($limit))->get();
    }

    /**
     * Best deals of the week
     * @param  int limit
     * @return collection
     */
    public static function bestDeals($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discount_amount', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                    ->where('status', 'Active')
                    ->whereDate('discount_to', '<=', now()->endOfWeek())
                    ->whereDate('discount_to', '>=', now())
                    ->orderBy('discount_to')
                    ->orderByDesc('discount_amount')
                    ->limit(self::getLimit($limit))->get();
    }

    /**
     * Flash sale item
     * @param  int limit
     * @return collection
     */
    static function flashSales($limit = null) {
        return parent::select('id', 'name', 'item_code', 'discount_to', 'discount_from', 'price', 'discount_amount', 'discounted_price', 'review_count', 'review_average', 'available_from', 'available_to')
                    ->where('status', 'Active')
                    ->whereDate('discount_to', '>=', now())
                    ->orderBy('discount_to')
                    ->orderByDesc('discount_amount')
                    ->limit(self::getLimit($limit))->get();
    }

    /**
     * Flash sale item
     * @param  null
     * @return collection
     */
    public static function recentView() {
        $recentId = auth()->user() ? auth()->user()->id : request()->server('HTTP_USER_AGENT');
        $itemIds = cache()->get($recentId);
        $data = [];
        if (!empty($itemIds)) {
            arsort($itemIds);
            $itemIds = !empty($itemIds) ? array_flip($itemIds) : [];
            $ids = implode(',', $itemIds);
            $data = Item::select('id', 'name', 'item_code')->whereIn('id', $itemIds)
                                ->orderByRaw(\DB::raw("FIELD(id, $ids)"))->get();
        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function cartStoreValidation($data = [])
    {
        $validator = Validator::make($data, [
            'item_id' => 'required|exists:items,id',
        ]);

        return $validator;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function cartIndexValidation($data = [])
    {
        $validator = Validator::make($data, [
            'cartIndex' => 'required',
        ]);

        return $validator;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function cartCouponValidation($data = [])
    {
        $validator = Validator::make($data, [
            'discount_code' => 'required',
        ]);
        return $validator;
    }

    /**
     * @return float|int
     */
    public function positiveRating($vendorId = null)
    {
        $result = 0;
        $reviews = Review::where('status', 'Active');
        if ($vendorId != null) {
            $reviews->whereHas("item", function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })->with('item');
        } else {
            $reviews->where('item_id', $this->id);
        }

        $totalReview = $reviews->count();
        if ($totalReview > 0) {
            $sumRating = $reviews->sum('rating');
            $result = ($sumRating/($totalReview * 5)) * 100;
        }
        return $result > 0 ? round($result) : 100;
    }

    /**
     * calculate days
     *
     * @return void
     */
    public function getLeftDiscountDays()
    {
        $date = strtotime($this->discount_to);
        $remaining = $date - time();
        $days_remaining = floor($remaining / 86400);
        $days_rem_pos = abs($days_remaining);
        $hours_remaining = floor(($remaining % 86400) / 3600);
        $hours_remaining_pos = abs($hours_remaining);
        return [
            'days' => $days_rem_pos,
            'hours' => $hours_remaining_pos,
        ];
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

    /**
     * check shop selectable or not
     *
     * @param $shopId
     * @return bool
     */
    public static function isShopSelected($shopId = null)
    {
        $cartData = Cart::cartCollection()->where('shop_id', $shopId);
        $cartKey = [];
        foreach ($cartData as  $key => $data) {
            $item = Item::where('id', $data['id'])->where('status', 'Active')->first();
            if(!empty($item) && !empty($item->available_from) && availableFrom($item->available_from) || !empty($item) && empty($item->available_from)) {
                if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                   continue;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }
        return false;
    }
}
