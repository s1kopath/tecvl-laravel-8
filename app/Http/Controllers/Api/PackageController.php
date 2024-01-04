<?php
/**
 * @package PackageController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 04-09-2021
 * @modified 07-09-2021
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    PackageResource,
    PackageDetailResource
};
use App\Models\{
    Package,
};
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Package List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $data = [];
        $configs = $this->initialize([], $request->all());
        $package = Package::select('packages.*');

        $name = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $package->where('name', strtolower($name));
        }

        $code = isset($request->code) ? $request->code : null;
        if (!empty($code)) {
            $package->where('code', strtolower($code));
        }

        $description = isset($request->description) ? trim(xss_clean($request->description)) : null;
        if (!empty($description)) {
            $package->where('description', strtolower($description));
        }

        $params = isset($request->params) ? $request->params : null;
        if (!empty($params)) {
            $package->where('params', strtolower($params));
        }

        $price = isset($request->price) ? $request->price : null;
        if (!empty($price)) {
            $package->where('price', $price);
        }

        $billing_cycle = isset($request->billing_cycle) ? $request->billing_cycle : null;
        if (!empty($billing_cycle)) {
            $package->where('billing_cycle', strtolower($billing_cycle));
        }

        $sort_order = isset($request->sort_order) ? $request->sort_order : null;
        if (!empty($sort_order)) {
            $package->where('sort_order', $sort_order);
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $package->where('id', $keyword)
                        ->orwhere('price', 'LIKE', '%' . $keyword . '%');
            } else if (strlen($keyword) >= 2) {
                $package->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('code', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('price', 'LIKE', '%' . $keyword . '%');
                });
            }
        }
        return $this->response([
            'data' => PackageResource::collection($package->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($package->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Store Package
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
            $request['billing_cycle'] = strtolower($request->billing_cycle);
        }
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'inactive' => 'inactive', 'active' => 'active'])) {
            $request['status'] = strtolower($request->status);
        }
        $validator =  Package::storeValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        if ((new Package)->store($request->all())) {
            return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Package')]));
        }
        return $this->errorResponse();
    }

    /**
     * Detail Package
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response = $this->checkExistance($id, 'packages');
        $packageData = Package::getAll()->where('id', $id)->first();
        if ($response['status'] === true && !empty($packageData)) {
            return $this->response(['data' => new PackageDetailResource($packageData)]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Update Package Information
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $response = $this->checkExistance($id, 'packages');
        if ($response['status'] === true) {
            if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
                $request['billing_cycle'] = strtolower($request->billing_cycle);
            }
            if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'inactive' => 'inactive', 'active' => 'active'])) {
                $request['status'] = strtolower($request->status);
            }
            $validator = Package::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            if ((new Package)->updatePackage($request->all(), $id)) {
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Package')]));
            } else {
                return $this->okResponse([], __('No changes found.'));
            }
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Remove the specified Package from db.
     * @param Request $id
     * @return json $data
     */
    public function destroy($id)
    {
        $response = $this->checkExistance($id, 'packages');
        if ($response['status'] === true) {
            $result  = (new Package)->remove($id);
            return $this->okResponse([], $result['message']);
        }
        return $this->response([], 204, $response['message']);
    }
}
