<?php
/**
 * @package ItemController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 29-01-2022
 */
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\{ItemFilterResource, ItemResource, RecentSearchResource};
use App\Models\{Brand, Category, Item, Search, Tag, UserSearch};
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Category list
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request, $params = null)
    {
        $configs = $this->initialize([], $request->all());
        $item = Item::select('id', 'name', 'item_code', 'sku', 'price', 'available_from', 'available_to', 'description', 'summary', 'status', 'created_at', 'brand_id')->where('status', 'Active')->with(['brand:id,name', 'itemCategory:item_id,category_id']);
        if ($params == 'topRated') {
            $items = $item->orderByDesc('review_average');
        } else if ($params == 'featureItems') {
            $items = $item->orderByDesc('id');
        } else if ($params == 'limitedOffer') {
            $items = $item->where('discount_from', '<=', now())->where('discount_to', '>=', now())->orderBy('discount_to');
        } else if ($params == 'popularItems') {
            $items = $item->whereNotNull('purchase_count')->orderBy('purchase_count', 'DESC');
        } else {
            $items = $item;
        }
        $name = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $items->where('name', strtolower($name));
        }

        $itemCode = isset($request->item_code) ? $request->item_code : null;
        if (!empty($itemCode)) {
            $items->where('item_code', strtolower($itemCode));
        }

        $sku = isset($request->sku) ? $request->sku : null;
        if (!empty($sku)) {
            $items->where('sku', strtolower($sku));
        }

        $vendor = isset($request->vendor) ? $request->vendor : null;
        if (!empty($vendor)) {
            $items->whereHas("vendor", function ($q) use ($vendor) {
                $q->where('name', strtolower($vendor));
            })->with('vendor');
        }

        $brand = isset($request->brand) ? $request->brand : null;
        if (!empty($brand)) {
            $items->whereHas("brand", function ($q) use ($brand) {
                $q->where('name', strtolower($brand));
            })->with('brand');
        }

        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $items->where('status', strtolower($status));
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $items->where('id', $keyword);
            } else {
                if (strlen($keyword) >= 3) {
                    $items->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('item_code', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('sku', 'LIKE', '%' . $keyword . '%')
                            ->orwhereHas("vendor", function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', "%" . $keyword . "%");
                            })->with('vendor')
                            ->orwhereHas("brand", function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', "%" . $keyword . "%");
                            })->with('brand');
                    });
                }
            }
        }
        return $this->response([
            'data' => ItemResource::collection($items->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($items->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * items search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $category = $request->category ?? null;
        $labels = $request->labels ?? null;
        $requestedBrands = $request->brands ?? null;
        $min = $request->min ?? null;
        $max = $request->max ?? null;
        $requestedRating = $request->rating ?? null;
        $sortBy = $request->sort_by ?? null;
        $data['subCategory'] = isset($request->subCategory) ? json_decode($request->subCategory) : [];
        $searchKeyword = isset($request->searchKeyword) ? urldecode($request->searchKeyword) : null;
        if (empty($searchKeyword) && empty($category)) {
            return $this->notFoundResponse(null,__('No Item Found'));
        }
        $brands = []; $itemOptions = []; $ratings = []; $optionArray = []; $optionArrayDup = []; $optionName = [];
        $relatedCategory = [];
        $brands = [];
        $itemOptions = [];
        $ratings = [];
        $brandEntry = false;
        $ratingEntry = false;
        $optionEntry = false;
        $catFlag = false;
        $items = Item::where('status', 'Active');
        $enterTagSearch = false;
        if (!empty($searchKeyword)) {
            $searchId = (new Search)->store(['name' => $searchKeyword]);
            if (!empty($searchId)) {
                if (isset(auth()->guard('api')->user()->id)) {
                    if (!UserSearch::where('search_id', $searchId)->where('user_id', auth()->guard('api')->user()->id)->exists()) {
                        (new UserSearch)->store(['user_id' => auth()->guard('api')->user()->id, 'search_id' => $searchId]);
                    }
                } else {
                    if (!UserSearch::where('search_id', $searchId)->where('browser_agent', getUniqueAddress())->exists()) {
                    (new UserSearch)->store(['browser_agent' => getUniqueAddress(), 'search_id' => $searchId]);
                    }
                }
            }
            $tags = Tag::WhereLike('name', $searchKeyword)->pluck('id')->toArray();
            if (is_array($tags) && count($tags) > 0) {
                $enterTagSearch = true;
                $items->whereHas("itemTag", function ($q) use ($tags) {
                    $q->whereIn('tag_id', $tags);
                })->with('itemTag');
            }
            if ($items->count() == 0 || $enterTagSearch == false) {
                $enterTagSearch == true ? $items = Item::where('status', 'Active') : '';
                $items->where(function ($query) use ($searchKeyword) {
                    $query->WhereLike('name', $searchKeyword)
                        ->OrWhereLike('sku', $searchKeyword)
                        ->orwhereHas("brand", function ($q) use ($searchKeyword) {
                            $q->WhereLike('name', $searchKeyword);
                        })->with('brand');
                });
            }
            $brands = $items->get()->pluck('brand_id')->toArray();
            $itemOptions = $items->get()->pluck('itemOption');
            $relatedCategory = $items->get()->pluck('itemCategory.category_id')->toArray();
        }
        if (!empty($category)) {
            $parentCat = Category::getAll()->where('id', $category)->first();
            $subCategory = Category::getAll()->where('parent_id', $parentCat->id)->pluck('id')->toArray();
            if (!empty($parentCat)) {
                if (is_array($subCategory) && count($subCategory) > 0 && is_array($data['subCategory']) && count($data['subCategory']) == 0) {
                    $data['subCategory'] = $subCategory;
                    $items->whereHas("itemCategory", function ($q) use ($subCategory) {
                        $q->whereIn('category_id', $subCategory);
                    })->with('itemCategory');
                } else {
                    $items->whereHas("itemCategory", function ($q) use ($category) {
                        $q->where('category_id', $category);
                    })->with('itemCategory');
                    is_array($data['subCategory']) && count($data['subCategory']) > 0 ? $relatedCategory = $data['subCategory'] : [];
                }
            }
        }
        if (!empty($min)) {
            $items->where('price', '>=', $min);
        }
        if (!empty($max)) {
            $items->where('price', '<=', $max);
        }
        if (!empty($requestedBrands)) {
            $items->whereIn('brand_id', $requestedBrands);
            $relatedCategory = $items->get()->pluck('itemCategory.category_id')->toArray();
            $itemOptions = $items->get()->pluck('itemOption');
        }
        if (!empty($requestedRating)) {
            $incRating = $requestedRating + 1;
            $items->where('review_average', '>=', $requestedRating)->where('review_average', '<', $incRating);
        }
        if (!empty($labels)) {
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
        $results = $items->orderBy($column, $order)->paginate($configs['rows_per_page']);
        foreach ($results as $item) {
            if(count($relatedCategory) == 0 || $catFlag == true) {
                $catFlag = true;
                isset($item->itemCategory->category_id) ? $relatedCategory[] = $item->itemCategory->category_id : '';
            }
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
        $data['requestData'] = $request->all();

        return $this->response([
            'data' => ItemFilterResource::collection($results),
            'filterData' => $data,
            'pagination' => $this->toArray($items->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);

    }

    /**
     * recent search
     *
     * @param Request $request
     * @return void
     */
    public function recentSearch(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        if (isset(auth()->guard('api')->user()->id)) {
            $userId = auth()->guard('api')->user()->id;
            $result = UserSearch::select("searches.id", "searches.name",)
            ->leftJoin("searches", "searches.id", "=", "user_searches.search_id")
            ->where("user_searches.user_id", auth()->guard('api')->user()->id);
        } else {
            $browserAgent = getUniqueAddress();
            $result = UserSearch::select("searches.id", "searches.name",)
                ->leftJoin("searches", "searches.id", "=", "user_searches.search_id")
                ->where("user_searches.browser_agent", $browserAgent);
        }

        return $this->response([
            'data' => RecentSearchResource::collection($result->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($result->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);

    }
}
