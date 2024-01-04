<?php

namespace Modules\Coupon\Database\Seeders;

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('coupons')->delete();

        \DB::table('coupons')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Percent Discount',
                'vendor_id' => 1,
                'shop_id' => 1,
                'usage_limit' => 10,
                'minimum_spend' => null,
                'code' => '10PERCENT',
                'discount_type' => 'Percentage',
                'discount_amount' => '10.00000000',
                'maximum_discount_amount' => '200.00000000',
                'start_date' => now(),
                'end_date' => date('Y-m-d', strtotime('+3 days')),
                'status' => 'Active',
                'created_at' => '2021-11-21 13:33:29',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Anniversary',
                'vendor_id' => 1,
                'shop_id' => 1,
                'usage_limit' => 15,
                'minimum_spend' => null,
                'code' => 'HAPPY2022',
                'discount_type' => 'Flat',
                'discount_amount' => '22.00000000',
                'maximum_discount_amount' => NULL,
                'start_date' => now(),
                'end_date' => date('Y-m-d', strtotime('+10 days')),
                'status' => 'Inactive',
                'created_at' => '2021-11-21 13:34:31',
                'updated_at' => NULL,
            ),
        ));
    }
}
