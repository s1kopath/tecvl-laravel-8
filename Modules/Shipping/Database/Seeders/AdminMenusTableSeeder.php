<?php

namespace Modules\Shipping\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
       DB::table('admin_menus')->upsert([
            array (
                'name' => 'shipping',
                'url' => 'shippings',
                'slug' => 'shippings',
                'params' => '{"permission":"Modules\\\\Shipping\\\\Http\\\\Controllers\\\\ShippingController@index","route_name":["shipping.index","shipping.create","shipping.store","shipping.edit","shipping.update","shipping.delete"]}',
                'is_default' => 1,
            ),
        ], 'slug');

    }
}
