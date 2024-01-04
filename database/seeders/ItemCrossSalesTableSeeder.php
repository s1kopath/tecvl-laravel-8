<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemCrossSalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_cross_sales')->delete();
        
        
        
    }
}