<?php
/**
 * @package PackageSubscriptionResource
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 26-09-2021
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request = [])
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'vendor_id' => $this->vendor_id,
            'package_id' => $this->package_id,
            'activation_date' => $this->activation_date,
            'billing_date' => $this->billing_date,
            'next_billing_date' => $this->next_billing_date,
            'billing_name' => $this->billing_name,
            'billing_first_name' => $this->billing_first_name,
            'billing_last_name' => $this->billing_last_name,
            'billing_email' => $this->billing_email,
            'billing_street_address' => $this->billing_street_address,
            'billing_street_address2' => $this->billing_street_address2,
            'billing_city' => $this->billing_city,
            'billing_state' => $this->billing_state,
            'billing_zip' => $this->billing_zip,
            'billing_country' => $this->billing_country,
            'billing_phone' => $this->billing_phone,
            'billing_price' => $this->billing_price,
            'billing_cycle' => $this->billing_cycle,
            'amount_billed' => $this->amount_billed,
            'amount_received' => $this->amount_received,
            'amount_due' => $this->amount_due,
            'payment_processor' => $this->payment_processor,
            'transaction_order_number' => $this->transaction_order_number,
            'transaction_invoice_id' => $this->transaction_invoice_id,
            'transaction_reference' => $this->transaction_reference,
            'is_customized' => $this->is_customized,
            'customized_records' => $this->customized_records,
            'is_renewed' => $this->is_renewed,
            'status' => $this->status

        ];
    }
}
