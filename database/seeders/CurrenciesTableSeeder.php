<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'BDT',
                'symbol' => '৳',
                'exchange_rate' => '1.00000000',
                'exchange_from' => 'local',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'EUR',
                'symbol' => '€',
                'exchange_rate' => '0.00000000',
                'exchange_from' => 'local',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'USD',
                'symbol' => '$',
                'exchange_rate' => '85.00000000',
                'exchange_from' => 'local',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'GBP',
                'symbol' => '£',
                'exchange_rate' => '55.00000000',
                'exchange_from' => 'local',
            ),
        ));
        
        
    }
}