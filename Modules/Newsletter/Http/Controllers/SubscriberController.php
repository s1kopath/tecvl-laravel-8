<?php

namespace Modules\Newsletter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Models\EmailTemplate;
use App\Models\Language;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Newsletter\DataTables\SubscriberDataTable;
use Modules\Newsletter\Entities\Subscriber;
use Modules\Newsletter\Http\Requests\StoreSubscriberRequest;
use Modules\Newsletter\Http\Requests\UpdateSubscriberRequest;
use Modules\Newsletter\Exports\SubscriberListExport;

class SubscriberController extends Controller
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
     * Subscribe List
     * @param SubscriberDataTable $dataTable
     * @return Renderable
     */
    public function index(SubscriberDataTable $dataTable)
    {
        return $dataTable->render('newsletter::subscriber.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreSubscriberRequest $request)
    {
        $response = (new Subscriber)->store($request->validated());
        if ($response['status'] == 'success') {
            $prefer = preference();
            $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;
            // Retrive welcome user email template
            $parent = EmailTemplate::getAll()->where('slug', 'subscriber')->where('language_id', $languageId)->first();
            $parentId = EmailTemplate::getAll()->where('slug', 'subscriber')->first()->id;

            $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parentId)->where('language_id', $languageId)->first();
            $subject =  $emailInfo->subject;
            $message =  $emailInfo->body;

            // Replacing template variable
            // Need to change assigned by whom value with auth user
            $subject = str_replace('{company_name}', $prefer['company_name'], $subject);
            $message = str_replace('{email}', $request->email, $message);
            $message = str_replace('{company_url}', url('/'), $message);
            $message = str_replace('{company_name}', $prefer['company_name'], $message);
            // Send Mail to the customer
            $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = $this->checkExistance($id, 'subscribers', ['getData' => true]);
        if ($result['status'] == true) {
            $data['subscriber'] = $result['data'];
            return view('newsletter::subscriber.edit', $data);
        }

        $this->setSessionValue(['status' => 'fail', 'message' => $result['message']]);
        return back();

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSubscriberRequest $request, $id)
    {
        $result = $this->checkExistance($id, 'subscribers');
        if ($result['status'] === true) {
            $response = (new Subscriber)->updateData($request->validated(), $id);

        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('subscriber.index');
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $result = $this->checkExistance($id, 'subscribers');
        if ($result['status'] === true) {
            $response = (new Subscriber)->remove($id);
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('subscriber.index');
    }

    /**
     * Subscriber list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['subscribers'] = Subscriber::getAll();

        return printPDF($data, 'subscriber_list' . time() . '.pdf', 'newsletter::subscriber.pdf', view('newsletter::subscriber.pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Subscriber list csv
     * @return html static page
     */
    public function csv()
    {
        return \Excel::download(new SubscriberListExport, 'subscriber_list' . time() . '.csv');
    }
}
