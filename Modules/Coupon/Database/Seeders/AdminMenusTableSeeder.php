<?php

namespace Modules\Coupon\Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admin_menus')->delete();

        \DB::table('admin_menus')->insert(array (
            0 =>
            array (
                'id' => 15,
                'name' => 'Coupons',
                'slug' => 'coupons',
                'url' => 'coupons',
                'permission' => '{"permission":"Modules\\\\Coupon\\\\Http\\\\Controllers\\\\CouponController@index", "route_name":["coupon.index", "coupon.create", "coupon.edit", "coupon.pdf", "coupon.csv", "coupon.shop", "coupon.item", "couponRedeem.index", "couponRedeem.pdf", "couponRedeem.csv"], "menu_level":"1"}',
                'is_default' => 0,
                'created_at' => '2021-12-13 10:08:14',
            ),
        ));


    }
}
