<?php

/**
 * @package VendorRefundController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 27-02-2022
 */
namespace Modules\Refund\Http\Controllers\Vendor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    Controller,
    EmailController
};
use App\Models\{
    EmailTemplate,
    Language,
    User
};
use App\Services\Mail\Refund as MailRefund;
use Modules\Refund\DataTables\VendorRefundDataTable;
use Modules\Refund\Entities\{
    Refund,
    RefundProcess,
};
use Excel;
use Modules\Refund\Exports\VendorRefundListExport;

class RefundController extends Controller
{

    /**
     * Constructor
     * @param EmailController $email
     */
    public function __construct(EmailController $email)
    {
        $this->email = $email;
    }

    /**
     * Refund List
     * @param RefundDataTable $dataTable
     * @return Renderable
     */
    public function index(VendorRefundDataTable $dataTable)
    {
        return $dataTable->render('refund::vendor.index');
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $result = $this->checkExistance($id, 'refunds');
        if ($result['status'] == true) {
            $data['refund'] = Refund::where('id', $id)->with(['user', 'orderDetail', 'refundReason'])->first();
            $data['refundProcesses'] = RefundProcess::where(['refund_id' => $id])->orderByDesc('id')->with(['user'])->get();
            return view('refund::vendor.edit', $data);
        }

        $this->setSessionValue(['status' => 'fail', 'message' => $result['message']]);
        return back();
    }

    /**
     * Update
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $result = $this->checkExistance($request->id, 'refunds');
        if ($result['status'] === true) {
            $validator =  Refund::updateValidation($request->all(), $request->id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $response = (new Refund)->updateData($request->all(), $request->id);
            if ($response['status'] == 'success' && $request->status != 'Opened') {
                (new MailRefund)->send($request);
            }
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('vendor.refund.index');
    }

    /**
     * Shop list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['refunds'] = Refund::whereHas('orderDetail', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor()->vendor->id);
        })->with('refundReason', 'orderDetail')->get();
        return printPDF($data, 'refund_list' . time() . '.pdf', 'refund::vendor.pdf', view('refund::vendor.pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Shop list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new VendorRefundListExport, 'refund_list' . time() . '.csv');
    }

}
