<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('wishlists')->delete();

        \DB::table('wishlists')->insert(array (
            0 =>
            array (
                'id' => 37,
                'item_id' => 1001,
                'user_id' => 2,
                'ip_address' => '::1',
                'browser_agent' => 'Google Chrome',
                'created_at' => randomDateBefore(),
            ),
            1 =>
            array (
                'id' => 38,
                'item_id' => 1002,
                'user_id' => 2,
                'ip_address' => '::1',
                'browser_agent' => 'Google Chrome',
                'created_at' => randomDateBefore(),
            ),
            2 =>
            array (
                'id' => 39,
                'item_id' => 1003,
                'user_id' => 2,
                'ip_address' => '::1',
                'browser_agent' => 'Google Chrome',
                'created_at' => randomDateBefore(),
            ),
        ));
    }
}
