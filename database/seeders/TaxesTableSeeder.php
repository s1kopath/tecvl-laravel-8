<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxes')->delete();
        
        \DB::table('taxes')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'No tax',
                'tax_rate' => '0.00000000',
                'is_default' => 0,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Normal',
                'tax_rate' => '2.00000000',
                'is_default' => 0,
            ),
        ));
        
        
    }
}