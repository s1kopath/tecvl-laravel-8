<?php

namespace Modules\Shipping\Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shippings')->delete();

        \DB::table('shippings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Free shipping',
                'minimum_amount' => '100.00000000',
                'cost' => '0.00000000',
                'status' => 'Active',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Local Pickup',
                'minimum_amount' => '0.00000000',
                'cost' => '0.00000000',
                'status' => 'Active',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Fixed',
                'minimum_amount' => NULL,
                'cost' => '50.00000000',
                'status' => 'Active',
            ),
        ));
    }
}
