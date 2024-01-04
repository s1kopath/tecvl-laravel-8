<?php

/**
 * @package RazorpayProcessor
 * @author techvillage <support@techvill.org>
 * @contributor Muhammad AR Zihad <[zihad.techvill@gmail.com]>
 * @created 16-2-22
 */

namespace Modules\Razorpay\Processor;

use Modules\Gateway\Contracts\PaymentProcessorInterface;
use Modules\Gateway\Facades\GatewayHelper;
use Modules\Razorpay\Facades\RazorFacade;
use Modules\Razorpay\Response\RazorResponse;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayProcessor implements PaymentProcessorInterface
{
    public function pay($request)
    {
        if (empty($request->razorpay_payment_id) === false) {

            $razor = RazorFacade::razorData();

            $api = RazorFacade::api($razor->apiKey, $razor->apiSecret);

            try {
                $attributes = array(
                    'razorpay_order_id' => RazorFacade::getOrderId(),
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                );
                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                paymentLog($e);
                throw new \Exception($e->getMessage());
            }
        } else {
            throw new \Exception(__('Payment id not found.'));
        }
        return new RazorResponse(GatewayHelper::getPurchaseData(GatewayHelper::getPaymentCode()), $attributes);
    }
}
