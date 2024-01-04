<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Item;
use App\Models\ItemAttribute;
use Illuminate\Http\Request;
use Compare;
class CompareController extends Controller
{
    /**
     * compare list
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $compare = Compare::compareCollection();
        $itemAttribute = [];
        $ItemName = [];
        $itemId = [];
        $summary = [];
        $rating = [];
        $availability = [];
        $price = [];
        $categoryId = [];
        $categoryName = [];
        $sku = [];
        $brand = [];
        $ratingCount = [];
        foreach ($compare as $comp) {
            $item = Item::where('id', $comp)->first();
            if (!empty($item)) {
                $itemId[] = $item->id;
                $sku[$comp] = $item->sku;
                $brand[$comp] = optional($item->brand)->name;
                $categoryName[$comp] = optional(optional($item->itemCategory)->category)->name;
                $ItemName[$comp] = ["name" => $item->name, 'image' => $item->fileUrl(), 'item_code' => $item->item_code ];
                $summary[$comp] = $item->summary;
                $rating[$comp] = $item->review_average;
                $ratingCount[$comp] = $item->review_count;
                if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from)) {
                    if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                        $availability[$comp] = true;
                    } else {
                        $availability[$comp] = false;
                    }
                } else {
                    $availability[$comp] = false;
                }
                $price[$comp] = $item->price;
                $categoryId[] = optional($item->itemCategory)->category_id;
                foreach ($item->itemAttributes as $attribute) {
                    $itemAttribute[] = $attribute->attribute_id;
                }
            }
        }
        $itemAttribute = count($itemAttribute) > 0 ? array_unique($itemAttribute) : [];
        $categoryId = count($itemAttribute) > 0 ? array_unique($categoryId) : [];
        $allAttribute = Attribute::whereHas("categoryAttribute", function ($q) use ($categoryId) {
                                    $q->whereIn('category_id', $categoryId);
                                })->with('categoryAttribute')->get();
        $data['compareItems'] = [
            'itemId' => $itemId,
            'category' => $categoryName,
            'sku' => $sku,
            'brand' => $brand,
            'itemName' => $ItemName,
            'summary' => $summary,
            'rating' => $rating,
            'ratingCount' => $ratingCount,
            'price' => $price,
            'availability' => $availability,
            'itemAttribute' => $itemAttribute,
            'allAttribute' => $allAttribute
        ];
        $data['compare'] = $compare;
        return view('site.compare.index', $data);
    }

    /**
     * compare store
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $response['status'] = 0;
        $response['message'] =  __("Failed to added in compare list! try again.");
        $item = Item::where('id', $request->item_id)->first();
        if (!empty($item)) {
            $add = Compare::add($request->item_id);
            if ($add) {
                $response = [
                    "status" => 1,
                    "message" => __("Item successfully added in compare list."),
                    "totalItem" => Compare::totalItem(),
                ];
            } else {
                $response = [
                    "status" => 0,
                    "message" => __("Already added. Try another one."),
                    "totalItem" => Compare::totalItem(),
                ];
            }
        }
        return $response;
    }

    /**
     * compare destroy
     *
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        $response['status'] = 0;
        $response['message'] =  __("Something went wrong, please try again.");
        if (Compare::destroy($request->item_id)) {
            $response = [
                "status" => 1,
                "message" => __("Deleted Successfully"),
                "totalItem" => Compare::totalItem(),
            ];
        }
        return $response;
    }
}
