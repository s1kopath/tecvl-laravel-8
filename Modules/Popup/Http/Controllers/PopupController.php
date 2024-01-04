<?php

/**
 * @package PopupController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 08-03-2022
 */
namespace Modules\Popup\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Popup\DataTables\PopupDataTable;
use Modules\Popup\Entities\Popup;
use Excel;
use Modules\Popup\Exports\PopupListExport;

class PopupController extends Controller
{
    /**
     * Popup List
     * @param PopupDataTable $dataTable
     * @return Renderable
     */
    public function index(PopupDataTable $dataTable)
    {
        return $dataTable->render('popup::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('popup::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator =  Popup::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $param = $request->except(['_token', 'name', 'type', 'show_time', 'page_link', 'start_date', 'end_date', 'login_enabled', 'status']);
        $request['param'] = json_encode($param);

        $request['start_date'] = DbDateFormat($request->start_date);
        $request['end_date'] = DbDateFormat($request->end_date);

        $this->setSessionValue((new Popup)->store($request->only('name', 'type', 'show_time', 'page_link', 'start_date', 'end_date', 'login_enabled', 'status', 'param')));
        return redirect()->route('popup.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['popup'] = Popup::where('id', $id)->first();
        $data['content'] = json_decode( $data['popup']->param);
        return view('popup::show', $data);
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $result = $this->checkExistance($id, 'popups', ['getData' => true]);
        $data['popup'] = Popup::find($id);
        if (!empty($data['popup'])) {
            $data['param'] = json_decode($data['popup']->param);
            return view('popup::edit', $data);
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
        $result = $this->checkExistance($id, 'popups');
        if ($result['status'] === true) {

            $validator =  Popup::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $param = $request->except(['_token', 'name', 'type', 'show_time', 'page_link', 'start_date', 'end_date', 'login_enabled', 'status']);
            $request['param'] = json_encode($param);

            $request['start_date'] = DbDateFormat($request->start_date);
            $request['end_date'] = DbDateFormat($request->end_date);

            $response = (new Popup)->updateData($request->only('name', 'type', 'show_time', 'page_link', 'start_date', 'end_date', 'login_enabled', 'status', 'param'), $id);
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('popup.index');
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $this->setSessionValue((new Popup)->remove($id));
        return redirect()->route('popup.index');
    }

    /**
     * Popup list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['popups'] = Popup::getAll();

        return printPDF($data, 'popup_list' . time() . '.pdf', 'popup::pdf', view('popup::pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Popup list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new PopupListExport(), 'popup_list' . time() . '.csv');
    }

}
