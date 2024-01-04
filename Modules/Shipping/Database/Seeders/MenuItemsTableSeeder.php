<?php

namespace Modules\Shipping\Database\Seeders;

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
                'id' => 44,
                'label' => 'shipping',
                'link' => 'shippings',
                'params' => '{"permission":"Modules\\\\Shipping\\\\Http\\\\Controllers\\\\ShippingController@index","route_name":["shipping.index","shipping.create","shipping.store","shipping.edit","shipping.update","shipping.delete"]}',
                'is_default' => 1,
                'icon' => 'fas fa-shipping-fast',
                'parent' => 0,
                'sort' => 15,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
            ),
        ], 'id');

    }
}
