<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('packages')->delete();
        
        \DB::table('packages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Free',
                'code' => 'p-free',
                'description' => 'This is a free package',
                'params' => NULL,
                'price' => '0.00000000',
                'billing_cycle' => 'monthly',
                'sort_order' => 1,
                'is_private' => 0,
                'status' => 'active',
                'created_at' => '2021-11-06 10:03:29',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Gold',
                'code' => 'p-gold',
                'description' => 'This is a gold package.',
                'params' => '{"shop":3}',
                'price' => '9.99000000',
                'billing_cycle' => 'monthly',
                'sort_order' => 2,
                'is_private' => 0,
                'status' => 'active',
                'created_at' => '2021-11-06 10:04:02',
                'updated_at' => '2021-11-14 16:51:20',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Premium',
                'code' => 'p-premium',
                'description' => 'This is a premium package.',
                'params' => NULL,
                'price' => '99.99000000',
                'billing_cycle' => 'yearly',
                'sort_order' => 3,
                'is_private' => 0,
                'status' => 'active',
                'created_at' => '2021-11-06 10:04:32',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}