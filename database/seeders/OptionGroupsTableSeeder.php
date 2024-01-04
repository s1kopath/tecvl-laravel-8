<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('option_groups')->delete();

        \DB::table('option_groups')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'vendor_id' => NULL,
                    'name' => 'Color',
                    'type' => 'dropdown',
                    'is_required' => 0,
                ),
            1 =>
                array (
                    'id' => 2,
                    'vendor_id' => NULL,
                    'name' => 'Size',
                    'type' => 'dropdown',
                    'is_required' => 0,
                ),
        ));


    }
}
