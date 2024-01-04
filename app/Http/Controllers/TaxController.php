<?php
/**
 * @package TaxController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 23-09-2021
 */
namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Tax List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['list_menu']         = 'tax';
        $data['taxes']      = Tax::getAll();

        return view('admin.tax.index', $data);
    }

    /**
     * Tax Store
     * @param Request $request
     */
    public function store(Request $request)
    {
        $response             = [];
        $response = $this->messageArray(__('Something went wrong, please try again.'),'fail');
        $validator = Tax::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ((new Tax)->store($request->only('name','tax_rate','is_default'))) {
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Tax')]),'success');
        }
        $this->setSessionValue($response);
        return redirect()->back();
    }

    /**
     * Tax edit
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $result = [];
        if (isset($request->id) && !empty($request->id)) {
            $taxData = Tax::getAll()->where('id', $request->id)->first();
            $result['name']          = $taxData->name;
            $result['tax_rate'] = $taxData->tax_rate;
            $result['id']            = $taxData->id;
            $result['is_default'] = $taxData->is_default;
        }
        echo json_encode($result);
    }

    /**
     * Tax Update
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $response             = [];
        $response = $this->messageArray(__('Something went wrong, please try again.'),'fail');
        $validator = Tax::updateValidation($request->all(), $request->tax_id);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ((new Tax)->taxUpdate($request->only('name','tax_rate','is_default'), $request->tax_id)) {
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Tax')]),'success');
        } else {
            $response = $this->messageArray(__('No changes found.'),'success');
        }
        $this->setSessionValue($response);
        return redirect()->back();
    }

    /**
     * Remove Tax
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->checkExistance($id, 'taxes');
        if ($result['status'] === true) {
            $response = (new Tax)->remove($id);
        } else {
            $response['message'] = $result['message'];
        }

        $this->setSessionValue($response);
        return redirect()->route('tax.index');
    }
}
