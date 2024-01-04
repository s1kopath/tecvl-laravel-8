<?php
/**
 * @package ItemController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 19-12-2021
 */

namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorItemDataTable;
use App\Exports\VendorItemListExport;
use App\Http\Controllers\Controller;
use App\Models\{AttributeValue,
    Brand,
    Category,
    CategoryAttribute,
    CategoryOptionGroup,
    File,
    Inventory,
    Item,
    ItemCategory,
    ItemCrossSale,
    ItemDetail,
    ItemRelate,
    ItemUpsale,
    Option,
    OptionGroup,
    Tax,
    User,
    Vendor,
    Attribute,
    ItemAttribute,
    ItemOption,
    ItemTag,
    Tag};
use Excel, Str, DB;
use Illuminate\Http\Request;
use Modules\Shipping\Entities\Shipping;
use Modules\Shop\Http\Models\Shop;

class ItemController extends Controller
{
    /**
     * Item List
     * @param ItemListDataTable $dataTable
     * @return mixed
     */
    public function index(VendorItemDataTable $dataTable)
    {
        $data['itemBrands'] = Item::select('brand_id')->distinct()->with('brand:id,name')->get();
        $data['itemCategories'] = ItemCategory::select('category_id')->distinct()->with('category:id,name')->get();
        return $dataTable->render('vendor.item.index', $data);
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        if (Item::where('vendor_id', session()->get('vendorId'))->where('id', $id)->count() == 0) {
            return back()->withErrors(__('Something went wrong, please try again.'));
        }
        $this->setSessionValue((new Item)->remove($id));
        return redirect()->route('vendor.items');
    }

    /**
     * Item list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['items'] = Item::select('id', 'name', 'item_code', 'sku', 'price', 'status', 'vendor_id', 'brand_id')->where('status', 'Active')->where('vendor_id', session()->get('vendorId'))->with(['vendor:id,name', 'brand:id,name', 'itemCategory'])->get();
        return printPDF(
            $data,
            'item_list' . time() . '.pdf',
            'vendor.item.pdf',
            view('vendor.item.pdf', $data),
            'pdf',
            'domPdf'
        );
    }

    /**
     * Item list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new VendorItemListExport(), 'item_lists' . time() . '.csv');
    }

    /**
     * Import Item
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        if ($request->isMethod('get')) {
            $data = [];
            $data['brands'] = Brand::getAll();
            $data['categories'] = Category::getAll();
            $data['attributes'] = Attribute::select('id', 'name')->has('categoryAttribute')->with('categoryAttribute')->get();

            $data['shops'] = [];
            if (isActive('Shop')) {
                $data['shops'] = \Modules\Shop\Http\Models\Shop::select('id', 'name', 'vendor_id')->with('vendor:id,name')->get();
            }

            return view('vendor.item.import', $data);
        } else if ($request->isMethod('post')) {
            $data = ['status' => 'fail', 'message' => __('Invalid Request')];

            $validator =  User::importValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('file')) {
                $path = $request->file('file')->getRealPath();
                $csv = [];

                if (is_uploaded_file($path)) {
                    $csv = readCSVFile($path, true);
                }
                if (empty($csv)) {
                    return back()->withErrors(__("Your CSV has no data to import"));
                }

                $requiredHeader  = array('name', 'sku', 'description', 'summary', 'video_url', 'available_from', 'available_to', 'shop_id', 'brand_id', 'category_id', 'tags', 'files_url', 'status', 'is_virtual', 'is_shippable', 'is_shareable', 'price', 'discount_amount', 'discount_type', 'discounted_price', 'discount_from', 'discount_to', 'maximum_discount_amount', 'minimum_order_for_discount', 'is_inventory_enabled', 'item_quantity', 'attribute', 'option');
                $header = array_keys($csv[0]);
                if (!empty(array_diff($requiredHeader, $header))) {
                    return back()->withErrors( __("Please Check CSV Header Name."));
                }

                $errorMessages = [];
                $lastItemId = null;
                $optionData = [];
                $optionOrderBy = 1;
                foreach ($csv as $key => $value) {

                    $errorFails = [];

                    $value = array_map('trim', $value);
                    $value['is_virtual'] = strtolower($value['is_virtual']) == 'yes' ? 1 : 0;
                    $value['is_shippable'] = strtolower($value['is_shippable']) == 'yes' ? 1 : 0;
                    $value['is_shareable'] = strtolower($value['is_shareable']) == 'yes' ? 1 : 0;
                    $value['is_inventory_enabled'] = strtolower($value['is_inventory_enabled']) == 'yes' ? 1 : 0;
                    $value['available_from'] = !empty($value['available_from']) ? DbDateFormat($value['available_from']) : null;
                    $value['available_to'] = !empty($value['available_to']) ? DbDateFormat($value['available_to']) : null;
                    $value['discount_from'] = !empty($value['discount_from']) ? DbDateFormat($value['discount_from']) : null;
                    $value['discount_to'] = !empty($value['discount_to']) ? DbDateFormat($value['discount_to']) : null;
                    $value['item_code'] = Str::random(12);
                    $value['vendor_id'] = Vendor::shopToVendor($value['shop_id']);
                    $validator =  Item::importValidation(array_intersect_key($value, array_flip((array) $requiredHeader)));
                    if ($validator->fails()) {
                        $errorFails = array_merge($errorFails, $validator->errors()->all());
                    }

                    if (!empty($value['tags']) && is_null(json_decode($value['tags']))) {
                        $errorFails[] = __('The :x format is invalid.', ['x' => __('Tags')]);
                    }
                    if (!empty($value['attribute']) && is_null(json_decode($value['attribute']))) {
                        $errorFails[] = __('The :x format is invalid.', ['x' => __('Attribute')]);
                    }
                    if (!empty($value['option']) && is_null(json_decode($value['option']))) {
                        $errorFails[] = __('The :x format is invalid.', ['x' => __('Option')]);
                    }

                    if (!is_null(json_decode($value['attribute']))) {
                        $attr = (array) json_decode($value['attribute']);
                        $attrData = Attribute::whereIn('id', array_flip($attr));
                        $attrBeforeCount = $attrData->count();
                        $attrAfterCount = $attrData->where('category_id', $value['category_id'])->count();
                        if ($attrBeforeCount != $attrAfterCount) {
                            $errorFails[] = __('Attribute id and category id is mismatched.');
                        }
                    }

                    if (!is_null(json_decode($value['option']))) {
                        foreach (json_decode($value['option']) as $key => $option) {
                            if (empty($option->option_name)){
                                $errorFails[] = __(':x is required', ['x' => __('Option name')]);
                            }
                            if (empty($option->type)) {
                                $errorFails[] = __(':x is required', ['x' => __('Option type')]);
                            } else {
                                if (!in_array($option->type, ['field', 'textarea', 'dropdown', 'checkbox', 'checkbox_custom', 'radio', 'radio_custom', 'multiple_select', 'date', 'date_time', 'time'])) {
                                    $errorFails[] = __('Option type is invalid.');
                                }
                            }
                            if (!in_array($option->is_required, [0, 1])) {
                                $errorFails[] = __('Required field is either 0 or 1.');
                            }

                            foreach ($option->label as $key => $label) {
                                if (empty($label)) {
                                    $errorFails[] = __(':x is required', ['x' => __('Option label')]);
                                }
                            }

                            foreach ($option->option_price as $key => $price) {
                               if (!is_numeric($price)) {
                                $errorFails[] = __('Price must be a number.');
                               }
                            }

                            foreach ($option->option_price_type as $key => $type) {
                                if (!in_array($type, ['Fixed', 'Percent'])) {
                                    $errorFails[] = __('Price type is either fixed or percent.');
                                }
                            }
                        }
                    }

                    if (!is_null(json_decode($value['attribute']))) {
                        foreach (json_decode($value['attribute']) as $key => $attribute) {
                            if (empty($attribute)) {
                                $errorFails[] = __("Attribute id :x should not empty.", ['x' => $key]);
                            }
                        }
                    }

                    if (empty($errorFails)) {
                        try {
                            DB::beginTransaction();
                            $lastItemId = (new Item)->import(array_intersect_key($value, array_flip((array) ['name', 'item_code', 'sku', 'description', 'summary', 'video_url', 'available_from', 'available_to', 'shop_id', 'vendor_id', 'brand_id', 'status', 'is_virtual', 'is_shippable', 'is_shareable', 'price', 'discount_amount', 'discount_type', 'discount_price', 'discount_from', 'discount_to', 'maximum_discount_amount', 'minimum_order_for_discount', 'is_inventory_enabled', 'item_quantity'])), $value['files_url']);
                            if (!empty($lastItemId)) {
                                $itemCategory = [
                                    'item_id' => $lastItemId,
                                    'category_id' => $value['category_id'],
                                ];
                                (new ItemCategory)->store($itemCategory);

                                $tags = (array) json_decode($value['tags']);

                                $insertItemTags = [];
                                if (!empty($tags)) {
                                    foreach ($tags as $tag) {
                                        $tagExists = Tag::getAll()->where('name', $tag)->where('status', "Active")->first();
                                        if (!empty($tagExists)) {
                                            $existsItemTag = ItemTag::where('tag_id', $tagExists->id)->where('item_id', $lastItemId)->first();
                                            if (empty($existsItemTag)) {
                                                $insertItemTags[] = [
                                                    "item_id" => $lastItemId,
                                                    "tag_id" => $tagExists->id
                                                ];
                                            }
                                        }
                                        else {
                                            if (!empty($tag)) {
                                                $insertTag = [
                                                    "name" => $tag,
                                                    "vendor_id" => $value['vendor_id'],
                                                ];
                                                $tagId = (new Tag)->store($insertTag);
                                                $insertItemTags[] = [
                                                    "item_id" => $lastItemId,
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

                                $attributes = (array) json_decode($value['attribute']);
                                foreach ($attributes as $key => $attribute) {
                                    if (!empty($attribute)) {
                                        $attributeData[] = [
                                            'item_id' => $lastItemId,
                                            'attribute_id' => $key,
                                            'payloads' => json_decode($attribute) ? json_decode($attribute) : $attribute
                                        ];
                                    }
                                }
                                (new ItemAttribute())->store($attributeData);

                                $options = (array) json_decode($value['option']);

                                if (!empty($options)) {
                                    foreach ($options as $key => $option) {
                                        $labelData = [];
                                        $optionPriceData = [];
                                        $optionPriceTypeData = [];
                                        $optionValueOrderBy = 1;
                                        foreach ($option->label as $label) {
                                            $labelData[] = $label;
                                        }
                                        foreach ($option->option_price as $option_price) {
                                            $optionPriceData[] = [
                                                'order_by' => $optionValueOrderBy++,
                                                'option_price' => $option_price
                                            ];
                                        }
                                        foreach ($option->option_price_type as $option_price_type) {
                                            $optionPriceTypeData[] = $option_price_type;
                                        }

                                        $payloads = [
                                            'label' => $labelData,
                                            'option_price'  => $optionPriceData,
                                            'option_price_type' => $optionPriceTypeData
                                        ];
                                        $optionData[] = [
                                            'item_id' => $lastItemId,
                                            'name' => $option->option_name,
                                            'type' => $option->type,
                                            'order_by' => $optionOrderBy++,
                                            'is_required' => $option->is_required,
                                            'payloads' => json_encode($payloads),
                                        ];
                                    }
                                    (new ItemOption())->store($optionData);
                                }

                                DB::commit();
                            }
                        } catch (\Exception $e) {
                            DB::rollBack();
                            $errorFails[] = $e->getMessage();
                        }
                    }

                    // set the error messages
                    if (!empty($errorFails)) {
                        $errorMessages[$key] = ['fails' => $errorFails, 'data' => $value];
                    }
                }

                // redirect with success message if no error found.
                if (empty($errorMessages)) {
                    $this->setSessionValue(['status' => 'success', 'message' => __('Total Imported row: ') . count($csv)]);
                    return redirect()->route('vendor.items');
                } else {
                    $data['totalRow'] = count($csv);

                    return view('admin.layouts.includes.csv_import_errors', $data)->with('errorMessages', $errorMessages);
                }
            } else {
                return back()->withErrors(['fail' => __("Please upload a CSV file.")]);
            }
        }
    }

    /**
     * Item create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['brands'] = Brand::where('status', 'Active')->where('vendor_id', session()->get('vendorId'))->orWhere('vendor_id', null)->get();
        $data['categories'] = Category::getAll()->whereNull('parent_id')->where('status', 'Active');
        if (isActive('Shipping')) {
            $data['shippings'] = Shipping::getAll()->where('status', 'Active');
        }
        $data['taxes'] = Tax::getAll();
        return view('vendor.item.create', $data);
    }

    /**
     * item store
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $attributeData = [];
        $optionData = [];
        $optionOrderBy = 1;
        $request['vendor_id'] = session()->get('vendorId');
        $validator = Item::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
            if (isActive('Shop')) {
                $shopDetails = Shop::where('vendor_id', $request->vendor_id)->where('status', 'Active')->first();
                $request['shop_id'] = !empty($shopDetails) ? $shopDetails->id : null;
            }
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
                $itemDetail['is_discount'] = isset($request->is_discount) && $request->is_discount == 'on' ? 1 : 0;
                $itemDetail['is_track_inventory'] = isset($request->is_track_inventory) && $request->is_track_inventory == 'on' ? 1 : 0;
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
                        $optionStatus = [];
                        $optionValueOrderBy = 1;
                        $inventory = [];
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
                $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Item')]), 'success');
            }

        } catch (Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        $this->setSessionValue($response);
        return redirect()->route('vendor.items');
    }

    /**
     * item edit
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $item = Item::where('id', $id)->where('vendor_id', session()->get('vendorId'))->first();
        if (empty($item)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Item')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('vendor.items');
        }

        $data['item'] = $item;
        $data['vendors'] = Vendor::getAll()->where('status', 'Active');
        $data['taxes'] = Tax::getAll();
        $data['itemAttribute'] = ItemAttribute::getAll()->where('item_id', $id)->pluck('payloads', 'attribute_id');
        $data['categoryAttributes'] = CategoryAttribute::select('attribute_id')->distinct()->where('category_id', optional($item->itemCategory)->category_id)->WhereHas('attribute', function ($query) {
            $query->where('status', 'Active');
        })->with('attribute')->get();
        $data['brands'] = Brand::where('status', 'Active')->where('vendor_id', session()->get('vendorId'))->orWhere('vendor_id', null)->get();
        if (isActive('Shipping')) {
            $data['shippings'] = Shipping::getAll()->where('status', 'Active');
        }
        $data['files'] = (new File)->getFiles('items', $id);
        if (!empty($data['files'])) {
            $data['filePath'] = "public/uploads/items";
            $data['filePathThumbnail'] = "public/uploads/items/thumbnail";
            foreach ($data['files'] as $key => $value) {
                $value->icon = getFileIcon($value->file_name);
                $explodes = explode("_", $value->file_name);
                $value->originalName = implode("_", array_slice($explodes, 1, count($explodes) - 1));
            }
        }
        //item tag
        $allTag = [];
        if (isset($item->itemTag)) {
            foreach ($item->itemTag as $tag) {
                $allTag[] = $tag->tag->name;
            }
        }
        $data['tags'] = $allTag;

        $category = Category::getAll()->where('id', optional($item->itemCategory)->category_id)->first();
        $parent[] = !empty($category) ?  $category->name : null;
        $parentId[] = !empty($category) ?  $category->id : null;
        while (1) {
            if (!empty($category->category)) {
                $category = $category->category;
                $parent[] = $category->name;
                $parentId[] = $category->id;
            } else {
                break;
            }
        }
        if (is_array($parent) && count($parent) > 0) {
            $parent = array_reverse($parent);
            $parentId = array_reverse($parentId);
            $parent = implode(" / ", $parent);
        }
        $data['parentCategory'] = $parent;
        $data['parentCategoryId'] = $parentId;
        $data['categories'] = Category::getAll()->whereNull('parent_id')->where('status', 'Active');

        return view('vendor.item.edit', $data);
    }

    /**
     * update
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $existsItem = Item::where('id', $id)->where('vendor_id', session()->get('vendorId'))->first();
        if (!empty($existsItem)) {
            $request['price'] = validateNumbers($request->price);
            $request['discounted_price'] = validateNumbers($request->discounted_price);
            $request['discount_amount'] = validateNumbers($request->discount_amount);
            $request['maximum_discount_amount'] = validateNumbers($request->maximum_discount_amount);
            $request['minimum_order_for_discount'] = validateNumbers($request->minimum_order_for_discount);
            $request['vendor_id'] = session()->get('vendorId');
            $validator = Item::updateValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
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
                if (isActive('Shop')) {
                    $shopDetails = Shop::where('vendor_id', $request->vendor_id)->where('status', 'Active')->first();
                    $request['shop_id'] = !empty($shopDetails) ? $shopDetails->id : null;
                }
                if ((new Item)->updateItem($request->only('item_code', 'name', 'description', 'summary', 'video_url', 'review_count', 'review_average',
                    'available_from', 'available_to', 'vendor_id', 'shop_id', 'brand_id', 'status', 'is_virtual', 'is_shippable', 'is_shareable',
                    'favourite_count', 'wish_count', 'price', 'discount_amount', 'discount_type', 'discounted_price', 'discount_from', 'discount_to',
                    'maximum_discount_amount', 'minimum_order_for_discount', 'sku', 'is_inventory_enabled', 'item_quantity', 'stock_availability'), $id)) {
                    $oldItemCategory = ItemCategory::getAll()->where('item_id',$id)->first();
                    if (!empty($oldItemCategory)) {
                        if ($oldItemCategory->category_id != $request->category_id) {
                            (new ItemCategory)->updateItemCategory(['category_id' => $request->category_id], $id);
                        }
                    } else {
                        (new ItemCategory)->store(['item_id' => $id, 'category_id' => $request->category_id]);
                    }

                    // item other
                    $itemDetail['shipping_id'] = $request->shipping_id ?? null;
                    $itemDetail['tax_id'] = $request->tax_id;
                    $itemDetail['warranty_type'] = $request->warranty_type;
                    $itemDetail['warranty_period'] = $request->warranty_period;
                    $itemDetail['warranty_policy'] = $request->warranty_policy;
                    $itemDetail['is_discount'] = isset($request->is_discount) && $request->is_discount == 'on' ? 1 : 0;
                    $itemDetail['is_track_inventory'] = isset($request->is_track_inventory) && $request->is_track_inventory == 'on' ? 1 : 0;
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
                $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Item')]), 'success');
            } catch (Exception $e) {
                DB::rollBack();
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['message'] = __(':x does not exist.', ['x' => __('Item')]);
        }
        $this->setSessionValue($response);
        return redirect()->route('vendor.items');
    }

    /**
     * Return Attribute & Attribute value
     *
     * @param Request $request
     * @return false|string
     */
    public function getAttribute(Request $request)
    {
        $categoryAttribute = CategoryAttribute::select('attribute_id')->distinct()->where('category_id', $request->category_id)->WhereHas('attribute', function ($query) {
            $query->where('status', 'Active');
        })->with('attribute')->get();
        $data = [];
        if (!empty($categoryAttribute)) {
            foreach ($categoryAttribute as $attribute) {
                $attributeValue = AttributeValue::getAll()->where('attribute_id', optional($attribute->attribute)->id)->sortBy('order_by');
                $data[] = [
                    'id' =>  optional($attribute->attribute)->id,
                    'name' => optional($attribute->attribute)->name,
                    'type' => optional($attribute->attribute)->type,
                    'is_required' => optional($attribute->attribute)->is_required,
                    'explain' => optional($attribute->attribute)->description,
                    'values' => $attributeValue
                ];
            }
        }
        return json_encode($data);
    }

    /**
     * get options based on category
     *
     * @param Request $request
     * @return false|string
     */
    public function getOption(Request $request)
    {
        $options = CategoryOptionGroup::select('option_group_id')->distinct()->where('category_id', $request->category_id)->with('optionGroup')->get();
        $data = [];
        if (!empty($options)) {
            foreach ($options as $option) {
                $optionValue = Option::getAll()->where('option_group_id', optional($option->optionGroup)->id);
                $data[] = [
                    'id' =>  optional($option->optionGroup)->id,
                    'name' => optional($option->optionGroup)->name,
                    'type' => optional($option->optionGroup)->type,
                    'is_required' => optional($option->optionGroup)->is_required,
                    'values' => $optionValue
                ];
            }
        }
        for ($i = 1; $i <= 2 ; $i++) {
            $optionGroup = OptionGroup::where('id', $i)->first();
            if (!empty($optionGroup)) {
                $optionValue = Option::getAll()->where('option_group_id', $i);
                $data[] = [
                    'id' =>  $optionGroup->id,
                    'name' => $optionGroup->name,
                    'type' => $optionGroup->type,
                    'is_required' => $optionGroup->is_required,
                    'values' => $optionValue
                ];
            }
        }
        return json_encode($data);
    }

    /**
     * return item option
     *
     * @param Request $request
     * @return false|string
     */
    public function getItemOption(Request $request)
    {
        $itemId = $request->item_id;
        $itemOption = ItemOption::where('item_id', $itemId)->orderBy('order_by', 'ASC')->get();
        $itemAllOption = [];
        foreach ($itemOption as $option) {
            $inventoryData = [];
            $payloads = json_decode($option->payloads);
            if (isset($payloads->inventory_id)) {
                foreach ($payloads->inventory_id as $id) {
                    $inventory = Inventory::where('id', $id)->first();
                    $inventoryData[$id] = $inventory->quantity;
                }
            }
            $itemAllOption[] = [
                'id' => $option->id,
                'item_id' => $option->item_id,
                'name' => $option->name,
                'type' => $option->type,
                'order_by' => $option->order_by,
                'payloads' => $option->payloads,
                'is_required' => $option->is_required,
                'inventory_data' => $inventoryData
            ];
        }
        return json_encode($itemAllOption);
    }

    /**
     * Item View
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $item = Item::where('id', $id)->first();
        if (empty($item)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Item')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('item.index');
        }
        $data['item'] = $item;
        $data['itemAttribute'] = ItemAttribute::getAll()->where('item_id', $id);
        $data['item_relate']  = ItemRelate::where('item_id', $id)->get();
        $data['item_cross']  = ItemCrossSale::where('item_id', $id)->get();
        $data['item_option']  = ItemOption::where('item_id', $id)->orderBy('order_by', 'ASC');
        $data['item_up']  = ItemUpsale::where('item_id', $id)->get();
        return view('vendor.item.view', $data);
    }

    /**
     * @param $type
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRelated($type, Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
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
            if(count($newItem) > 0) {
                $data = [
                    "item_id" => $request->item_id,
                    "related_item_id" => $itemIds,
                ];
                $validator = ItemRelate::storeValidation($data, $request->item_id);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                (new ItemRelate)->store($newItem);
            }
            foreach ($oldRelateItem as $old) {
                if (!in_array($old, $existValue)) {
                    (new ItemRelate)->remove($request->item_id, $old);
                }
            }
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Related Items')]), 'success');
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
            if(count($newItem) > 0) {
                $data = [
                    "item_id" => $request->item_id,
                    "related_item_id" => $itemIds,
                ];
                $validator = ItemCrossSale::storeValidation($data, $request->item_id);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                (new ItemCrossSale)->store($newItem);
            }
            foreach ($oldCrossItem as $old) {
                if (!in_array($old, $existValue)) {
                    (new ItemCrossSale)->remove($request->item_id, $old);
                }
            }
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Cross Sale')]), 'success');
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
            if(count($newItem) > 0) {
                $data = [
                    "item_id" => $request->item_id,
                    "related_item_id" => $itemIds,
                ];
                $validator = ItemUpsale::storeValidation($data, $request->item_id);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                (new ItemUpsale)->store($newItem);
            }
            foreach ($oldUpItem as $old) {
                if (!in_array($old, $existValue)) {
                    (new ItemUpsale)->remove($request->item_id, $old);
                }
            }
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Up Sale')]), 'success');
        }
        elseif ($type == "option") {
            // Uploading files
            (new ItemOption)->uploadImage();
            # endregion
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Option Image')]), 'success');
        } elseif ($type == 'inventory') {
            foreach ($request->inventory_ids as $key => $inventoryId) {
                (new Inventory)->updateInventory(['quantity' => $request['qty'][$key] ?? 0], $inventoryId);
            }
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Inventory')]), 'success');
        }
        $this->setSessionValue($response);
        return redirect()->route('vendor.item.view',$request->item_id);
    }

    /**
     * @param Request $request
     * @param $type
     * @return void
     */
    public function search(Request $request, $type)
    {
        if ($type == 'relate') {
            (new Item)->search($request->search, $request->item_id, $type, 'web', 'vendor');
        }
        if ($type == 'cross') {
            (new Item)->search($request->search, $request->item_id, $type, 'web', 'vendor');
        }
        if ($type == 'up') {
            (new Item)->search($request->search, $request->item_id, $type, 'web', 'vendor');
        }
    }

}
