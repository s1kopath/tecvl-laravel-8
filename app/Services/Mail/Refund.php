<?php

namespace App\Services\Mail;

use App\Http\Controllers\EmailController;
use App\Models\User;

class Refund extends SendMail
{
    /**
     * Send mail to user
     * @param object $request
     * @return array $response
     */
    public function send($request)
    {
        // Retrieve preference value and field name and language id
        $prefer = preference();

        $refundStatus = ['In progress' => 'accept-refund-request', 'Declined' => 'reject-refund-request', 'Accepted' => 'completed-refund-request'];
        $email = $this->setting($prefer['dflt_lang'], $refundStatus[$request->status]);

        $userInfo = User::where('id', $request->user_id)->first();

        // Replacing template variable
        // Need to change assigned by whom value with auth user
        $subject = str_replace('{company_name}', $prefer['company_name'], $email->subject);
        $message = str_replace('{user_name}', $userInfo->name, $email->body);
        $message = str_replace('{order_id}', $request->order_id, $message);
        $message = str_replace('{vendor_email}', $request->vendor_email, $message);
        if ($request->status == 'Accepted') {
            $message = str_replace('{money}', $request->total, $message);
        }
        $message = str_replace('{company_name}', $prefer['company_name'], $message);

        return (new EmailController)->sendEmail($userInfo->email, $subject, $message, null, $prefer['company_name']);
    }

}
