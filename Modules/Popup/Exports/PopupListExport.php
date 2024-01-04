<?php
/**
 * @package Popup Export
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 21-11-2021
 */

namespace Modules\Popup\Exports;

use Modules\Popup\Entities\Popup;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};


class PopupListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from Coupon table]
     */
    public function collection()
    {
        return Popup::getAll();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        $column = [
            'Name',
            'Popup Type',
            'Show after',
            'Login required',
            'Start Date',
            'End Date',
            'Status',
        ];
        return $column;
    }
    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $popupList [It has coupons table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($popupList): array
    {
        $field = [
            $popupList->name,
            $popupList->type,
            !empty($popupList->show_time) ? $popupList->show_time . ' sec' : '',
            $popupList->login_enabled == 1 ? __('Yes') : __('No'),
            formatDate($popupList->start_date),
            formatDate($popupList->end_date),
            $popupList->status,
        ];
        return $field;
    }
}
