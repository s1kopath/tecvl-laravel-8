<?php
/**
 * @package TaxController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 23-09-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxDetailResource;
use App\Http\Resources\TaxResource;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Tax List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs        = $this->initialize([], $request->all());
        $taxes       = Tax::select('id', 'name', 'tax_rate', 'is_default');
        $name           = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $taxes->where('name', strtolower($name));
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $taxes->where(function ($query) use ($keyword) {
                    $query->where('id', $keyword)
                        ->orwhere('tax_rate', $keyword);
                });
            } else if (strlen($keyword) >= 2) {
                $taxes->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('tax_rate', 'LIKE', '%' . $keyword . '%');
                });
            }
        }

        return $this->response([
            'data' => TaxResource::collection($taxes->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($taxes->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);

    }

    /**
     * Store tax
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        $validator = Tax::storeValidation($request->all());

        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }

        if ((new Tax)->store($request->only('name','tax_rate','is_default'))) {
            return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Tax')]));
        }

        return $this->errorResponse();
    }

    /**
     * Detail Tax
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response = $this->checkExistance($id, 'taxes');

        if ($response['status']) {
            return $this->response([
                'data' => new TaxDetailResource(Tax::getAll()->where('id', $id)->first())
            ]);
        }

        return $this->response([], 204, $response['message']);
    }

    /**
     * Update Tax Information
     * @param Request $request
     * @return json $data
     */
    public function update(Request $request, $id)
    {
        $response = $this->checkExistance($id, 'taxes');

        if ($response['status']) {

            $validator = Tax::updateValidation($request->all(), $id);

            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }

            $request['tax_rate'] = validateNumbers($request->tax_rate);

            if ((new Tax())->taxUpdate($request->all('name','tax_rate','is_default'), $id)) {
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Tax')]));
            }

            return $this->okResponse([], __('No changes found.'));

        }

        return $this->response([], 204, $response['message']);
    }
}
