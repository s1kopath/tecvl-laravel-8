<?php
/**
 * @package PackageSubscriptionListExport
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 14-09-2021
 */
namespace App\Exports;

use App\Models\{
    PackageSubscription,
    Preference
};
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};

class PackageSubscriptionListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from package_subscriptions table through Eloquent Relationship]
     */
    public function collection()
    {
        return PackageSubscription::getAll();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        return[
            'Name',
            'Vendor Name',
            'Package Name',
            'Payment Processor',
            'Billing Cycle',
            'Billing Name',
            'Billing Email',
            'Billing Street Address',
            'Billing Street Address 2',
            'Billing State',
            'Billing Zip',
            'Billing Country',
            'Billing City',
            'Billing Phone',
            'Transaction Order No',
            'Transaction Invoice Id',
            'Transaction Reference',
            'Customized',
            'Customized Record',
            'Renewed',
            'Status',
            'Activation Date',
            'Next Billing Date',
            'Amount Billed',
            'Amount Received',
            'Amount Due'

        ];
    }
    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $packageList [It has package_subscriptions table info, vendors table info and packages table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($packageSubscriptionList): array
    {
        $digit = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        return[
            ucfirst($packageSubscriptionList->name),
            ucfirst(isset($packageSubscriptionList->vendor->name) ? $packageSubscriptionList->vendor->name : ''),
            ucfirst(isset($packageSubscriptionList->package->name) ? $packageSubscriptionList->package->name : ''),
            ucfirst($packageSubscriptionList->payment_processor),
            ucfirst($packageSubscriptionList->billing_cycle),
            ucwords($packageSubscriptionList->billing_name),
            $packageSubscriptionList->billing_email,
            ucfirst($packageSubscriptionList->billing_street_address),
            ucfirst($packageSubscriptionList->billing_street_address2),
            ucfirst($packageSubscriptionList->billing_state),
            $packageSubscriptionList->billing_zip,
            ucfirst($packageSubscriptionList->billing_country),
            ucfirst($packageSubscriptionList->billing_city),
            $packageSubscriptionList->billing_phone,
            $packageSubscriptionList->transaction_order_number,
            $packageSubscriptionList->transaction_invoice_id,
            $packageSubscriptionList->transaction_reference,
            $packageSubscriptionList->is_customized == 0 ? "No" : "Yes",
            $packageSubscriptionList->customized_records,
            $packageSubscriptionList->is_renewed == 0 ? "No" : "Yes",
            ucfirst($packageSubscriptionList->status),
            timeZoneformatDate($packageSubscriptionList->activation_date),
            timeZoneformatDate($packageSubscriptionList->next_billing_date),
            number_format((float)$packageSubscriptionList->amount_billed, $digit['decimal_digits'], '.', ''),
            number_format((float)$packageSubscriptionList->amount_received, $digit['decimal_digits'], '.', ''),
            number_format((float)$packageSubscriptionList->amount_due, $digit['decimal_digits'], '.', ''),

        ];
    }
}
