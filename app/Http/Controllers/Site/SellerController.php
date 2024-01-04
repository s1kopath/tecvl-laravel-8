<?php
/**
 * @package SellerController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 19-01-2022
 */
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Shop
     * @return \Illuminate\Contracts\View\View
     */
    public function index($alias = null)
    {
        if (is_null($alias) || !isActive('Shop')) {
            return back();
        }

        if (is_null($alias) || !isActive('Shop')) {
            return back();
        }
        $data['shop'] = \Modules\Shop\Http\Models\Shop::whereHas('items', function(Builder $query) {
            $query->whereNotNull('review_average');
        })->withAvg('items as rating', 'review_average')->firstWhere('alias', $alias);

        if (empty($data['shop'])) {
            $data['shop'] = \Modules\Shop\Http\Models\Shop::firstWhere('alias', $alias);
        }
        $data['allItems'] = Item::select('id', 'name', 'item_code', 'discount_to', 'price', 'discounted_price')->where('vendor_id', $data['shop']->vendor->id)->paginate(10);

        return view('site.shop.index', $data);
    }

    public function vendorProfile($alias = null)
    {
        if (is_null($alias) || !isActive('Shop')) {
            return back();
        }

        $data['shop'] = \Modules\Shop\Http\Models\Shop::whereHas('items', function(Builder $query) {
            $query->whereNotNull('review_average');
        })->withAvg('items as rating', 'review_average')->firstWhere('alias', $alias);

        if (empty($data['shop'])) {
            $data['shop'] = \Modules\Shop\Http\Models\Shop::firstWhere('alias', $alias);
        }

        $data['popularItems'] = Item::select('id', 'name', 'item_code', 'discount_to', 'price', 'discounted_price')->whereNotNull('purchase_count')->where('shop_id', $data['shop']->id)->orderBy('purchase_count', 'DESC')->get()->take(5);

        $item = Item::where('status', 'Active')->where('shop_id', $data['shop']->id)->get();
        $data['topItems'] = $item->sortByDesc('review_average')->take(5);
        $data['featureItems'] = $item->sortByDesc('id')->take(5);
        $data['limitedOffer'] = $item->where('discount_from', '<=', now())->where('discount_to', '>=', now())->sortBy('discount_to')->take(4);

        return view('site.shop.vendorProfile', $data);
    }
}
