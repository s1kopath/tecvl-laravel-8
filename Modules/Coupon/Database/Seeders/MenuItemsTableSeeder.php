<?php

namespace Modules\Coupon\Database\Seeders;

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
            ['id' => 74, 'label' => 'coupons', 'link' => 'coupons', 'params' => '{"permission":"Modules\\\\Coupon\\\\Http\\\\Controllers\\\\CouponController@index","route_name":["coupon.index","coupon.create","coupon.edit","coupon.pdf","coupon.csv","coupon.shop","coupon.item","couponRedeem.index","couponRedeem.pdf","couponRedeem.csv"]}', 'is_default' => 1, 'icon' => 'fas fa-ticket-alt', 'parent' => 73, 'sort' => 28, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => 75, 'label' => 'Coupon', 'link' => 'coupons', 'params' => '{"permission":"Modules\\\\Coupon\\\\Http\\\\Controllers\\\\Vendor\\\\CouponController@index","route_name":["vendor.coupons", "vendor.couponCreate", "vendor.couponEdit", "vendor.couponItem"]}', 'is_default' => 1, 'icon' => 'fas fa-ticket-alt', 'parent' => 0, 'sort' => 4, 'class' => NULL, 'menu' => 3, 'depth' => 0,],
        ], 'id');

    }
}
