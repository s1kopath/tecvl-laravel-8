<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'short_name' => 'en',
                'flag' => 'en.jpg',
                'status' => 'Active',
                'is_default' => 1,
                'direction' => 'ltr',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'French',
                'short_name' => 'fr',
                'flag' => '',
                'status' => 'Active',
                'is_default' => 0,
                'direction' => 'ltr',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Chinese',
                'short_name' => 'zh',
                'flag' => NULL,
                'status' => 'Active',
                'is_default' => 0,
                'direction' => 'ltr',
            ),
        ));
        
        
    }
}