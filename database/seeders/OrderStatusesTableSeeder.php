<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('order_statuses')->delete();

        \DB::table('order_statuses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Order Received',
                'is_default' => 1,
                'order_by' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Confirmed',
                'is_default' => 0,
                'order_by' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Picked Up',
                'is_default' => 0,
                'order_by' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'On The Way',
                'is_default' => 0,
                'order_by' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Delivered',
                'is_default' => 0,
                'order_by' => 5,
            ),
        ));
    }
}
