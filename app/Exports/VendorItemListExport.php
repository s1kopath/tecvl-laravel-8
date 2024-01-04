<?php
/**
 * @package ItemListExport
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 19-12-2021
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

class VendorItemListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from User table and also role table through Eloquent Relationship]
     */
    public function collection()
    {
        return Item::select('id', 'name', 'item_code', 'sku', 'price', 'status', 'vendor_id', 'brand_id')->where('status', 'Active')->where('vendor_id', session()->get('vendorId'))->with(['vendor:id,name', 'brand:id,name', 'itemCategory'])->get();
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
            optional($items->itemCategory->category)->name,
            optional($items->brand)->name,
            optional($items->vendor)->name,
            $items->item_code,
            $items->sku,
            $items->price,
            timeZoneformatDate($items->created_at),
        ];
    }
}
