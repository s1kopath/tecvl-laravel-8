<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorUsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('vendor_users')->delete();

        \DB::table('vendor_users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'vendor_id' => 1,
                'user_id' => 3,
                'status' => 'Active',
                'created_at' => '2021-05-26 10:06:29',
                'updated_at' => '2021-10-10 13:14:05',
            ),
        ));
    }
}
