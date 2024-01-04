<?php

/**
 * @package PackageListExport
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 14-09-2021
 */

namespace App\Exports;

use App\Models\{
    Package,
    Preference
};

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};

class PackageListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from packages table through Eloquent Relationship]
     */

    public function collection()
    {
        return Package::getAll();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        return[
            'Name',
            'Code',
            'Description',
            'Price',
            'Billing Cycle',
            'Sort Order',
            'Private',
            'Status'
        ];
    }

    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $packageList [It has packages table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($packageList): array
    {
        $digit = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        return[
            isset($packageList->name) ? $packageList->name : '',
            isset($packageList->code) ? $packageList->code : '',
            isset($packageList->description) ? $packageList->description : '',
            number_format((float)$packageList->price, $digit['decimal_digits'], '.', ''),
            isset($packageList->billing_cycle) ? $packageList->billing_cycle : '',
            isset($packageList->sort_order) ? $packageList->sort_order : '',
            $packageList->is_private == 1 ? "Yes" : "No",
            $packageList->status
        ];
    }
}

