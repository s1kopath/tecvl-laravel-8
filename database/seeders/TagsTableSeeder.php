<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tags')->delete();

        \DB::table('tags')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Samsung',
                'vendor_id' => 1,
                'item_counts' => 2,
                'status' => 'Active',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Tab',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Galaxy',
                'vendor_id' => 1,
                'item_counts' => 2,
                'status' => 'Active',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Samsung Galaxy Tab',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Smart Phone',
                'vendor_id' => 1,
                'item_counts' => 4,
                'status' => 'Active',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'iPhone',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => ' 13 Pro',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => ' iPhone 13 Pro',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'A30',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Nokia',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Nokia 3.4 DS',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Laptop',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Laptop PC touch',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'HP ENVY 17t-ch000',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'HP Laptop',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'LED TV',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => ' MI 43 Inch P1 4K UHD android LED TV',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'MI 43 Inch',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'MI',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'MI P1',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            20 =>
            array (
                'id' => 21,
            'name' => 'WFC-3F5-GDEL-XX (Inverter)',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Inverter',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'WFC',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Waxjambu GL710H',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Waxjambu',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'GL710H',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'WPL02-C1',
                'vendor_id' => 1,
                'item_counts' => 1,
                'status' => 'Active',
            ),
        ));


    }
}
