<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('item_options')->delete();

        \DB::table('item_options')->insert(array (
            0 =>
            array (
                'id' => 27,
                'item_id' => 1017,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"5.00000000"},{"order_by":2,"option_price":"10.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            1 =>
            array (
                'id' => 28,
                'item_id' => 1017,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["2 MB","4 MB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            2 =>
            array (
                'id' => 29,
                'item_id' => 1017,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["4 MB","8 MB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            3 =>
            array (
                'id' => 30,
                'item_id' => 1018,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"5.00000000"},{"order_by":2,"option_price":"10.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            4 =>
            array (
                'id' => 31,
                'item_id' => 1018,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["2 MB","4 MB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            5 =>
            array (
                'id' => 32,
                'item_id' => 1018,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["4 MB","8 MB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            6 =>
            array (
                'id' => 33,
                'item_id' => 1019,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"5.00000000"},{"order_by":2,"option_price":"10.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            7 =>
            array (
                'id' => 34,
                'item_id' => 1020,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"5.00000000"},{"order_by":2,"option_price":"10.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            8 =>
            array (
                'id' => 37,
                'item_id' => 1022,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            9 =>
            array (
                'id' => 38,
                'item_id' => 1022,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            10 =>
            array (
                'id' => 39,
                'item_id' => 1022,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["128 GB","256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            11 =>
            array (
                'id' => 40,
                'item_id' => 1023,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            12 =>
            array (
                'id' => 41,
                'item_id' => 1023,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            13 =>
            array (
                'id' => 42,
                'item_id' => 1023,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["128 GB","256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            14 =>
            array (
                'id' => 43,
                'item_id' => 1024,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            15 =>
            array (
                'id' => 44,
                'item_id' => 1024,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            16 =>
            array (
                'id' => 45,
                'item_id' => 1024,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["128 GB","256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            17 =>
            array (
                'id' => 46,
                'item_id' => 1025,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["128 GB","256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            18 =>
            array (
                'id' => 47,
                'item_id' => 1025,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            19 =>
            array (
                'id' => 48,
                'item_id' => 1025,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            20 =>
            array (
                'id' => 49,
                'item_id' => 1026,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            21 =>
            array (
                'id' => 50,
                'item_id' => 1026,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            22 =>
            array (
                'id' => 51,
                'item_id' => 1026,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            23 =>
            array (
                'id' => 52,
                'item_id' => 1027,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            24 =>
            array (
                'id' => 53,
                'item_id' => 1027,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            25 =>
            array (
                'id' => 54,
                'item_id' => 1027,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            26 =>
            array (
                'id' => 55,
                'item_id' => 1028,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Green"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            27 =>
            array (
                'id' => 56,
                'item_id' => 1028,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            28 =>
            array (
                'id' => 57,
                'item_id' => 1028,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            29 =>
            array (
                'id' => 58,
                'item_id' => 1029,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Green"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            30 =>
            array (
                'id' => 59,
                'item_id' => 1029,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            31 =>
            array (
                'id' => 60,
                'item_id' => 1029,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            32 =>
            array (
                'id' => 61,
                'item_id' => 1030,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Green"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            33 =>
            array (
                'id' => 62,
                'item_id' => 1030,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            34 =>
            array (
                'id' => 63,
                'item_id' => 1030,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            35 =>
            array (
                'id' => 64,
                'item_id' => 1031,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Green"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            36 =>
            array (
                'id' => 65,
                'item_id' => 1031,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            37 =>
            array (
                'id' => 66,
                'item_id' => 1031,
                'name' => 'SSD',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["256 GB","512 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            38 =>
            array (
                'id' => 67,
                'item_id' => 1010,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            39 =>
            array (
                'id' => 68,
                'item_id' => 1010,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            40 =>
            array (
                'id' => 69,
                'item_id' => 1010,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Blue","White","Red"],"option_price":[{"order_by":1,"option_price":5},{"order_by":2,"option_price":10},{"order_by":3,"option_price":5},{"order_by":4,"option_price":5},{"order_by":5,"option_price":5}],"option_price_type":["Fixed","Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active","Active"]}',
                'is_required' => 1,
            ),
            41 =>
            array (
                'id' => 70,
                'item_id' => 1032,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            42 =>
            array (
                'id' => 71,
                'item_id' => 1032,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            43 =>
            array (
                'id' => 72,
                'item_id' => 1032,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Blue","White","Red"],"option_price":[{"order_by":1,"option_price":"5.00000000"},{"order_by":2,"option_price":"10.00000000"},{"order_by":3,"option_price":"5.00000000"},{"order_by":4,"option_price":"5.00000000"},{"order_by":5,"option_price":"5.00000000"}],"option_price_type":["Fixed","Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active","Active"]}',
                'is_required' => 1,
            ),
            44 =>
            array (
                'id' => 73,
                'item_id' => 1033,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            45 =>
            array (
                'id' => 74,
                'item_id' => 1033,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            46 =>
            array (
                'id' => 75,
                'item_id' => 1033,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Black","Green","Pink"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"},{"order_by":3,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            47 =>
            array (
                'id' => 76,
                'item_id' => 1005,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            48 =>
            array (
                'id' => 77,
                'item_id' => 1005,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            49 =>
            array (
                'id' => 78,
                'item_id' => 1005,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Blue","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            50 =>
            array (
                'id' => 79,
                'item_id' => 1034,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            51 =>
            array (
                'id' => 80,
                'item_id' => 1034,
                'name' => 'Lens',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["18 - 55 mm","10-18mm","55-300mm"],"option_price":[{"order_by":1,"option_price":"7000.00000000"},{"order_by":2,"option_price":"5000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            52 =>
            array (
                'id' => 81,
                'item_id' => 1034,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["1 TB","2 TB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            53 =>
            array (
                'id' => 82,
                'item_id' => 1035,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            54 =>
            array (
                'id' => 83,
                'item_id' => 1035,
                'name' => 'Lens',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["18 - 55 mm","10-18mm","55-300mm"],"option_price":[{"order_by":1,"option_price":"7000.00000000"},{"order_by":2,"option_price":"5000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            55 =>
            array (
                'id' => 84,
                'item_id' => 1035,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["1 TB","2 TB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            56 =>
            array (
                'id' => 85,
                'item_id' => 1036,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Silver"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            57 =>
            array (
                'id' => 86,
                'item_id' => 1036,
                'name' => 'Lens',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["15-45 mm","24-70mm","24-105mm"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            58 =>
            array (
                'id' => 87,
                'item_id' => 1036,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["64 GB","1 TB","2 TB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            59 =>
            array (
                'id' => 88,
                'item_id' => 1037,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","Silver"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            60 =>
            array (
                'id' => 89,
                'item_id' => 1037,
                'name' => 'Lens',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["15-45 mm","24-70mm","24-105mm"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            61 =>
            array (
                'id' => 90,
                'item_id' => 1037,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["64 GB","1 TB","2 TB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            62 =>
            array (
                'id' => 91,
                'item_id' => 1038,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            63 =>
            array (
                'id' => 92,
                'item_id' => 1038,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            64 =>
            array (
                'id' => 93,
                'item_id' => 1039,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            65 =>
            array (
                'id' => 94,
                'item_id' => 1039,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            66 =>
            array (
                'id' => 95,
                'item_id' => 1040,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            67 =>
            array (
                'id' => 96,
                'item_id' => 1040,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            68 =>
            array (
                'id' => 97,
                'item_id' => 1041,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            69 =>
            array (
                'id' => 98,
                'item_id' => 1041,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            70 =>
            array (
                'id' => 99,
                'item_id' => 1042,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            71 =>
            array (
                'id' => 100,
                'item_id' => 1042,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            72 =>
            array (
                'id' => 101,
                'item_id' => 1043,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"]}',
                'is_required' => 1,
            ),
            73 =>
            array (
                'id' => 102,
                'item_id' => 1043,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","256 GB","1 TB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"},{"order_by":3,"option_price":"9000.00000000"}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"]}',
                'is_required' => 1,
            ),
            74 =>
            array (
                'id' => 103,
                'item_id' => 1044,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[95,96]}',
                'is_required' => 1,
            ),
            75 =>
            array (
                'id' => 104,
                'item_id' => 1044,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","256 GB","1 TB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[97,98,99]}',
                'is_required' => 1,
            ),
            76 =>
            array (
                'id' => 108,
                'item_id' => 1001,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["2 GB","4 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[9,10]}',
                'is_required' => 1,
            ),
            77 =>
            array (
                'id' => 109,
                'item_id' => 1001,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["32 GB","64 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[11,12]}',
                'is_required' => 1,
            ),
            78 =>
            array (
                'id' => 110,
                'item_id' => 1001,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Blue","Grey","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0},{"order_by":4,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[13,14,15,16]}',
                'is_required' => 1,
            ),
            79 =>
            array (
                'id' => 111,
                'item_id' => 1002,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[17,18,19]}',
                'is_required' => 1,
            ),
            80 =>
            array (
                'id' => 112,
                'item_id' => 1002,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[20,21,22]}',
                'is_required' => 1,
            ),
            81 =>
            array (
                'id' => 113,
                'item_id' => 1002,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Black","Green","Blue","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0},{"order_by":4,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[23,24,25,26]}',
                'is_required' => 1,
            ),
            82 =>
            array (
                'id' => 114,
                'item_id' => 1003,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[27,28,29]}',
                'is_required' => 1,
            ),
            83 =>
            array (
                'id' => 115,
                'item_id' => 1003,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[30,31,32]}',
                'is_required' => 1,
            ),
            84 =>
            array (
                'id' => 116,
                'item_id' => 1003,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Black","Green","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[33,34,35]}',
                'is_required' => 1,
            ),
            85 =>
            array (
                'id' => 117,
                'item_id' => 1004,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["6 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[36,37]}',
                'is_required' => 1,
            ),
            86 =>
            array (
                'id' => 118,
                'item_id' => 1004,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[38,39]}',
                'is_required' => 1,
            ),
            87 =>
            array (
                'id' => 119,
                'item_id' => 1004,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[40,41,42]}',
                'is_required' => 1,
            ),
            88 =>
            array (
                'id' => 120,
                'item_id' => 1006,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[43,44]}',
                'is_required' => 1,
            ),
            89 =>
            array (
                'id' => 121,
                'item_id' => 1006,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":7000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[45,46,47]}',
                'is_required' => 1,
            ),
            90 =>
            array (
                'id' => 122,
                'item_id' => 1006,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[48,49,50]}',
                'is_required' => 1,
            ),
            91 =>
            array (
                'id' => 123,
                'item_id' => 1007,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[51,52]}',
                'is_required' => 1,
            ),
            92 =>
            array (
                'id' => 124,
                'item_id' => 1007,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[53,54]}',
                'is_required' => 1,
            ),
            93 =>
            array (
                'id' => 125,
                'item_id' => 1007,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["64 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[55,56]}',
                'is_required' => 1,
            ),
            94 =>
            array (
                'id' => 126,
                'item_id' => 1008,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[57,58]}',
                'is_required' => 1,
            ),
            95 =>
            array (
                'id' => 127,
                'item_id' => 1008,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[59,60]}',
                'is_required' => 1,
            ),
            96 =>
            array (
                'id' => 128,
                'item_id' => 1008,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[61,62,63]}',
                'is_required' => 1,
            ),
            97 =>
            array (
                'id' => 129,
                'item_id' => 1011,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["2 GB","4 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[64,65]}',
                'is_required' => 1,
            ),
            98 =>
            array (
                'id' => 130,
                'item_id' => 1011,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["32 GB","64 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[66,67]}',
                'is_required' => 1,
            ),
            99 =>
            array (
                'id' => 131,
                'item_id' => 1011,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Blue","Grey","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0},{"order_by":4,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[68,69,70,71]}',
                'is_required' => 1,
            ),
            100 =>
            array (
                'id' => 132,
                'item_id' => 1012,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB","16 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[72,73,74]}',
                'is_required' => 1,
            ),
            101 =>
            array (
                'id' => 133,
                'item_id' => 1012,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000},{"order_by":3,"option_price":9000}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[75,76,77]}',
                'is_required' => 1,
            ),
            102 =>
            array (
                'id' => 134,
                'item_id' => 1012,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Black","Green","Blue","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0},{"order_by":4,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[78,79,80,81]}',
                'is_required' => 1,
            ),
            103 =>
            array (
                'id' => 135,
                'item_id' => 1013,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["6 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[82,83]}',
                'is_required' => 1,
            ),
            104 =>
            array (
                'id' => 136,
                'item_id' => 1013,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","128 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[84,85]}',
                'is_required' => 1,
            ),
            105 =>
            array (
                'id' => 137,
                'item_id' => 1013,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Green","Black","Pink"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0},{"order_by":3,"option_price":0}],"option_price_type":["Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active"],"inventory_id":[86,87,88]}',
                'is_required' => 1,
            ),
            106 =>
            array (
                'id' => 138,
                'item_id' => 1014,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["4 GB","8 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[89,90]}',
                'is_required' => 1,
            ),
            107 =>
            array (
                'id' => 139,
                'item_id' => 1014,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["64 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[91,92]}',
                'is_required' => 1,
            ),
            108 =>
            array (
                'id' => 140,
                'item_id' => 1014,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["64 GB","256 GB"],"option_price":[{"order_by":1,"option_price":5000},{"order_by":2,"option_price":7000}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[93,94]}',
                'is_required' => 1,
            ),
            109 =>
            array (
                'id' => 141,
                'item_id' => 1046,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":0},{"order_by":2,"option_price":0}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[100,101]}',
                'is_required' => 1,
            ),
            110 =>
            array (
                'id' => 142,
                'item_id' => 1046,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["128 GB","256 GB","512 GB","1 TB"],"option_price":[{"order_by":1,"option_price":500},{"order_by":2,"option_price":700},{"order_by":3,"option_price":1000},{"order_by":4,"option_price":1500}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[102,103,104,105]}',
                'is_required' => 1,
            ),
            111 =>
            array (
                'id' => 143,
                'item_id' => 1047,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["Black","White"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[106,107]}',
                'is_required' => 1,
            ),
            112 =>
            array (
                'id' => 144,
                'item_id' => 1047,
                'name' => 'Memory Card',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["128 GB","256 GB","512 GB","1 TB"],"option_price":[{"order_by":1,"option_price":"500.00000000"},{"order_by":2,"option_price":"700.00000000"},{"order_by":3,"option_price":"1000.00000000"},{"order_by":4,"option_price":"1500.00000000"}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[108,109,110,111]}',
                'is_required' => 1,
            ),
            113 =>
            array (
                'id' => 145,
                'item_id' => 1048,
                'name' => 'RAM',
                'type' => 'dropdown',
                'order_by' => 1,
                'payloads' => '{"label":["2 GB","4 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[112,113]}',
                'is_required' => 1,
            ),
            114 =>
            array (
                'id' => 146,
                'item_id' => 1048,
                'name' => 'Storage',
                'type' => 'dropdown',
                'order_by' => 2,
                'payloads' => '{"label":["32 GB","64 GB"],"option_price":[{"order_by":1,"option_price":"5000.00000000"},{"order_by":2,"option_price":"7000.00000000"}],"option_price_type":["Fixed","Fixed"],"option_status":["Active","Active"],"inventory_id":[114,115]}',
                'is_required' => 1,
            ),
            115 =>
            array (
                'id' => 147,
                'item_id' => 1048,
                'name' => 'Color',
                'type' => 'dropdown',
                'order_by' => 3,
                'payloads' => '{"label":["Blue","Grey","Black","Pink"],"option_price":[{"order_by":1,"option_price":"0.00000000"},{"order_by":2,"option_price":"0.00000000"},{"order_by":3,"option_price":"0.00000000"},{"order_by":4,"option_price":"0.00000000"}],"option_price_type":["Fixed","Fixed","Fixed","Fixed"],"option_status":["Active","Active","Active","Active"],"inventory_id":[116,117,118,119]}',
                'is_required' => 1,
            ),
        ));


    }
}
