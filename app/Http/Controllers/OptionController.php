<?php
/**
 * @package OptionController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 13-09-2021
 */
namespace App\Http\Controllers;

use App\DataTables\OptionDataTable;
use App\Exports\OptionGroupListExport;
use App\Models\{
    Category,
    CategoryOptionGroup,
    Option,
    OptionGroup,
    Vendor
};
use Illuminate\Http\Request;
use DB;
use Excel;

class OptionController extends Controller
{
    /**
     * list
     *
     * @param OptionDataTable $dataTable
     * @return mixed
     */
    public function index(OptionDataTable $dataTable)
    {
        return $dataTable->render('admin.option_group.index');
    }

    /**
     * create
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View1
     */
    public function create()
    {
        $data['vendors'] = Vendor::getAll();
        $data['categories'] = (new Category)->parents();

        return view('admin.option_group.create', $data);
    }

    /**
     * store
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $data = [];
        $labelChk = labelRequiredElement();
        $validator = OptionGroup::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
                foreach ($request->category_ids as $categoryId) {
                    (new CategoryOptionGroup)->store(['option_group_id' => $optionGroupId, 'category_id' => $categoryId]);
                }
                DB::commit();
                $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Option')]), 'success');
            }

        } catch (Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        $this->setSessionValue($response);
        return redirect()->route('option.index');
    }

    /**
     * edit
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $optionGroups = OptionGroup::getAll()->where('id', $id)->first();
        if (empty($optionGroups)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Options')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('option.index');
        }
        $data['allCategoryOptionGroups'] = CategoryOptionGroup::where('option_group_id', $id)->pluck('category_id')->toArray();
        $data['optionGroups'] = $optionGroups;
        $data['optionValues'] = Option::getAll()->where('option_group_id', $id)->where('status', 'Active')->sortBy('order_by');
        $data['categories'] = (new Category)->parents();

        return view('admin.option_group.edit', $data);
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
     * update
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $result = $this->checkExistance($id, 'option_groups');
        if ($result['status'] === true) {
            $validator = OptionGroup::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            try {
                DB::beginTransaction();
                $labelChk = labelRequiredElement();
                if (!in_array($id, [1, 2])) {
                   $isUpdate = (new OptionGroup)->updateOptionGroup($request->only('name', 'type', 'category_id', 'is_required'), $id);
                } else {
                    $isUpdate = (new OptionGroup)->updateOptionGroup($request->only('is_required'), $id);
                }
                if ($isUpdate == true) {
                    $optionValueOld = Option::getAll()->where('option_group_id', $id)->where('status', 'Active')->pluck('id')->toArray();
                    $categoryOptionGroup = CategoryOptionGroup::where('option_group_id', $id)->pluck('category_id')->toArray();
                    $deletedCategory = array_diff($categoryOptionGroup, $request->category_ids ?? []);
                    $optionPrice = $request->price;
                    $optionId = $request->value_id;
                    $editedValue = [];
                    $orderBy = 1;
                    if (isset($optionPrice) && count($optionPrice) > 0) {
                        foreach ($optionPrice as $key => $value) {
                            if (isset($optionId[$key]) && in_array($optionId[$key], $optionValueOld)) {
                                (new Option)->updateOption([
                                    'option' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) || in_array($id, [1, 2]) ? $request->label[$key] : null,
                                    'price' => validateNumbers($value),
                                    'price_type' => $request->price_type[$key],
                                    'order_by' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) || in_array($id, [1, 2]) ? $orderBy++ : null
                                ], $optionId[$key]);
                                $editedValue[] = $optionId[$key];
                            } else {
                                (new Option)->store([
                                    'option_group_id' => $id,
                                    'option' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) || in_array($id, [1, 2]) ? $request->label[$key] : null,
                                    'price' => validateNumbers($value),
                                    'price_type' => $request->price_type[$key],
                                    'order_by' => isset($request->label[$key]) && !empty($request->label[$key]) && in_array($request->type, $labelChk) || in_array($id, [1, 2]) ? $orderBy++ : null
                                ]);
                            }
                        }
                        foreach ($optionValueOld as $old) {
                            if (!in_array($old, $editedValue)) {
                                (new Option)->remove($old);
                            }
                        }
                    }
                    if (!in_array($id, [1, 2])) {
                        foreach ($request->category_ids as $categoryId) {
                            if (is_array($categoryOptionGroup) && !in_array($categoryId, $categoryOptionGroup)) {
                                (new CategoryOptionGroup)->store(['option_group_id' => $id, 'category_id' => $categoryId]);
                            }
                        }
                        foreach ($deletedCategory as $cat) {
                            (new CategoryOptionGroup)->remove($id, $cat);
                        }
                    }
                    DB::commit();
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Option')]), 'success');
                }
            } catch (Exception $e) {
                DB::rollBack();
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['message'] = $result['message'];
        }
        $this->setSessionValue($response);
        return redirect()->route('option.index');
    }

    /**
     * delete
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $result = $this->checkExistance($id, 'option_groups');
        if ($result['status'] === true) {
            $response = (new OptionGroup)->remove($id);
        } else {
            $response['message'] = $result['message'];
        }

        $this->setSessionValue($response);
        return redirect()->route('option.index');
    }

    /**
     * Option list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['optionGroups'] = OptionGroup::getAll();

        return printPDF(
            $data,
            'option_group' . time() . '.pdf',
            'admin.option_group.list_pdf',
            view('admin.option_group.list_pdf', $data),
            'pdf',
            'domPdf'
        );
    }

    /**
     * Option list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new OptionGroupListExport(), 'option_group_lists' . time() . '.csv');
    }
}
