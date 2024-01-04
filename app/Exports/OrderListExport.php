<?php
/**
 * @package OrderListExport
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 20-01-2022
 */
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};

class OrderListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from User table and also role table through Eloquent Relationship]
     */
    public function collection()
    {
        return Order::all();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        return[
            'Invoice',
            'Customer',
            'Number of Items',
            'Total Amount',
            'Status',
            'Payment Status',
            'Created At'
        ];
    }
    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $userList [It has users table info and roles table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($orderList): array
    {
        return[
            $orderList->reference,
            optional($orderList->user)->name,
            formatCurrencyAmount($orderList->total_quantity),
            formatCurrencyAmount($orderList->total),
            $orderList->status,
            $orderList->paymentStatus($orderList->total, $orderList->paid),
            formatDate($orderList->created_at) . ' ' . timeZonegetTime($orderList->created_at),
        ];
    }
}
