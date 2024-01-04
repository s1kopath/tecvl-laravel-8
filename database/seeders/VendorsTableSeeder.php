<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('vendors')->delete();

        \DB::table('vendors')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Jamal',
                'email' => 'info@jamal.com',
                'phone' => '09854789632',
                'formal_name' => 'Jamal Williams',
                'status' => 'Active',
                'website' => 'https://www.jamal.com',
                'created_at' => '2021-05-26 10:06:29',
                'updated_at' => '2021-10-10 13:14:05',
            ),
        ));
    }
}
