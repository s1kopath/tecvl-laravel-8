<?php
/**
 * @package ReviewListExport
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 16-11-2021
 */
namespace App\Exports;

use App\Models\{Review};
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping
};

class ReviewListExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * [Here we need to fetch data from data source]
     * @return [Database Object] [Here we are fetching data from User table and also role table through Eloquent Relationship]
     */
    public function collection()
    {
        return Review::all();
    }

    /**
     * [Here we are putting Headinngs of The CSV]
     * @return [array] [Exel Headings]
     */
    public function headings(): array
    {
        return [
            'Comment',
            'Item',
            'User',
            'Rating',
            'Is Public',
            'Status',
            'Created At'
        ];
    }
    /**
     * [By adding WithMapping you map the data that needs to be added as row. This way you have control over the actual source for each column. In case of using the Eloquent query builder]
     * @param  [object] $userList [It has users table info and roles table info]
     * @return [array]            [comma separated value will be produced]
     */
    public function map($reviewList): array
    {
        return [
            $reviewList->comments,
            $reviewList->item->name ?? null,
            $reviewList->user->name ?? null,
            $reviewList->rating,
            $reviewList->is_public == 1 ? __('Yes') : __('No'),
            $reviewList->status,
            formatDate($reviewList->created_at) . ' ' . timeZonegetTime($reviewList->created_at),
        ];
    }
}
