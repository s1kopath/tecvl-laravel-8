<?php

/**
 * @package RefundProcessController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 25-05-2022
 */
namespace Modules\Refund\Http\Controllers\Vendor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Refund\Entities\{
    RefundProcess
};
use Modules\Refund\Http\Requests\RefundProcessRequest;

class RefundProcessController extends Controller
{
    /**
     * order refund process
     * @param Request $request
     * @return view|\Illuminate\Routing\Redirector
     */
    public function process(RefundProcessRequest $request)
    {
        $this->setSessionValue((new RefundProcess)->store($request->validated()));
        return redirect()->back();
    }
}
