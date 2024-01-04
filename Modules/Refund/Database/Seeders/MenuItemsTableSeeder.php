<?php

namespace Modules\Refund\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->upsert([
            array (
                'id' => 51,
                'label' => 'Refund',
                'link' => 'refund-requests',
                'params' => '{"permission":"Modules\\\\Refund\\\\Http\\\\Controllers\\\\RefundController@index","route_name":["refund.index"], "menu_level":"1"}',
                'is_default' => 1,
                'icon' => 'fas fa-backward',
                'parent' => 43,
                'sort' => 14,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
            array (
                'id' => 52,
                'label' => 'Refund',
                'link' => 'refund-requests',
                'params' => '{"permission":"Modules\\\\Refund\\\\Http\\\\Controllers\\\\Vendor\\\\RefundController@index","route_name":["vendor.refund.index"], "menu_level":"3"}',
                'is_default' => 1,
                'icon' => 'fas fa-backward',
                'parent' => 0,
                'sort' => 7,
                'class' => NULL,
                'menu' => 3,
                'depth' => 0,
            ),
            array (
                'id' => 53,
                'label' => 'Refund',
                'link' => 'refund-request',
                'params' => '{"permission":"Modules\\\\Refund\\\\Http\\\\Controllers\\\\Site\\\\RefundController@index","route_name":["site.refundRequest", "site.createRefundRequest", "site.refundDetails"], "menu_level":"2"}',
                'is_default' => 1,
                'icon' => 'fas fa-backward',
                'parent' => 0,
                'sort' => 5,
                'class' => NULL,
                'menu' => 2,
                'depth' => 0,
            ),
        ], 'id');

    }
}
