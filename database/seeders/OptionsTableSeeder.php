<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('options')->delete();

        \DB::table('options')->insert(array (
            0 =>
            array (
                'id' => 1,
                'option_group_id' => 1,
                'option' => 'Red',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'option_group_id' => 1,
                'option' => 'Green',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'option_group_id' => 1,
                'option' => 'Blue',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'option_group_id' => 1,
                'option' => 'Yellow',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'option_group_id' => 1,
                'option' => 'Not Specified',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 5,
            ),
            5 =>
            array (
                'id' => 6,
                'option_group_id' => 1,
                'option' => 'Orange',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 6,
            ),
            6 =>
            array (
                'id' => 7,
                'option_group_id' => 1,
                'option' => 'Black',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 7,
            ),
            7 =>
            array (
                'id' => 8,
                'option_group_id' => 1,
                'option' => 'White',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 8,
            ),
            8 =>
            array (
                'id' => 9,
                'option_group_id' => 1,
                'option' => 'Gray',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 9,
            ),
            9 =>
            array (
                'id' => 10,
                'option_group_id' => 1,
                'option' => 'Brown',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 10,
            ),
            10 =>
            array (
                'id' => 11,
                'option_group_id' => 1,
                'option' => 'Gold',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 11,
            ),
            11 =>
            array (
                'id' => 12,
                'option_group_id' => 2,
                'option' => 'S',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'option_group_id' => 2,
                'option' => 'M',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 2,
            ),
            13 =>
            array (
                'id' => 14,
                'option_group_id' => 2,
                'option' => 'L',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 3,
            ),
            14 =>
            array (
                'id' => 15,
                'option_group_id' => 2,
                'option' => 'XL',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 4,
            ),
            15 =>
            array (
                'id' => 16,
                'option_group_id' => 2,
                'option' => 'XXL',
                'is_default' => 0,
                'price' => '0.00000000',
                'price_type' => 'Fixed',
                'status' => 'Active',
                'order_by' => 5,
            ),
        ));


    }
}
