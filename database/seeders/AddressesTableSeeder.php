<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('addresses')->delete();

        \DB::table('addresses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 2,
                'first_name' => 'Anil',
                'last_name' => 'Kapur',
                'address_1' => 'Kolkata, India',
                'address_2' => NULL,
                'city' => 'Kalkata',
                'state' => 'new rajsthal',
                'zip' => '2233',
                'country' => 'India',
                'is_default' => 1,
                'created_at' => '2021-12-09 14:37:29',
                'updated_at' => NULL,
            ),
        ));
    }
}
