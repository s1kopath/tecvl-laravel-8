<?php
/**
 * @package ApiVendorItemController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 12-04-2022
 */
namespace App\Http\Controllers\Api\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemDetailResource;
use App\Http\Resources\ItemResource;
use App\Models\{
    Inventory,
    Item,
    ItemAttribute,
    ItemCategory,
    ItemCrossSale,
    ItemDetail,
    ItemOption,
    ItemRelate,
    ItemTag,
    ItemUpsale,
    Tag
};
use Illuminate\Http\Request;
use Str;
use DB;

class ApiVendorItemController extends Controller
{
    /**
     * Item List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $items = Item::where('vendor_id', $vendorId);
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
                            ->where('item_code', 'LIKE', '%' . $keyword . '%')
                            ->where('sku', 'LIKE', '%' . $keyword . '%')
                            ->orwhereHas("vendor", function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', "%" . $keyword . "%");
                            })->with('vendor')
                            ->orwhereHas("brand", function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', "%" . $keyword . "%");
                            })->with('brand')
                            ->orwhere('status', $keyword);
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
     * Store Item
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        $attributeData = [];
        $optionData = [];
        $optionOrderBy = 1;
        $request['attribute_data'] = json_decode($request->attribute_data, true);
        $request['option_data'] = json_decode($request->option_data, true);
        $request['tags'] = json_decode($request->tags, true);
        $request['vendor_id'] = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $validator = Item::storeValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        try {
            while(1) {
                $itemCode = Str::random(12);
                if (!hasItemCodeExists(strtoupper($itemCode))) {
                    break;
                }
            }
            $request['item_code'] = strtoupper($itemCode);
            $request['available_from'] = !empty($request->available_from) ? DbDateFormat($request->available_from) : null;
            $request['available_to'] = !empty($request->available_to) ? DbDateFormat($request->available_to) : null;
            $request['discount_from'] = !empty($request->discount_from) ? DbDateFormat($request->discount_from) : null;
            $request['discount_to'] = !empty($request->discount_to) ? DbDateFormat($request->discount_to) : null;
            DB::beginTransaction();
            $itemId = (new Item)->store($request->all());
            if (!empty($itemId)) {
                $itemCategory = [
                    'item_id' => $itemId,
                    'category_id' => $request->category_id
                ];
                (new ItemCategory)->store($itemCategory);

                // item other
                $itemDetail['shipping_id'] = $request->shipping_id ?? null;
                $itemDetail['item_id'] = $itemId;
                $itemDetail['tax_id'] = $request->tax_id;
                $itemDetail['warranty_type'] = $request->warranty_type;
                $itemDetail['warranty_period'] = $request->warranty_period;
                $itemDetail['warranty_policy'] = $request->warranty_policy;
                $itemDetail['is_track_inventory'] = isset($request->is_track_inventory) && $request->is_track_inventory == 'on' ? 1 : 0;
                $itemDetail['is_discount'] = isset($request->is_discount) && $request->is_discount == 'on' ? 1 : 0;
                $itemDetail['is_featured'] = isset($request->is_featured) && $request->is_featured == 'on' ? 1 : 0;
                $itemDetail['is_cash_on_delivery'] = isset($request->is_cash_on_delivery) && $request->is_cash_on_delivery == 'on' ? 1 : 0;
                $itemDetail['is_hide_stock'] = isset($request->is_hide_stock) && $request->is_hide_stock == 'on' ? 1 : 0;
                (new ItemDetail)->store($itemDetail);
                //end item other

                if (isset($request->attribute_data)) {
                    foreach ($request->attribute_data as $key => $attribute) {
                        if (!empty($attribute)) {
                            $attributeData[] = [
                                'item_id' => $itemId,
                                'attribute_id' => $key,
                                'payloads' => is_array($attribute) ? json_encode($attribute) : $attribute
                            ];
                        }
                    }
                    (new ItemAttribute)->store($attributeData);
                }
                if (isset($request->option_data)) {
                    foreach ($request->option_data as $key => $option) {
                        $labelData = [];
                        $optionPriceData = [];
                        $optionPriceTypeData = [];
                        $optionValueOrderBy = 1;
                        $optionStatus = [];
                        $inventoryIds = [];
                        foreach ($option['label'] as $label) {
                            $labelData[] = $label;
                        }
                        foreach ($option['option_price'] as $priceKey => $option_price) {
                            $optionPriceData[] = [
                                'order_by' => $optionValueOrderBy++,
                                'option_price' => $option_price
                            ];
                            // insert inventory
                            $inventory = [
                                'label' => $labelData[$priceKey] ?? null,
                                'vendor_id' => $request->vendor_id ?? null,
                                'quantity' => isset($option['option_qty'][$priceKey]) && $option['option_qty'][$priceKey] > 0 ? $option['option_qty'][$priceKey] : 0
                            ];
                            $inventoryIds[] = (new Inventory)->store($inventory);
                        }
                        foreach ($option['option_price_type'] as $option_price_type) {
                            $optionPriceTypeData[] = $option_price_type;
                        }

                        foreach ($option['option_status'] as $opStatus) {
                            $optionStatus[] = $opStatus;
                        }

                        $payloads = [
                            'label' => $labelData,
                            'option_price'  => $optionPriceData,
                            'option_price_type' => $optionPriceTypeData,
                            'inventory_id' => $inventoryIds,
                            'option_status' => $optionStatus
                        ];
                        $optionData = [
                            'item_id' => $itemId,
                            'name' => $option['option_name'],
                            'type' => $option['type'],
                            'order_by' => $optionOrderBy++,
                            'is_required' => $option['is_required'],
                            'payloads' => json_encode($payloads),
                        ];
                        $optionId = (new ItemOption)->store($optionData);

                        // update inventory & add item option id
                        if (!empty($inventoryIds) && !empty($optionId)) {
                            foreach ($inventoryIds as $invId) {
                                (new Inventory)->updateInventory(['item_option_id' => $optionId], $invId);
                            }
                        }
                    }
                }

                //tag region
                $insertItemTags = [];
                if (isset($request->tags) && !empty($request->tags)) {
                    foreach ($request->tags as $tag) {
                        $tagExists = Tag::getAll()->where('name', $tag)->where('status', "Active")->first();
                        if (!empty($tagExists)) {
                            $existsItemTag = ItemTag::where('tag_id', $tagExists->id)->where('item_id', $itemId)->first();
                            if (empty($existsItemTag)) {
                                $insertItemTags[] = [
                                    "item_id" => $itemId,
                                    "tag_id" => $tagExists->id
                                ];
                            }
                        }
                        else {
                            if (!empty($tag)) {
                                $insertTag = [
                                    "name" => $tag,
                                    "vendor_id" => $request->vendor_id,
                                ];
                                $tagId = (new Tag)->store($insertTag);
                                $insertItemTags[] = [
                                    "item_id" => $itemId,
                                    "tag_id" => $tagId
                                ];
                            }
                        }
                    }
                    $dupTagId = [];
                    foreach ($insertItemTags as $key => $itTag) {
                        if (!in_array($itTag['tag_id'], $dupTagId)) {
                            $dupTagId[] =  $itTag['tag_id'];
                        } else {
                            unset($insertItemTags[$key]);
                        }
                    }
                    (new ItemTag)->store($insertItemTags);
                }
                //end tag region

                DB::commit();
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Item')]));
            }
        } catch (Exception $e) {
            DB::rollBack();
            return $this->unprocessableResponse($e->getMessage());
        }
        return $this->errorResponse();
    }

    /**
     * Item Serch
     *
     * @param Request $request
     * @param $type
     */
    public function search(Request $request, $type)
    {
        $id = $request->item_id;
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $item = Item::where('id', $id)->where('vendor_id', $vendorId);
        if ($item->exists()) {
            if ($type == 'relate') {
                return $this->response([
                    'data' => (new Item)->search($request->search, $request->item_id, $type, "api", "vendorApi"),
                ]);
            }
            if ($type == 'cross') {
                return $this->response([
                    'data' => (new Item)->search($request->search, $request->item_id, $type, "api", "vendorApi"),
                ]);
            }
            if ($type == 'up') {
                return $this->response([
                    'data' => (new Item)->search($request->search, $request->item_id, $type, "api", "vendorApi"),
                ]);
            }
        }
        return $this->unprocessableResponse(__(':x does not exist.', ['x' => __('Item')]));
    }

    /**
     * Detail Item
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $item = Item::where('id', $id)->where('vendor_id', $vendorId)->first();
        if (!empty($item)) {
            return $this->response([
                'data' => new ItemDetailResource($item)
            ]);
        }
        return $this->unprocessableResponse(__(':x does not exist.', ['x' => __('Item')]));
    }

    /**
     * updte relted item
     *
     * @param $type
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRealte($type, Request $request)
    {
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $item = Item::where('id', $request->item_id)->where('vendor_id', $vendorId);
        if ($item->exists()) {
            $request['related_item_id'] = json_decode($request->related_item_id);
            $data = [];
            $existValue = [];
            $newItem = [];
            $itemIds = [];
            if ($type == "relate") {
                $oldRelateItem = ItemRelate::getAll()->where('item_id', $request->item_id)->pluck('related_item_id')->toArray();
                if (isset($request->related_item_id) && !empty($request->related_item_id)) {
                    foreach ($request->related_item_id as $item) {
                        if (in_array($item, $oldRelateItem)) {
                            $existValue[] = $item;
                        } else {
                            $itemIds[] = $item;
                            $newItem[] = [
                                'item_id' => $request->item_id,
                                'related_item_id' => $item
                            ];
                        }
                    }
                }
                if (count($newItem) > 0) {
                    $data = [
                        "item_id" => $request->item_id,
                        "related_item_id" => $itemIds,
                    ];
                    $validator = ItemRelate::storeValidation($data, $request->item_id);
                    if ($validator->fails()) {
                        return $this->unprocessableResponse($validator->messages());
                    }
                    (new ItemRelate)->store($newItem);
                }
                foreach ($oldRelateItem as $old) {
                    if (!in_array($old, $existValue)) {
                        (new ItemRelate)->remove($request->item_id, $old);
                    }
                }
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Related Items')]));
            } elseif ($type == "cross") {
                $oldCrossItem = ItemCrossSale::getAll()->where('item_id', $request->item_id)->pluck('cross_sale_item_id')->toArray();
                if (isset($request->related_item_id) && !empty($request->related_item_id)) {
                    foreach ($request->related_item_id as $item) {
                        if (in_array($item, $oldCrossItem)) {
                            $existValue[] = $item;
                        } else {
                            $itemIds[] = $item;
                            $newItem[] = [
                                'item_id' => $request->item_id,
                                'cross_sale_item_id' => $item
                            ];
                        }
                    }
                }
                if (count($newItem) > 0) {
                    $data = [
                        "item_id" => $request->item_id,
                        "related_item_id" => $itemIds,
                    ];
                    $validator = ItemCrossSale::storeValidation($data, $request->item_id);
                    if ($validator->fails()) {
                        return $this->unprocessableResponse($validator->messages());
                    }
                    (new ItemCrossSale)->store($newItem);
                }
                foreach ($oldCrossItem as $old) {
                    if (!in_array($old, $existValue)) {
                        (new ItemCrossSale)->remove($request->item_id, $old);
                    }
                }
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Cross Sale')]));
            } elseif ($type == "up") {
                $oldUpItem = ItemUpsale::getAll()->where('item_id', $request->item_id)->pluck('upsale_item_id')->toArray();
                if (isset($request->related_item_id) && !empty($request->related_item_id)) {
                    foreach ($request->related_item_id as $item) {
                        if (in_array($item, $oldUpItem)) {
                            $existValue[] = $item;
                        } else {
                            $itemIds[] = $item;
                            $newItem[] = [
                                'item_id' => $request->item_id,
                                'upsale_item_id' => $item
                            ];
                        }
                    }
                }
                if (count($newItem) > 0) {
                    $data = [
                        "item_id" => $request->item_id,
                        "related_item_id" => $itemIds,
                    ];
                    $validator = ItemUpsale::storeValidation($data, $request->item_id);
                    if ($validator->fails()) {
                        return $this->unprocessableResponse($validator->messages());
                    }
                    (new ItemUpsale)->store($newItem);
                }
                foreach ($oldUpItem as $old) {
                    if (!in_array($old, $existValue)) {
                        (new ItemUpsale)->remove($request->item_id, $old);
                    }
                }
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Up Sale')]));
            }
        } else {
            return $this->unprocessableResponse(__(':x does not exist.', ['x' => __('Item')]));
        }
    }

    /**
     * Update Item Information
     * @param Request $request
     * @return json $data
     */
    public function update(Request $request, $id)
    {
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $item = Item::where('id', $id)->where('vendor_id', $vendorId)->first();
        if (!empty($item)) {
            $request['price'] = validateNumbers($request->price);
            $request['discount_price'] = validateNumbers($request->discount_price);
            $request['discount_amount'] = validateNumbers($request->discount_amount);
            $request['maximum_discount_amount'] = validateNumbers($request->maximum_discount_amount);
            $request['minimum_order_for_discount'] = validateNumbers($request->minimum_order_for_discount);
            $request['attribute_data'] = json_decode($request->attribute_data, true);
            $request['option_data'] = json_decode($request->option_data, true);
            $request['vendor_id'] = $vendorId;
            $validator = Item::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            $attributeData = [];
            $editedAttribute = [];
            $editedOption = [];
            $optionData = [];
            $optionOrderBy = 1;
            try {
                DB::beginTransaction();
                $request['available_from'] = !empty($request->available_from) ? DbDateFormat($request->available_from) : null;
                $request['available_to'] = !empty($request->available_to) ? DbDateFormat($request->available_to) : null;
                $request['discount_from'] = !empty($request->discount_from) ? DbDateFormat($request->discount_from) : null;
                $request['discount_to'] = !empty($request->discount_to) ? DbDateFormat($request->discount_to) : null;
                if ((new Item)->updateItem($request->only('item_code', 'name', 'description', 'summary', 'video_url', 'review_count', 'review_average',
                    'available_from', 'available_to', 'vendor_id', 'brand_id', 'status', 'is_virtual', 'is_shippable', 'is_shareable',
                    'favourite_count', 'wish_count', 'price', 'discount_amount', 'discount_type', 'discounted_price', 'discount_from', 'discount_to',
                    'maximum_discount_amount', 'minimum_order_for_discount', 'sku', 'is_inventory_enabled', 'item_quantity', 'stock_availability'), $id)) {
                    $oldItemCategory = ItemCategory::getAll()->where('item_id',$id)->first();
                    if ($oldItemCategory->category_id != $request->category_id) {
                        (new ItemCategory)->updateItemCategory(['category_id' => $request->category_id], $id);
                    }

                    // item other
                    $itemDetail['shipping_id'] = $request->shipping_id ?? null;
                    $itemDetail['tax_id'] = $request->tax_id;
                    $itemDetail['warranty_type'] = $request->warranty_type;
                    $itemDetail['warranty_period'] = $request->warranty_period;
                    $itemDetail['warranty_policy'] = $request->warranty_policy;
                    $itemDetail['is_track_inventory'] = isset($request->is_track_inventory) && $request->is_track_inventory == 'on' ? 1 : 0;
                    $itemDetail['is_discount'] = isset($request->is_discount) && $request->is_discount == 'on' ? 1 : 0;
                    $itemDetail['is_featured'] = isset($request->is_featured) && $request->is_featured == 'on' ? 1 : 0;
                    $itemDetail['is_cash_on_delivery'] = isset($request->is_cash_on_delivery) && $request->is_cash_on_delivery == 'on' ? 1 : 0;
                    $itemDetail['is_hide_stock'] = isset($request->is_hide_stock) && $request->is_hide_stock == 'on' ? 1 : 0;
                    (new ItemDetail)->updateItemDetail($itemDetail, $id);
                    //end item other

                    $oldItemAttribute = ItemAttribute::getAll()->where('item_id', $id)->pluck('attribute_id')->toArray();
                    $oldItemOption = ItemOption::getAll()->where('item_id',$id)->pluck('id')->toArray();
                    if (isset($request->attribute_data)) {
                        foreach ($request->attribute_data as $key => $attribute) {
                            if (!empty($attribute)) {
                                if (in_array($key , $oldItemAttribute)) {
                                    (new ItemAttribute)->updateItemAttribute([
                                        'payloads' => is_array($attribute) ? json_encode($attribute) : $attribute
                                    ], $key, $id);
                                    $editedAttribute[] = $key;
                                } else {
                                    (new ItemAttribute)->store([
                                        'item_id' => $id,
                                        'attribute_id' => $key,
                                        'payloads' => is_array($attribute) ? json_encode($attribute) : $attribute
                                    ]);
                                }
                            }
                        }
                        foreach ($oldItemAttribute as $oldAtt) {
                            if (!in_array($oldAtt, $editedAttribute)) {
                                (new ItemAttribute)->remove($oldAtt, $id);
                            }
                        }
                    } else {
                        foreach ($oldItemAttribute as $oldAtt) {
                            (new ItemAttribute)->remove($oldAtt, $id);
                        }
                    }
                    if (isset($request->option_data)) {
                        foreach ($request->option_data as $key => $option) {
                            $labelData = [];
                            $optionPriceData = [];
                            $optionPriceTypeData = [];
                            $optionValueOrderBy = 1;
                            $inventoryIds = [];
                            $newInventoryIds = [];
                            $optionStatus = [];
                            foreach ($option['label'] as $label) {
                                $labelData[] = $label;
                            }
                            foreach ($option['option_price'] as $priceKey => $option_price) {
                                $optionPriceData[] = [
                                    'order_by' => $optionValueOrderBy++,
                                    'option_price' => validateNumbers($option_price)
                                ];
                                $itemOptionId = isset($option['item_option_id']) ? $option['item_option_id'] : null;
                                //inventory
                                $inventoryDetails = Inventory::where('item_option_id', $itemOptionId)->where('label', $labelData[$priceKey] ?? null)->first();
                                if (!empty($inventoryDetails)) {
                                    $inventoryIds[] = $inventoryDetails->id;
                                    (new Inventory)->updateInventory(['vendor_id' => $request->vendor_id ?? null, 'quantity' => isset($option['option_qty'][$priceKey]) && $option['option_qty'][$priceKey] > 0 ? $option['option_qty'][$priceKey] : 0], $inventoryDetails->id);
                                } else {
                                    $inventory = [
                                        'label' => $labelData[$priceKey] ?? null,
                                        'vendor_id' => $request->vendor_id ?? null,
                                        'quantity' => isset($option['option_qty'][$priceKey]) && $option['option_qty'][$priceKey] > 0 ? $option['option_qty'][$priceKey] : 0
                                    ];
                                    $lastInsertInventoryId = (new Inventory)->store($inventory);
                                    if (!empty($itemOptionId)) {
                                        (new Inventory)->updateInventory(['item_option_id' => $itemOptionId], $lastInsertInventoryId);
                                    }
                                    $inventoryIds[] = $lastInsertInventoryId;
                                    $newInventoryIds[] = $lastInsertInventoryId;
                                }
                                $inventoryLabelCheck = Inventory::where('item_option_id', $itemOptionId)->pluck('label')->toArray();
                                foreach ($inventoryLabelCheck as $lbChk) {
                                    if (!in_array($lbChk, $labelData)) {
                                        (new Inventory)->removeLabel($itemOptionId, $lbChk);
                                    }
                                }
                                //end inventory
                            }
                            foreach ($option['option_price_type'] as $option_price_type) {
                                $optionPriceTypeData[] = $option_price_type;
                            }

                            foreach ($option['option_status'] as $opStatus) {
                                $optionStatus[] = $opStatus;
                            }

                            $payloads = [
                                'label' => $labelData,
                                'option_price'  => $optionPriceData,
                                'option_price_type' => $optionPriceTypeData,
                                'inventory_id' => $inventoryIds,
                                'option_status' => $optionStatus
                            ];
                            if (isset($option['item_option_id']) && in_array($option['item_option_id'] , $oldItemOption)) {
                                (new ItemOption)->updateItemOption([
                                    'name' => $option['option_name'],
                                    'type' => $option['type'],
                                    'order_by' => $optionOrderBy++,
                                    'is_required' => $option['is_required'],
                                    'payloads' => json_encode($payloads),
                                ], $option['item_option_id']);
                                $editedOption[] = $option['item_option_id'];
                            } else {
                                $lastOptionId = (new ItemOption)->store([
                                    'item_id' => $id,
                                    'name' => $option['option_name'],
                                    'type' => $option['type'],
                                    'order_by' => $optionOrderBy++,
                                    'is_required' => $option['is_required'],
                                    'payloads' => json_encode($payloads),
                                ]);
                                //update new inventory id
                                foreach ($newInventoryIds as $newId) {
                                    (new Inventory)->updateInventory(['item_option_id' => $lastOptionId], $newId);
                                }
                            }
                        }
                        foreach ($oldItemOption as $oldOp) {
                            if (!in_array($oldOp, $editedOption)) {
                                (new ItemOption)->remove($oldOp);
                                // delete inventory
                                (new Inventory)->remove($oldOp);
                            }
                        }
                    } else {
                        foreach ($oldItemOption as $oldOp) {
                            (new ItemOption)->remove($oldOp);
                            // delete inventory
                            (new Inventory)->remove($oldOp);
                        }
                    }


                }
                //tag
                $itemTag = ItemTag::where('item_id', $id)->pluck('tag_id');
                $insertItemTags = [];
                $removeCheckTagId = [];
                if (isset($request->tags) && !empty($request->tags)) {
                    foreach ($request->tags as $tag) {
                        $tagExists = Tag::getAll()->where('name', $tag)->where('status', "Active")->first();
                        if (!empty($tagExists)) {
                            $existsItemTag = ItemTag::where('tag_id', $tagExists->id)->where('item_id', $id)->first();
                            isset($existsItemTag->tag_id) ? $removeCheckTagId[] = $existsItemTag->tag_id : '';
                            if (empty($existsItemTag)) {
                                $insertItemTags[] = [
                                    "item_id" => $id,
                                    "tag_id" => $tagExists->id
                                ];
                            }
                        }
                        else {
                            if (!empty($tag)) {
                                $insertTag = [
                                    "name" => $tag,
                                    "vendor_id" => $request->vendor_id,
                                ];
                                $tagId = (new Tag)->store($insertTag);
                                $insertItemTags[] = [
                                    "item_id" => $id,
                                    "tag_id" => $tagId
                                ];
                            }
                        }
                    }
                    $dupTagId = [];
                    foreach ($insertItemTags as $key => $itTag) {
                        if (!in_array($itTag['tag_id'], $dupTagId)) {
                            $dupTagId[] =  $itTag['tag_id'];
                        } else {
                            unset($insertItemTags[$key]);
                        }
                    }
                }
                if (!empty($itemTag)) {
                    foreach ($itemTag as $delTag) {
                        if (in_array($delTag, $removeCheckTagId)) {
                            continue;
                        } else {
                            (new ItemTag)->remove($id, $delTag);
                        }
                    }
                }
                (new ItemTag)->store($insertItemTags);
                //end tag
                DB::commit();
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Item')]));
            } catch (Exception $e) {
                DB::rollBack();
                $this->unprocessableResponse($e->getMessage());
            }
        } else {
            return $this->unprocessableResponse(__(':x does not exist.', ['x' => __('Item')]));
        }
    }

    /**
     * Remove the specified Item from db.
     * @param Request $request
     * @return json $data
     */
    public function destroy(Request $request, $id)
    {
        $vendorId = isset(auth()->user()->vendorUser->vendor_id) ? auth()->user()->vendorUser->vendor_id : null;
        $item = Item::where('id', $id)->where('vendor_id', $vendorId);
        if ($item->exists()) {
            $result = (new Item)->remove($id);
            return $this->okResponse([], $result['message']);
        }
        return $this->unprocessableResponse(__(':x does not exist.', ['x' => __('Item')]));
    }
}
