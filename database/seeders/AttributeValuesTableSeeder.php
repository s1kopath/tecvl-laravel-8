<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeValuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_values')->delete();
        
        \DB::table('attribute_values')->insert(array (
            0 => 
            array (
                'id' => 24,
                'attribute_id' => 26,
                'value' => 'Blue',
                'order_by' => 1,
                'status' => 'Active',
            ),
            1 => 
            array (
                'id' => 25,
                'attribute_id' => 26,
                'value' => 'Grey',
                'order_by' => 2,
                'status' => 'Active',
            ),
            2 => 
            array (
                'id' => 26,
                'attribute_id' => 26,
                'value' => 'Black',
                'order_by' => 3,
                'status' => 'Active',
            ),
            3 => 
            array (
                'id' => 27,
                'attribute_id' => 26,
                'value' => 'Pink',
                'order_by' => 4,
                'status' => 'Active',
            ),
            4 => 
            array (
                'id' => 28,
                'attribute_id' => 27,
                'value' => '2 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            5 => 
            array (
                'id' => 29,
                'attribute_id' => 27,
                'value' => '4 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            6 => 
            array (
                'id' => 30,
                'attribute_id' => 28,
                'value' => '32 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            7 => 
            array (
                'id' => 31,
                'attribute_id' => 28,
                'value' => '64 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            8 => 
            array (
                'id' => 32,
                'attribute_id' => 38,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            9 => 
            array (
                'id' => 33,
                'attribute_id' => 38,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            10 => 
            array (
                'id' => 34,
                'attribute_id' => 43,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            11 => 
            array (
                'id' => 35,
                'attribute_id' => 43,
                'value' => 'Green',
                'order_by' => 2,
                'status' => 'Active',
            ),
            12 => 
            array (
                'id' => 36,
                'attribute_id' => 43,
                'value' => 'Blue',
                'order_by' => 3,
                'status' => 'Active',
            ),
            13 => 
            array (
                'id' => 37,
                'attribute_id' => 43,
                'value' => 'Pink',
                'order_by' => 4,
                'status' => 'Active',
            ),
            14 => 
            array (
                'id' => 38,
                'attribute_id' => 44,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            15 => 
            array (
                'id' => 39,
                'attribute_id' => 44,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            16 => 
            array (
                'id' => 40,
                'attribute_id' => 44,
                'value' => '16 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            17 => 
            array (
                'id' => 41,
                'attribute_id' => 45,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            18 => 
            array (
                'id' => 42,
                'attribute_id' => 45,
                'value' => '128 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            19 => 
            array (
                'id' => 43,
                'attribute_id' => 45,
                'value' => '256 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            20 => 
            array (
                'id' => 44,
                'attribute_id' => 49,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            21 => 
            array (
                'id' => 45,
                'attribute_id' => 49,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            22 => 
            array (
                'id' => 46,
                'attribute_id' => 60,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            23 => 
            array (
                'id' => 47,
                'attribute_id' => 60,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            24 => 
            array (
                'id' => 48,
                'attribute_id' => 60,
                'value' => 'Pink',
                'order_by' => 3,
                'status' => 'Active',
            ),
            25 => 
            array (
                'id' => 49,
                'attribute_id' => 61,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            26 => 
            array (
                'id' => 50,
                'attribute_id' => 61,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            27 => 
            array (
                'id' => 51,
                'attribute_id' => 61,
                'value' => '16 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            28 => 
            array (
                'id' => 52,
                'attribute_id' => 62,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            29 => 
            array (
                'id' => 53,
                'attribute_id' => 62,
                'value' => '128 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            30 => 
            array (
                'id' => 54,
                'attribute_id' => 62,
                'value' => '256 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            31 => 
            array (
                'id' => 55,
                'attribute_id' => 66,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            32 => 
            array (
                'id' => 56,
                'attribute_id' => 66,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            33 => 
            array (
                'id' => 57,
                'attribute_id' => 142,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            34 => 
            array (
                'id' => 58,
                'attribute_id' => 142,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            35 => 
            array (
                'id' => 59,
                'attribute_id' => 142,
                'value' => 'Pink',
                'order_by' => 3,
                'status' => 'Active',
            ),
            36 => 
            array (
                'id' => 60,
                'attribute_id' => 143,
                'value' => '6 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            37 => 
            array (
                'id' => 61,
                'attribute_id' => 143,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            38 => 
            array (
                'id' => 62,
                'attribute_id' => 144,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            39 => 
            array (
                'id' => 63,
                'attribute_id' => 144,
                'value' => '128 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            40 => 
            array (
                'id' => 64,
                'attribute_id' => 148,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            41 => 
            array (
                'id' => 65,
                'attribute_id' => 148,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            42 => 
            array (
                'id' => 66,
                'attribute_id' => 159,
                'value' => 'Blue',
                'order_by' => 1,
                'status' => 'Active',
            ),
            43 => 
            array (
                'id' => 67,
                'attribute_id' => 159,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            44 => 
            array (
                'id' => 68,
                'attribute_id' => 160,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            45 => 
            array (
                'id' => 69,
                'attribute_id' => 160,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            46 => 
            array (
                'id' => 70,
                'attribute_id' => 161,
                'value' => '128 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            47 => 
            array (
                'id' => 71,
                'attribute_id' => 161,
                'value' => '256 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            48 => 
            array (
                'id' => 72,
                'attribute_id' => 165,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            49 => 
            array (
                'id' => 73,
                'attribute_id' => 165,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            50 => 
            array (
                'id' => 74,
                'attribute_id' => 176,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            51 => 
            array (
                'id' => 75,
                'attribute_id' => 176,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            52 => 
            array (
                'id' => 76,
                'attribute_id' => 176,
                'value' => 'Pink',
                'order_by' => 3,
                'status' => 'Active',
            ),
            53 => 
            array (
                'id' => 77,
                'attribute_id' => 177,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            54 => 
            array (
                'id' => 78,
                'attribute_id' => 177,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            55 => 
            array (
                'id' => 83,
                'attribute_id' => 180,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            56 => 
            array (
                'id' => 84,
                'attribute_id' => 180,
                'value' => '128 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            57 => 
            array (
                'id' => 85,
                'attribute_id' => 180,
                'value' => '256 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            58 => 
            array (
                'id' => 86,
                'attribute_id' => 184,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            59 => 
            array (
                'id' => 87,
                'attribute_id' => 184,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            60 => 
            array (
                'id' => 88,
                'attribute_id' => 195,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            61 => 
            array (
                'id' => 89,
                'attribute_id' => 195,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            62 => 
            array (
                'id' => 90,
                'attribute_id' => 196,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            63 => 
            array (
                'id' => 91,
                'attribute_id' => 196,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            64 => 
            array (
                'id' => 92,
                'attribute_id' => 197,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            65 => 
            array (
                'id' => 93,
                'attribute_id' => 197,
                'value' => '256 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            66 => 
            array (
                'id' => 94,
                'attribute_id' => 201,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            67 => 
            array (
                'id' => 95,
                'attribute_id' => 201,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            68 => 
            array (
                'id' => 96,
                'attribute_id' => 210,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            69 => 
            array (
                'id' => 97,
                'attribute_id' => 210,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            70 => 
            array (
                'id' => 98,
                'attribute_id' => 210,
                'value' => 'Pink',
                'order_by' => 3,
                'status' => 'Active',
            ),
            71 => 
            array (
                'id' => 99,
                'attribute_id' => 211,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            72 => 
            array (
                'id' => 100,
                'attribute_id' => 211,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            73 => 
            array (
                'id' => 101,
                'attribute_id' => 212,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            74 => 
            array (
                'id' => 102,
                'attribute_id' => 212,
                'value' => '256 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            75 => 
            array (
                'id' => 103,
                'attribute_id' => 216,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            76 => 
            array (
                'id' => 104,
                'attribute_id' => 216,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            77 => 
            array (
                'id' => 105,
                'attribute_id' => 225,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            78 => 
            array (
                'id' => 106,
                'attribute_id' => 225,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            79 => 
            array (
                'id' => 107,
                'attribute_id' => 225,
                'value' => 'Blue',
                'order_by' => 3,
                'status' => 'Active',
            ),
            80 => 
            array (
                'id' => 108,
                'attribute_id' => 225,
                'value' => 'White',
                'order_by' => 4,
                'status' => 'Active',
            ),
            81 => 
            array (
                'id' => 109,
                'attribute_id' => 225,
                'value' => 'Red',
                'order_by' => 5,
                'status' => 'Active',
            ),
            82 => 
            array (
                'id' => 110,
                'attribute_id' => 226,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            83 => 
            array (
                'id' => 111,
                'attribute_id' => 226,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            84 => 
            array (
                'id' => 112,
                'attribute_id' => 226,
                'value' => '16 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            85 => 
            array (
                'id' => 113,
                'attribute_id' => 226,
                'value' => '32 GB',
                'order_by' => 4,
                'status' => 'Active',
            ),
            86 => 
            array (
                'id' => 114,
                'attribute_id' => 227,
                'value' => '64 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            87 => 
            array (
                'id' => 115,
                'attribute_id' => 227,
                'value' => '128 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            88 => 
            array (
                'id' => 116,
                'attribute_id' => 227,
                'value' => '256 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            89 => 
            array (
                'id' => 117,
                'attribute_id' => 231,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            90 => 
            array (
                'id' => 118,
                'attribute_id' => 231,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            91 => 
            array (
                'id' => 119,
                'attribute_id' => 243,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            92 => 
            array (
                'id' => 120,
                'attribute_id' => 243,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            93 => 
            array (
                'id' => 121,
                'attribute_id' => 244,
                'value' => '2 MB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            94 => 
            array (
                'id' => 122,
                'attribute_id' => 244,
                'value' => '4 MB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            95 => 
            array (
                'id' => 123,
                'attribute_id' => 245,
                'value' => '4 MB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            96 => 
            array (
                'id' => 124,
                'attribute_id' => 245,
                'value' => '8 MB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            97 => 
            array (
                'id' => 125,
                'attribute_id' => 249,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            98 => 
            array (
                'id' => 126,
                'attribute_id' => 249,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            99 => 
            array (
                'id' => 127,
                'attribute_id' => 258,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            100 => 
            array (
                'id' => 128,
                'attribute_id' => 258,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            101 => 
            array (
                'id' => 129,
                'attribute_id' => 261,
                'value' => 'Dual Sim',
                'order_by' => 1,
                'status' => 'Active',
            ),
            102 => 
            array (
                'id' => 130,
                'attribute_id' => 261,
                'value' => 'Single Sim',
                'order_by' => 2,
                'status' => 'Active',
            ),
            103 => 
            array (
                'id' => 135,
                'attribute_id' => 275,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            104 => 
            array (
                'id' => 136,
                'attribute_id' => 275,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            105 => 
            array (
                'id' => 137,
                'attribute_id' => 280,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            106 => 
            array (
                'id' => 138,
                'attribute_id' => 280,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            107 => 
            array (
                'id' => 139,
                'attribute_id' => 280,
                'value' => '16 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            108 => 
            array (
                'id' => 140,
                'attribute_id' => 281,
                'value' => '128 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            109 => 
            array (
                'id' => 141,
                'attribute_id' => 281,
                'value' => '256 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            110 => 
            array (
                'id' => 142,
                'attribute_id' => 281,
                'value' => '512 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            111 => 
            array (
                'id' => 143,
                'attribute_id' => 288,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            112 => 
            array (
                'id' => 144,
                'attribute_id' => 288,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            113 => 
            array (
                'id' => 145,
                'attribute_id' => 289,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            114 => 
            array (
                'id' => 146,
                'attribute_id' => 289,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            115 => 
            array (
                'id' => 147,
                'attribute_id' => 289,
                'value' => '16 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            116 => 
            array (
                'id' => 148,
                'attribute_id' => 290,
                'value' => '128 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            117 => 
            array (
                'id' => 149,
                'attribute_id' => 290,
                'value' => '256 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            118 => 
            array (
                'id' => 150,
                'attribute_id' => 290,
                'value' => '512 GB',
                'order_by' => 3,
                'status' => 'Active',
            ),
            119 => 
            array (
                'id' => 151,
                'attribute_id' => 301,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            120 => 
            array (
                'id' => 152,
                'attribute_id' => 301,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            121 => 
            array (
                'id' => 153,
                'attribute_id' => 302,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            122 => 
            array (
                'id' => 154,
                'attribute_id' => 302,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            123 => 
            array (
                'id' => 155,
                'attribute_id' => 303,
                'value' => '256 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            124 => 
            array (
                'id' => 156,
                'attribute_id' => 303,
                'value' => '512 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            125 => 
            array (
                'id' => 157,
                'attribute_id' => 314,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            126 => 
            array (
                'id' => 158,
                'attribute_id' => 314,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            127 => 
            array (
                'id' => 159,
                'attribute_id' => 315,
                'value' => '8 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            128 => 
            array (
                'id' => 160,
                'attribute_id' => 315,
                'value' => '16 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            129 => 
            array (
                'id' => 161,
                'attribute_id' => 316,
                'value' => '256 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            130 => 
            array (
                'id' => 162,
                'attribute_id' => 316,
                'value' => '512 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            131 => 
            array (
                'id' => 163,
                'attribute_id' => 327,
                'value' => 'Green',
                'order_by' => 1,
                'status' => 'Active',
            ),
            132 => 
            array (
                'id' => 164,
                'attribute_id' => 327,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            133 => 
            array (
                'id' => 165,
                'attribute_id' => 328,
                'value' => '4 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            134 => 
            array (
                'id' => 166,
                'attribute_id' => 328,
                'value' => '8 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            135 => 
            array (
                'id' => 167,
                'attribute_id' => 329,
                'value' => '256 GB',
                'order_by' => 1,
                'status' => 'Active',
            ),
            136 => 
            array (
                'id' => 168,
                'attribute_id' => 329,
                'value' => '512 GB',
                'order_by' => 2,
                'status' => 'Active',
            ),
            137 => 
            array (
                'id' => 169,
                'attribute_id' => 350,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            138 => 
            array (
                'id' => 170,
                'attribute_id' => 350,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            139 => 
            array (
                'id' => 171,
                'attribute_id' => 351,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            140 => 
            array (
                'id' => 172,
                'attribute_id' => 351,
                'value' => 'Silver',
                'order_by' => 2,
                'status' => 'Active',
            ),
            141 => 
            array (
                'id' => 173,
                'attribute_id' => 361,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            142 => 
            array (
                'id' => 174,
                'attribute_id' => 361,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            143 => 
            array (
                'id' => 175,
                'attribute_id' => 373,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            144 => 
            array (
                'id' => 176,
                'attribute_id' => 373,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            145 => 
            array (
                'id' => 177,
                'attribute_id' => 377,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            146 => 
            array (
                'id' => 178,
                'attribute_id' => 377,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
            147 => 
            array (
                'id' => 179,
                'attribute_id' => 390,
                'value' => 'White',
                'order_by' => 1,
                'status' => 'Active',
            ),
            148 => 
            array (
                'id' => 180,
                'attribute_id' => 390,
                'value' => 'Black',
                'order_by' => 2,
                'status' => 'Active',
            ),
            149 => 
            array (
                'id' => 181,
                'attribute_id' => 395,
                'value' => 'Black',
                'order_by' => 1,
                'status' => 'Active',
            ),
            150 => 
            array (
                'id' => 182,
                'attribute_id' => 395,
                'value' => 'White',
                'order_by' => 2,
                'status' => 'Active',
            ),
        ));
        
        
    }
}