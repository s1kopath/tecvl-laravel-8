<?php

/**
 * @package ShippingController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 15-12-2021
 */

namespace Modules\Shipping\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Shipping\DataTables\ShippingDataTable;
use Modules\Shipping\Entities\Shipping;

class ShippingController extends Controller
{
    /**
     * Shipping List
     * @param ShippingDataTable $dataTable
     * @return Renderable
     */
    public function index(ShippingDataTable $dataTable)
    {
        return $dataTable->render('shipping::index');
    }

    /**
     * Create.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('shipping::create');
    }

    /**
     * Store
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator =  Shipping::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $this->setSessionValue((new Shipping)->store($request->all()));
        return redirect()->route('shipping.index');
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $result = $this->checkExistance($id, 'shippings', ['getData' => true]);
        if ($result['status'] == true) {
            $data['shipping'] = $result['data'];
            return view('shipping::edit', $data);
        }

        $this->setSessionValue(['status' => 'fail', 'message' => $result['message']]);
        return back();
    }

    /**
     * Update
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $result = $this->checkExistance($id, 'shippings');
        if ($result['status'] === true) {

            $validator =  Shipping::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $response = (new Shipping)->updateData($request->all(), $id);

        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('shipping.index');
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $this->setSessionValue((new Shipping)->remove($id));
        return redirect()->route('shipping.index');
    }
}
