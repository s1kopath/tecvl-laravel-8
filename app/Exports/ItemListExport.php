<?php
/**
 * @package ItemListExport
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 12-10-2021
 */
namespace App\Exports;

use App\Models\{
    Item
};
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};

class ItemListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from User table and also role table through Eloquent Relationship]
     */
    public function collection()
    {
        return Item::where('status', 'Active')->get();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        return[
            'Name',
            'Category',
            'Brand',
            'Vendor',
            'Item Code',
            'SKU',
            'Price',
            'Created At'
        ];
    }
    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $userList [It has users table info and roles table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($items): array
    {
        return[
            $items->name,
            isset($items->itemCategory->category->name) ? $items->itemCategory->category->name : '',
            optional($items->brand)->name,
            optional($items->vendor)->name,
            $items->item_code,
            $items->sku,
            $items->price,
            formatDate($items->created_at) . ' ' . timeZonegetTime($items->created_at),
        ];
    }
}
