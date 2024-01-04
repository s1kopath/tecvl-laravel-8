<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ObjectFilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('object_files')->delete();
        
        \DB::table('object_files')->insert(array (
            0 => 
            array (
                'id' => 1,
                'object_type' => 'preferences',
                'object_id' => 47,
                'file_id' => 575,
            ),
        ));
        
        
    }
}