<?php

namespace Modules\Gateway\Http\Controllers\Api;


use Modules\Gateway\Contracts\RequiresWebHookValidationInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gateway\Contracts\CryptoResponseInterface;
use Modules\Gateway\Contracts\HasDataResponseInterface;
use Modules\Gateway\Contracts\RequiresCallbackInterface;
use Modules\Gateway\Entities\GatewayModule;
use Modules\Gateway\Entities\PaymentLog;
use Modules\Gateway\Facades\GatewayHandler;
use Modules\Gateway\Services\GatewayHelper;
use Modules\Gateway\Traits\ApiResponse;

class GatewayController extends Controller
{
    use ApiResponse;

    private $helper;

    public function __construct()
    {
        $this->helper = GatewayHelper::getInstance();
    }


    /**
     * Display payable payment gateway.
     *
     * @return Renderable
     */
    public function paymentGateways(Request $request)
    {
        $code = $request->code;

        $purchaseData = $this->helper->getPurchaseData($code);

        $gateways = (new GatewayModule)->payableGateways();

        if ($purchaseData->status == 'completed') {
            return $this->badRequestResponse([], __('Already paid for the order.'));
        }

        return $this->successResponse([
            'gateways' => $gateways,
            'purchaseData' => $purchaseData,
            'next_url' => route('gateway.pay', ['gateway' => 'your_gateway_alias', 'code' => $code])
        ]);
    }


    /**
     * Displays the payment page for specific payment gateway
     *
     * @param \Illuminate\Http\Request
     *
     * @return Renderable
     */
    public function pay(Request $request)
    {
        try {
            if (moduleAvailable($request->gateway) && $this->helper->isModuleActive($request->gateway)) {
                $viewClass = GatewayHandler::getView($request->gateway);
                return $this->response([$viewClass::paymentResponse($request->code)]);
            }
            return $this->notFoundResponse([], __('Payment method not found.'));
        } catch (\Exception $e) {
            return $this->notFoundResponse([], $e->getMessage());
        }
    }


    /**
     * Process the payment for specific gateway
     *
     * @param \Illuminate\Http\Request
     *
     * @return redirect
     */
    public function makePayment(Request $request)
    {
        if (moduleAvailable($request->gateway)) {
            try {

                $processor = GatewayHandler::getProcessor($request->gateway);
                if ($processor instanceof RequiresWebHookValidationInterface) {
                    $response = $processor->pay($request);
                    PaymentLog::where('code', $this->helper->getPurchaseCode())->update($this->getUpdateData($response));
                    return redirect($response->getUrl());
                }
                if ($processor instanceof RequiresCallbackInterface) {
                    return $processor->pay($request);
                }
                $response = $processor->pay($request);

                PaymentLog::where('code', $this->helper->getPurchaseCode())->update($this->getUpdateData($response));
            } catch (\Exception $e) {
                return redirect(route('gateway.payment'))->withErrors($e->getMessage());
            }
            return redirect(route(session(config('gateway.payment_success_route'))))->with(['payment_status' => 'success', 'gateway' => $request->gateway]);
        }
        return redirect(route('gateway.payment'))->withErrors(__('Payment method not available.'));
    }


    /**
     * This function handle response of redirected payment callbacks
     *
     * @param \Illuminate\Http\Request
     *
     * @return redirect
     */
    public function paymentCallback(Request $request)
    {
        try {
            $processor = GatewayHandler::getProcessor($request->gateway);

            $response = $processor->validateTransaction($request);

            PaymentLog::where('code', $this->helper->getPurchaseCode())->update($this->getUpdateData($response));
        } catch (\Exception $e) {

            return redirect(route('gateway.payment'))->withErrors($e->getMessage());
        }
        return redirect(route(session(config('gateway.payment_success_route'))))->with(['payment_status' => 'success', 'gateway' => $request->gateway]);
    }


    /**
     * Handles cancelled payment request
     *
     * @param \Illuminate\Http\Request
     *
     * @return redirect
     */
    public function paymentCancelled(Request $request)
    {
        try {
            $processor = GatewayHandler::getProcessor($request->gateway);
            $processor->cancel($request);
        } catch (\Exception $e) {
            return redirect(route('gateway.payment'))->withErrors($e->getMessage());
        }
    }

    /**
     * Process payment from gateways which sends response to the hook URL
     *
     * @param \Illuminate\Http\Request
     *
     * @return bool
     */
    public function paymentHook(Request $request)
    {
        try {
            $processor = GatewayHandler::getProcessor($request->gateway);
            $payment = $processor->validatePayment($request);
            if (!$payment) {
                return false;
            }
        } catch (\Exception $e) {
            paymentLog([$e, $request->all()]);
            return false;
        }
        return true;
    }


    /**
     * Process payment response
     *
     * @param \Modules\Gateway\Response\Response
     *
     * @return array
     */
    private function getUpdateData($response)
    {
        $array['gateway'] = $response->getGateway();
        $array['status'] = $response->getStatus();
        if ($response instanceof HasDataResponseInterface) {
            $array['response'] = $response->getResponse();
            $array['response_raw'] = $response->getRawResponse();
        }
        if ($response instanceof CryptoResponseInterface) {
            $array['unique_code'] = $response->getUniqueCode();
        }
        return $array;
    }
}
