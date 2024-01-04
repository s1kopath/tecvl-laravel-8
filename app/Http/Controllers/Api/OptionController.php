<?php
/**
 * @package OptionController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 27-10-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OptionDetailResource;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Http\Request;
use DB;

class OptionController extends Controller
{
    /**
     * Option List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $option = OptionGroup::select('option_groups.*');
        $name = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $option->where('name', strtolower($name));
        }

        $category = isset($request->category) ? $request->category : null;
        if (!empty($category)) {
            $option->whereHas("category", function ($q) use ($category) {
                $q->where('name', strtolower($category));
            })->with('category');
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $option->where('id', $keyword);
            } else {
                if (strlen($keyword) >= 3) {
                    $option->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orwhereHas("category", function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', "%" . $keyword . "%");
                            })->with('category');
                    });
                }
            }
        }
        return $this->response([
            'data' => OptionResource::collection($option->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($option->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Store Option
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        $data = [];
        $labelChk = labelRequiredElement();
        $request['price_type'] = json_decode($request->price_type);
        $request['price'] = json_decode($request->price);
        $request['label'] = json_decode($request->label);
        $validator = OptionGroup::storeValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        try {
            DB::beginTransaction();
            $optionGroupId = (new OptionGroup)->store($request->only('name', 'type', 'category_id', 'is_required'));
            if (!empty($optionGroupId)) {
                $optionPrice = $request->price;
                if (isset($optionPrice) && count($optionPrice) > 0) {
                    foreach ($optionPrice as $key => $value) {
                        $data[] = [
                            'option_group_id' => $optionGroupId,
                            'option' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? $request->label[$key] : null,
                            'price' => validateNumbers($value),
                            'price_type' => $request->price_type[$key],
                            'order_by' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? ++$key : null
                        ];
                    }
                    (new Option)->store($data);
                }
                DB::commit();
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Option')]));
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->unprocessableResponse($e->getMessage());
        }
        return $this->errorResponse();
    }

    /**
     * Detail Option
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response = $this->checkExistance($id, 'option_groups');
        if ($response['status']) {
            return $this->response([
                'data' => new OptionDetailResource(OptionGroup::getAll()->where('id', $id)->first())
            ]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * get options based on category
     *
     * @param Request $request
     * @return false|string
     */
    public function getOption(Request $request)
    {
        $response = $this->checkExistance($request->category_id, 'option_groups');
        if ($response['status']) {
            $options = OptionGroup::getAll()->where('category_id', $request->category_id);
            $data = [];
            if (!empty($options)) {
                foreach ($options as $option) {
                    $optionValue = Option::getAll()->where('option_group_id', $option->id);
                    $data[] = [
                        'id' =>  $option->id,
                        'name' => $option->name,
                        'type' => $option->type,
                        'is_required' => $option->is_required,
                        'values' => $optionValue
                    ];
                }
            }
            return $this->response([
                'data' => $data,
            ]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Update Option Information
     * @param Request $request
     * @return json $data
     */
    public function update(Request $request, $id)
    {
        $response = $this->checkExistance($id, 'option_groups');
        if ($response['status']) {
            $request['price_type'] = json_decode($request->price_type);
            $request['price'] = json_decode($request->price);
            $request['label'] = json_decode($request->label);
            $request['value_id'] = Option::getAll()->where('option_group_id', $id)->where('status', 'Active')->pluck('id')->toArray();
            $validator = OptionGroup::updateValidation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            try {
                DB::beginTransaction();
                $labelChk = labelRequiredElement();
                if ((new OptionGroup)->updateOptionGroup($request->only('name', 'type', 'category_id', 'is_required'), $id)) {
                    $optionValueOld = Option::getAll()->where('option_group_id', $id)->where('status', 'Active')->pluck('id')->toArray();
                    $optionPrice = $request->price;
                    $optionId = $request->value_id;
                    $editedValue = [];
                    $orderBy = 1;
                    if (isset($optionPrice) && count($optionPrice) > 0) {
                        foreach ($optionPrice as $key => $value) {
                            if (isset($optionId[$key]) && in_array($optionId[$key], $optionValueOld)) {
                                (new Option)->updateOption([
                                    'option' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? $request->label[$key] : null,
                                    'price' => validateNumbers($value),
                                    'price_type' => $request->price_type[$key],
                                    'order_by' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? $orderBy++ : null
                                ], $optionId[$key]);
                                $editedValue[] = $optionId[$key];
                            } else {
                                (new Option)->store([
                                    'option_group_id' => $id,
                                    'option' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? $request->label[$key] : null,
                                    'price' => validateNumbers($value),
                                    'price_type' => $request->price_type[$key],
                                    'order_by' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) ? $orderBy++ : null
                                ]);
                            }
                        }
                        foreach ($optionValueOld as $old) {
                            if (!in_array($old, $editedValue)) {
                                (new Option)->remove($old);
                            }
                        }
                    }
                    DB::commit();
                    return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Option')]));
                }


            } catch (Exception $e) {
                DB::rollBack();
                $this->unprocessableResponse($e->getMessage());
            }
            return $this->okResponse([], __('No changes found.'));
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Remove the specified Option from db.
     * @param Request $request
     * @return json $data
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->checkExistance($id, 'option_groups');
        if ($response['status']) {
            $result = (new OptionGroup)->remove($id);
            return $this->okResponse([], $result['message']);
        }
        return $this->response([], 204, $response['message']);
    }
}
