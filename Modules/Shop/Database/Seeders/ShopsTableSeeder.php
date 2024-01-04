<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ShopsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shops')->delete();

        \DB::table('shops')->insert(array (
            0 =>
            array (
                'id' => 1,
                'vendor_id' => 1,
                'name' => 'Jamal',
                'email' => 'vendor@techvill.net',
                'alias' => 'jamal',
                'website' => NULL,
                'address' => NULL,
                'phone' => '09854789632',
                'fax' => NULL,
                'description' => NULL,
                'status' => 'Active',
                'created_at' => '2021-05-26 10:06:29',
                'updated_at' => '2021-10-10 13:14:05',
            ),
        ));
    }
}
