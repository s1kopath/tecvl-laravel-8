<?php

/**
 * @package SiteController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 08-11-2021
 */

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Models\{Brand, Category, File, Inventory, Item, ItemCategory, ItemDetail, Review, OrderDetail, Tag, Vendor};
use Illuminate\Http\Request;
use Auth, Cache, Cart;
use Illuminate\Support\Facades\Session;
use Modules\Blog\Http\Models\{
    Blog,
    BlogCategory
};
use Modules\CMS\Entities\Page as EntitiesPage;
use Modules\CMS\Http\Models\{
    Slide,
    Page
};

class SiteController extends Controller
{

    /**
     * Homepage
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (class_exists('\Modules\CMS\Service\HomepageService')) {
            $homeService = new \Modules\CMS\Service\HomepageService;
            $page = $homeService->home();
            $slides = Slide::getAll()->where('slider_id', 1);

            if ($page) {
                return view('site.home.index', compact(['homeService', 'page', 'slides']));
            }
        }

        $data['bestCategories'] = Category::bestCategory();
        $data['topBrands'] = Brand::topBrands();
        $data['bestSeller'] = Item::bestSeller();
        $data['popularItems'] = Item::popularItems();
        $data['featureItems'] = Item::featureItems();
        $data['newArrivals'] = Item::newArrivals();
        $data['bestDeals'] = Item::bestDeals();
        $data['flashSale'] = Item::flashSales();
        $data['slides'] = Slide::whereHas('slider', function($query) {
            $query->where(['slug' => 'home-page', 'status' => 'Active']);
        })->get();
        $data['blogs'] = Blog::with('user')->where('status', 'Active')->orderBy('id', 'DESC')->limit(3)->get();
        $data['recentView'] = Item::recentView();

        return view('site.home.index', $data);
    }

    public function compare()
    {
        return view('site.item.compare');
    }

    /**
     * Item Details
     *
     * @param $code
     * @param $name
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function itemDetails($code, $name)
    {
        $item = Item::where('item_code', $code)->where('status', 'Active')->first();
        if (!empty($item)) {
            if (!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from)) {
                if (!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                    $data['item'] = $item;
                    $price = $item->isDiscountable() ? $item->discounted_price : $item->price;
                    $data['reviews'] = Review::where('item_id', $item->id)->where('status', 'Active')->paginate(5);
                    $data['price'] = $price;
                    $data['actualPrice'] = $item->price;
                    $data['relates'] = Item::join('item_relates', 'items.id', '=', 'item_relates.related_item_id')
                        ->selectRaw('items.*')
                        ->where('item_relates.item_id', $item->id)
                        ->get()
                        ->take(4);
                    $data['shopAlias'] = $item->vendor->shops()->first()->alias;
                    $data['sameShop'] = Item::where('vendor_id', $item->vendor_id)->where('id', '!=', $item->id)->limit(3)->get();
                    $category = Category::getAll()->where('id', optional($item->itemCategory)->category_id)->first();
                    $parent[] = !empty($category) ? ['name' => $category->name, 'slug' => $category->slug] : null;
                    while (1) {
                        if (!empty($category->category)) {
                            $category = $category->category;
                            $parent[] = ['name' => $category->name, 'slug' => $category->slug];
                        } else {
                            break;
                        }
                    }

                    $data['parentCategory'] = $parent != null ? array_reverse($parent) : $parent;

                    $recentView = [];
                    if (auth()->user()) {
                        if (Cache::has(auth()->user()->id)) {
                            $recentView = Cache::get(auth()->user()->id);
                        }
                        $recentView[$item->id] = now()->toDateTimeString();
                        \Cache::put([auth()->user()->id => $recentView], config('cache.recentView'));
                    } else {
                        if (Cache::has(request()->server('HTTP_USER_AGENT'))) {
                            $recentView = Cache::get(request()->server('HTTP_USER_AGENT'));
                        }
                        $recentView[$item->id] = now()->toDateTimeString();
                        \Cache::put([request()->server('HTTP_USER_AGENT') => $recentView], config('cache.recentView'));
                    }

                    return view('site.item.details', $data);
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Blog all list
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function allBlogs()
    {
        $data['blogs'] = Blog::where(['status' => 'Active'])->archiveFilter(request(['year']))->paginate(10);

        if (empty($data['blogs'])) {
            return redirect()->back();
        }

        $data['blogCategory'] = null;

        $data['popularBlogs'] = Blog::activePost()->orderBy('total_views', 'DESC')->get()->take(3);

        $data['blogCategories'] = BlogCategory::whereHas('blog', function ($query) {
            $query->activePost();
        })->get();

        $data['archives'] = Blog::archives();

        return view('site.blog.blog-post', $data);
    }

    /**
     * search blog list
     * @param Request $request
     * @return array
     */
    public function blogSearch(Request $request)
    {
        $value = $request->search;
        $data['blogs'] = Blog::WhereLike('title', $value)
            ->orWhereLike('description', $value)->activePost()->paginate(10);

        if (empty($data['blogs'])) {
            return redirect()->back();
        }

        $data['blogCategory'] = null;

        $data['popularBlogs'] = Blog::activePost()->orderBy('total_views', 'DESC')->get()->take(3);

        $data['blogCategories'] = BlogCategory::whereHas('blog', function ($query) {
            $query->activePost();
        })->get();

        $data['archives'] = Blog::archives();

        return view('site.blog.blog-post', $data);
    }
    /**
     * Blog Details
     * @param $slug
     */
    public function blogDetails($slug)
    {
        $query = Blog::with("blogCategory:id,name", "user:id,name")->activePost();
        $data['blog'] = $query = $query->where('slug', $slug)->first();

        if (empty($data['blog'])) {
            return redirect()->back();
        }

        $blogKey = 'blog_' . $data['blog']->id;
        if (!Session::has($blogKey)) {
            $data['blog']->increment('total_views');
            Session::put($blogKey, 1);
        }

        $nextId = Blog::activePost()->where('id', '>', $data['blog']->id)->min('id');
        $data['nextUrl'] = Blog::find($nextId);

        $previousId = Blog::activePost()->where('id', '<', $data['blog']->id)->min('id');
        $data['previousUrl'] = Blog::find($previousId);

        $data['popularBlogs'] = $query->activePost()->orderBy('total_views', 'DESC')->get()->take(3);

        $data['blogCategories'] = BlogCategory::whereHas('blog', function ($query) {
            $query->activePost();
        })->get();

        $data['relatedPosts'] = $query->with("user:id,name")->where('category_id', $data['blog']->category_id)->activePost()->where('id', '!=', $data['blog']->id)->inRandomOrder()->get()->take(3);

        $data['archives'] = Blog::archives();

        return view('site.blog.blog-details', $data);
    }

    /**
     * Blog Category
     * @param $id
     */
    public function blogCategory($id)
    {
        $data['blogs'] = Blog::where(['category_id' => $id, 'status' => 'Active'])->paginate(10);

        if (empty($data['blogs'])) {
            return redirect()->back();
        }
        $data['blogCategory'] = BlogCategory::find($id);
        $data['popularBlogs'] = Blog::activePost()->orderBy('total_views', 'DESC')->get()->take(3);

        $data['blogCategories'] = BlogCategory::whereHas('blog', function ($query) {
            $query->activePost();
        })->get();

        $data['archives'] = Blog::archives();

        return view('site.blog.blog-post', $data);
    }

    /**
     * Pages
     * @param $slug
     */
    public function page($slug)
    {
        $data['page'] = Page::getAll()->where('slug', $slug)->first();
        if (isset($data['page'])) {
            if ($data['page']->type == 'home') {
                $homeService = new \Modules\CMS\Service\HomepageService;
                $page = EntitiesPage::where('slug', $slug)->with(['components' => function ($q) {
                    $q->with(['properties', 'layout:id,file'])->orderBy('level', 'asc');
                }])->first();
                $slides = Slide::getAll()->where('slider_id', 1);
                $page_layout = 'page_layout_1';
                return view('cms::templates.' . $page_layout, compact('page', 'slides', 'homeService'));
            }
            return view('site.pages.page', $data);
        }
        return redirect()->back();
    }

    /**
     * Review Store
     *
     * @param Request $request
     * @return array
     */
    public function reviewStore(Request $request)
    {
        $response = ['status' => 0, 'message' => __('Oops! Something went wrong, please try again.')];
        $request['user_id'] = Auth::user()->id ?? null;
        if (Review::where('user_id', $request['user_id'])->where('item_id', $request->item_id)->count() > 0) {
            $response['status'] = 0;
            $response['message'] = __('You have already done your review.');
            return $response;
        }
        $request['status'] = 'Active';
        $request['is_public'] = 1;
        $validator = Review::storeValidation($request->all(), $request->review_id);
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        $id = (new Review)->store($request->only('comments', 'user_id', 'status', 'is_public', 'rating', 'item_id'));
        if (!empty($id)) {
            $response['status'] = 1;
            $response['message'] = __('Thanks for the review. It will be published soon.');
            return $response;
        }
        return $response;
    }

    /**
     * Review fetch
     *
     * @param Request $request
     * @return render view
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $reviews = Review::where('item_id', $request->item_id)->where('status', 'Active')->where('is_public', 1)->paginate(5);
            return view('site.item.review', compact('reviews'))->render();
        }
    }

    /**
     * Edit review
     *
     * @param Request $request
     * @return view
     */
    public function updateReview(Request $request)
    {
        $response = ['status' => 0, 'message' => __('Oops! Something went wrong, please try again.')];

        $validator = Review::userUpdateValidation($request->all());
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['message'] = $validator->errors()->first();
            return $response;
        }
        if ((new Review)->updateReview($request->only('comments', 'rating'), $request->id)) {
            $response['status'] = 1;
            $response['message'] = __('Thanks for the review. It will be published soon.');
            return $response;
        }
        return $response;
    }

    /**
     * delete review image
     *
     * @param $file
     * @return response
     */
    public function deleteReview(Request $request)
    {
        $fileExplode = explode(DIRECTORY_SEPARATOR, $request->path);
        $fileName = $fileExplode[count($fileExplode) -2] . DIRECTORY_SEPARATOR . end($fileExplode);
        if (File::where('file_name', $fileName)->delete()) {
            if (file_exists(public_path('/uploads/' . $fileName))) {
                unlink(public_path('/uploads/' . $fileName));
            }
            return response()->json('success');
        }
        return response()->json('error');
    }

    /**
     * Review filter
     *
     * @param Request $request
     * @return render view
     */
    public function filterReview(Request $request)
    {
        if ($request->ajax()) {
            $reviews = Review::where('item_id', $request->itemId)->where('status', 'Active')->where('is_public', 1)->where('rating', $request->rating)->paginate(5);
            if ($request->rating == 0) {
                $reviews = Review::where('item_id', $request->itemId)->where('status', 'Active')->where('is_public', 1)->where('rating', '>=', 0)->paginate(5);
            }

            return view('site.item.review', compact('reviews'))->render();
        }
    }

    /** items by category
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function categoryItems($slug)
    {
        $category = Category::getAll()->where('slug', $slug)->where('status', 'Active')->first();
        if (!empty($category)) {
            $data['selectedCategory'] = $category->id;
            $data['selectedCategoryName'] = $category->name;
            $data['selectedCategorySlug'] = $category->slug;
            $parent = null;
            while (1) {
                if (!empty($category->category)) {
                    $category = $category->category;
                    $parent[] = ['name' => $category->name, 'slug' => $category->slug];
                } else {
                    break;
                }
            }
            $data['parentCategory'] = $parent != null ? array_reverse($parent) : $parent;
            return view('site.filter.index', $data);
        }
        return redirect()->back();
    }

    /** items by brand
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function brandItems($id)
    {
        $brand = Brand::getAll()->where('id', $id)->first();
        if (!empty($brand)) {
            $data['brand'] = $brand;
            return view('site.filter.index', $data);
        }
        return redirect()->back();
    }

    /**
     * item filter depend on search result
     *
     * @param Request $request
     * @return array
     */
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $category = $request->data['category'] ?? null;
            $labels = $request->data['labels'] ?? null;
            $requestedBrands = $request->data['brands'] ?? null;
            $min = $request->data['min'] ?? null;
            $max = $request->data['max'] ?? null;
            $requestedRating = $request->data['rating'] ?? null;
            $sortBy = $request->data['sort_by'] ?? null;
            $data['subCategory'] = isset($request->data['subCategory']) ? json_decode($request->data['subCategory']) : [];
            $searchKeyword = isset($request->data['searchKeyword']) ? urldecode($request->data['searchKeyword']) : null;
            $brands = [];
            $itemOptions = [];
            $ratings = [];
            $optionArray = [];
            $optionArrayDup = [];
            $optionName = [];
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
            $items = $items->orderBy($column, $order)->paginate(20);
            $data['items'] = $items;
            foreach ($items as $item) {
                if (count($relatedCategory) == 0 || $catFlag == true) {
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
                            if (isset(json_decode($op->payloads)->label)) {
                                $optionName[] = $op->name;
                                $optionArray[] = [
                                    'option' => $op->name,
                                    'label' => json_decode($op->payloads)->label
                                ];
                            }
                        } else {
                            if (isset(json_decode($op->payloads)->label)) {
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
                                array_push($optionArray[$key]['label'], $lb);
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
            $data['selectedCategory'] = $category;
            $data['requestValue'] = $request->all();
            return view('site.filter.result', $data)->render();
        }
    }

    /**
     * items search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $data['page_title'] = __('Items');
        if (isset($request->keyword) && !empty($request->keyword)) {
            $data['searchKeyword']  = urldecode($request->keyword);
            return view('site.filter.index', $data);
        }
        return redirect()->route('site.index');
    }

    /**
     * get stock
     *
     * @param Request $request
     * @return array
     */
    public function getStock(Request $request)
    {
        $inventory = Inventory::where('item_option_id', $request->item_option_id)->where('label', $request->option_label)->first();
        $response['status'] = 0;
        if (!empty($inventory)) {
            $cartQty = $this->getStockTotalQty($request->item_option_id, $request->option_label);
            $itemDetails = ItemDetail::where('item_id', optional($inventory->itemOption)->item_id)->first();
            $response = [
                'status' => 1,
                'quantity' => $inventory->quantity - $cartQty,
                'is_track_inventory' => !empty($itemDetails) ? $itemDetails->is_track_inventory : null,
                'is_hide_stock' => !empty($itemDetails) ? $itemDetails->is_hide_stock : null,
            ];
            return $response;
        }
        return $response;
    }

    /**
     * sum total quantity from cart list
     *
     * @param $optionIds
     * @param $label
     * @param $qty
     * @param $searchId
     * @param $searchLabel
     * @return int|mixed
     */
    protected function getStockTotalQty($searchId = null, $searchLabel = null)
    {
        $totalQty = 0;
        $optionIds = Cart::cartCollection()->pluck('option_id')->toArray();
        $label = Cart::cartCollection()->pluck('option')->toArray();
        $qty = Cart::cartCollection()->pluck('quantity')->toArray();
        foreach ($optionIds as $mainKey => $id) {
            $decodeOptionIds = json_decode($id);
            $decodeOptionLabel = json_decode($label[$mainKey] ?? []);
            foreach ($decodeOptionIds as $secKey => $optionId) {
                $optionLabel = $decodeOptionLabel[$secKey] ?? '';
                if ($optionId == $searchId && $optionLabel == $searchLabel) {
                    $totalQty += $qty[$mainKey] ?? 0;
                }
            }
        }
        return $totalQty;
    }

    /**
     * Item Quick view
     *
     * @param $id
     * @return render
     */
    public function quickView(Request $request, $id)
    {
        $data['item'] = Item::find($id);
        if (!empty($data['item'])) {
            if ($request->ajax()) {
                return view('site.layouts.includes.item_view', $data)->render();
            }
        }
    }
    // coupon
    public function coupon(){
        return view('site.coupon.index');
    }
}
