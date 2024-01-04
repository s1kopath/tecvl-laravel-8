<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemRelatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_relates')->delete();
        
        \DB::table('item_relates')->insert(array (
            0 => 
            array (
                'item_id' => 1001,
                'related_item_id' => 1011,
            ),
            1 => 
            array (
                'item_id' => 1011,
                'related_item_id' => 1001,
            ),
            2 => 
            array (
                'item_id' => 1047,
                'related_item_id' => 1046,
            ),
            3 => 
            array (
                'item_id' => 1046,
                'related_item_id' => 1047,
            ),
            4 => 
            array (
                'item_id' => 1044,
                'related_item_id' => 1043,
            ),
            5 => 
            array (
                'item_id' => 1043,
                'related_item_id' => 1044,
            ),
            6 => 
            array (
                'item_id' => 1042,
                'related_item_id' => 1041,
            ),
            7 => 
            array (
                'item_id' => 1041,
                'related_item_id' => 1042,
            ),
            8 => 
            array (
                'item_id' => 1040,
                'related_item_id' => 1039,
            ),
            9 => 
            array (
                'item_id' => 1039,
                'related_item_id' => 1040,
            ),
            10 => 
            array (
                'item_id' => 1037,
                'related_item_id' => 1036,
            ),
            11 => 
            array (
                'item_id' => 1036,
                'related_item_id' => 1037,
            ),
            12 => 
            array (
                'item_id' => 1035,
                'related_item_id' => 1034,
            ),
            13 => 
            array (
                'item_id' => 1034,
                'related_item_id' => 1035,
            ),
            14 => 
            array (
                'item_id' => 1031,
                'related_item_id' => 1030,
            ),
            15 => 
            array (
                'item_id' => 1030,
                'related_item_id' => 1031,
            ),
            16 => 
            array (
                'item_id' => 1029,
                'related_item_id' => 1028,
            ),
            17 => 
            array (
                'item_id' => 1028,
                'related_item_id' => 1029,
            ),
            18 => 
            array (
                'item_id' => 1027,
                'related_item_id' => 1026,
            ),
            19 => 
            array (
                'item_id' => 1026,
                'related_item_id' => 1027,
            ),
            20 => 
            array (
                'item_id' => 1025,
                'related_item_id' => 1024,
            ),
            21 => 
            array (
                'item_id' => 1024,
                'related_item_id' => 1025,
            ),
            22 => 
            array (
                'item_id' => 1023,
                'related_item_id' => 1022,
            ),
            23 => 
            array (
                'item_id' => 1022,
                'related_item_id' => 1023,
            ),
            24 => 
            array (
                'item_id' => 1020,
                'related_item_id' => 1019,
            ),
            25 => 
            array (
                'item_id' => 1019,
                'related_item_id' => 1020,
            ),
            26 => 
            array (
                'item_id' => 1018,
                'related_item_id' => 1017,
            ),
            27 => 
            array (
                'item_id' => 1017,
                'related_item_id' => 1018,
            ),
            28 => 
            array (
                'item_id' => 1010,
                'related_item_id' => 1032,
            ),
            29 => 
            array (
                'item_id' => 1032,
                'related_item_id' => 1010,
            ),
            30 => 
            array (
                'item_id' => 1007,
                'related_item_id' => 1014,
            ),
            31 => 
            array (
                'item_id' => 1014,
                'related_item_id' => 1007,
            ),
            32 => 
            array (
                'item_id' => 1013,
                'related_item_id' => 1004,
            ),
            33 => 
            array (
                'item_id' => 1004,
                'related_item_id' => 1013,
            ),
            34 => 
            array (
                'item_id' => 1003,
                'related_item_id' => 1033,
            ),
            35 => 
            array (
                'item_id' => 1033,
                'related_item_id' => 1003,
            ),
            36 => 
            array (
                'item_id' => 1012,
                'related_item_id' => 1002,
            ),
            37 => 
            array (
                'item_id' => 1002,
                'related_item_id' => 1012,
            ),
            38 => 
            array (
                'item_id' => 1048,
                'related_item_id' => 1011,
            ),
            39 => 
            array (
                'item_id' => 1011,
                'related_item_id' => 1048,
            ),
            40 => 
            array (
                'item_id' => 1048,
                'related_item_id' => 1001,
            ),
            41 => 
            array (
                'item_id' => 1001,
                'related_item_id' => 1048,
            ),
        ));
        
        
    }
}