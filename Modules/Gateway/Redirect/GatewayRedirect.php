<?php

namespace Modules\Gateway\Redirect;

use Modules\Gateway\Entities\PaymentLog;
use Modules\Gateway\Facades\GatewayHelper;

class GatewayRedirect
{

    /**
     * Handles redirection from system to payment gateway
     *
     * @param Object $order Order object
     * @param number $amount Total amount that needs to be paid
     * @param string $currencyCode Currency code of payable amount (USD)
     * @param string $code An unique key for the order that you will store in your database
     *
     * @return redirect
     */
    public static function paymentRoute($order, $amount, $currencyCode, $code, $request)
    {
        $log = PaymentLog::create([
            'total' => $amount,
            'currency_code' => $currencyCode,
            'sending_details' => json_encode($order),
            'code' => $code,
            'status' => 'pending'
        ]);
        GatewayHelper::storeDataLocally($code, $log);
        GatewayHelper::setPaymentCode($code);
        if ($request->wantsJson()) {
            return route('gateway.payment',  ['code' => bncrypt($code)]);
        }
        return route('gateway.payment');
    }
}
