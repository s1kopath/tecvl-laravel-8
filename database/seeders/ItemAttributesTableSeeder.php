<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemAttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_attributes')->delete();
        
        \DB::table('item_attributes')->insert(array (
            0 => 
            array (
                'id' => 69,
                'item_id' => 1017,
                'attribute_id' => 243,
                'payloads' => 'Black',
            ),
            1 => 
            array (
                'id' => 70,
                'item_id' => 1017,
                'attribute_id' => 246,
                'payloads' => 'TA-1114 / Nokia 106 DS',
            ),
            2 => 
            array (
                'id' => 71,
                'item_id' => 1017,
                'attribute_id' => 247,
                'payloads' => '106',
            ),
            3 => 
            array (
                'id' => 72,
                'item_id' => 1017,
                'attribute_id' => 248,
                'payloads' => 'Feature Phones',
            ),
            4 => 
            array (
                'id' => 73,
                'item_id' => 1017,
                'attribute_id' => 249,
                'payloads' => 'Dual Sim',
            ),
            5 => 
            array (
                'id' => 74,
                'item_id' => 1017,
                'attribute_id' => 250,
                'payloads' => 'No',
            ),
            6 => 
            array (
                'id' => 75,
                'item_id' => 1017,
                'attribute_id' => 251,
            'payloads' => '4.57 cm (1.8 inch)',
            ),
            7 => 
            array (
                'id' => 76,
                'item_id' => 1017,
                'attribute_id' => 252,
                'payloads' => '128 x 160 Pixels',
            ),
            8 => 
            array (
                'id' => 77,
                'item_id' => 1017,
                'attribute_id' => 253,
                'payloads' => '2G',
            ),
            9 => 
            array (
                'id' => 78,
                'item_id' => 1017,
                'attribute_id' => 257,
                'payloads' => '800 mAh',
            ),
            10 => 
            array (
                'id' => 79,
                'item_id' => 1018,
                'attribute_id' => 243,
                'payloads' => 'White',
            ),
            11 => 
            array (
                'id' => 80,
                'item_id' => 1018,
                'attribute_id' => 246,
                'payloads' => 'TA-1373/NOKIA 110 4G DS',
            ),
            12 => 
            array (
                'id' => 81,
                'item_id' => 1018,
                'attribute_id' => 247,
                'payloads' => '110 4G',
            ),
            13 => 
            array (
                'id' => 82,
                'item_id' => 1018,
                'attribute_id' => 248,
                'payloads' => 'Feature Phones',
            ),
            14 => 
            array (
                'id' => 83,
                'item_id' => 1018,
                'attribute_id' => 249,
                'payloads' => 'Dual Sim',
            ),
            15 => 
            array (
                'id' => 84,
                'item_id' => 1018,
                'attribute_id' => 250,
                'payloads' => 'No',
            ),
            16 => 
            array (
                'id' => 85,
                'item_id' => 1018,
                'attribute_id' => 251,
            'payloads' => '4.57 cm (1.8 inch)',
            ),
            17 => 
            array (
                'id' => 86,
                'item_id' => 1018,
                'attribute_id' => 252,
                'payloads' => '128 x 160 Pixels',
            ),
            18 => 
            array (
                'id' => 87,
                'item_id' => 1018,
                'attribute_id' => 253,
                'payloads' => '4G',
            ),
            19 => 
            array (
                'id' => 88,
                'item_id' => 1018,
                'attribute_id' => 257,
                'payloads' => '1020 mAh',
            ),
            20 => 
            array (
                'id' => 89,
                'item_id' => 1019,
                'attribute_id' => 258,
                'payloads' => 'Black',
            ),
            21 => 
            array (
                'id' => 90,
                'item_id' => 1019,
                'attribute_id' => 259,
                'payloads' => 'SM-B315E',
            ),
            22 => 
            array (
                'id' => 91,
                'item_id' => 1019,
                'attribute_id' => 260,
                'payloads' => 'GURU MUSIC 2',
            ),
            23 => 
            array (
                'id' => 92,
                'item_id' => 1019,
                'attribute_id' => 261,
                'payloads' => 'Dual Sim',
            ),
            24 => 
            array (
                'id' => 93,
                'item_id' => 1019,
                'attribute_id' => 262,
                'payloads' => 'No',
            ),
            25 => 
            array (
                'id' => 94,
                'item_id' => 1019,
                'attribute_id' => 263,
            'payloads' => '5.08 cm (2 inch)',
            ),
            26 => 
            array (
                'id' => 95,
                'item_id' => 1019,
                'attribute_id' => 264,
                'payloads' => '128 x 160 Pixels',
            ),
            27 => 
            array (
                'id' => 96,
                'item_id' => 1019,
                'attribute_id' => 265,
                'payloads' => 'GSM 900 / 1800 - SIM 1 & SIM 2',
            ),
            28 => 
            array (
                'id' => 97,
                'item_id' => 1019,
                'attribute_id' => 266,
                'payloads' => '2G',
            ),
            29 => 
            array (
                'id' => 98,
                'item_id' => 1019,
                'attribute_id' => 267,
                'payloads' => 'No',
            ),
            30 => 
            array (
                'id' => 99,
                'item_id' => 1019,
                'attribute_id' => 268,
                'payloads' => 'Normal',
            ),
            31 => 
            array (
                'id' => 100,
                'item_id' => 1019,
                'attribute_id' => 269,
                'payloads' => '800 mAh',
            ),
            32 => 
            array (
                'id' => 101,
                'item_id' => 1019,
                'attribute_id' => 270,
                'payloads' => '74.98 g',
            ),
            33 => 
            array (
                'id' => 102,
                'item_id' => 1020,
                'attribute_id' => 258,
                'payloads' => 'White',
            ),
            34 => 
            array (
                'id' => 103,
                'item_id' => 1020,
                'attribute_id' => 259,
                'payloads' => 'GT-E1215ZKAINS',
            ),
            35 => 
            array (
                'id' => 104,
                'item_id' => 1020,
                'attribute_id' => 260,
                'payloads' => 'GURU 1200',
            ),
            36 => 
            array (
                'id' => 105,
                'item_id' => 1020,
                'attribute_id' => 262,
                'payloads' => 'No',
            ),
            37 => 
            array (
                'id' => 106,
                'item_id' => 1020,
                'attribute_id' => 263,
            'payloads' => '3.86 cm (1.52 inch)',
            ),
            38 => 
            array (
                'id' => 107,
                'item_id' => 1020,
                'attribute_id' => 264,
                'payloads' => '128X128',
            ),
            39 => 
            array (
                'id' => 108,
                'item_id' => 1020,
                'attribute_id' => 266,
                'payloads' => '2G',
            ),
            40 => 
            array (
                'id' => 109,
                'item_id' => 1020,
                'attribute_id' => 267,
                'payloads' => 'No',
            ),
            41 => 
            array (
                'id' => 110,
                'item_id' => 1020,
                'attribute_id' => 268,
                'payloads' => 'Normal',
            ),
            42 => 
            array (
                'id' => 111,
                'item_id' => 1020,
                'attribute_id' => 269,
                'payloads' => '800 mAh',
            ),
            43 => 
            array (
                'id' => 114,
                'item_id' => 1022,
                'attribute_id' => 281,
                'payloads' => '256 GB',
            ),
            44 => 
            array (
                'id' => 115,
                'item_id' => 1022,
                'attribute_id' => 280,
                'payloads' => '8 GB',
            ),
            45 => 
            array (
                'id' => 116,
                'item_id' => 1022,
                'attribute_id' => 273,
                'payloads' => '14s- dy2506TU',
            ),
            46 => 
            array (
                'id' => 117,
                'item_id' => 1022,
                'attribute_id' => 274,
                'payloads' => '14s- dy2506TU',
            ),
            47 => 
            array (
                'id' => 118,
                'item_id' => 1022,
                'attribute_id' => 275,
                'payloads' => 'White',
            ),
            48 => 
            array (
                'id' => 119,
                'item_id' => 1022,
                'attribute_id' => 276,
                'payloads' => '3 Cell',
            ),
            49 => 
            array (
                'id' => 120,
                'item_id' => 1022,
                'attribute_id' => 277,
                'payloads' => 'Intel',
            ),
            50 => 
            array (
                'id' => 121,
                'item_id' => 1022,
                'attribute_id' => 278,
                'payloads' => 'Core i3',
            ),
            51 => 
            array (
                'id' => 122,
                'item_id' => 1022,
                'attribute_id' => 279,
                'payloads' => '11th Gen',
            ),
            52 => 
            array (
                'id' => 123,
                'item_id' => 1022,
                'attribute_id' => 282,
                'payloads' => '4',
            ),
            53 => 
            array (
                'id' => 124,
                'item_id' => 1022,
                'attribute_id' => 283,
                'payloads' => 'Windows 11 Home',
            ),
            54 => 
            array (
                'id' => 125,
                'item_id' => 1022,
                'attribute_id' => 284,
                'payloads' => '64 bit',
            ),
            55 => 
            array (
                'id' => 126,
                'item_id' => 1022,
                'attribute_id' => 285,
            'payloads' => '35.56 cm (14 inch)',
            ),
            56 => 
            array (
                'id' => 127,
                'item_id' => 1022,
                'attribute_id' => 286,
                'payloads' => '1920 x 1080 Pixel',
            ),
            57 => 
            array (
                'id' => 128,
                'item_id' => 1022,
                'attribute_id' => 287,
                'payloads' => '1.46 kg',
            ),
            58 => 
            array (
                'id' => 129,
                'item_id' => 1023,
                'attribute_id' => 281,
                'payloads' => '512 GB',
            ),
            59 => 
            array (
                'id' => 130,
                'item_id' => 1023,
                'attribute_id' => 280,
                'payloads' => '16 GB',
            ),
            60 => 
            array (
                'id' => 131,
                'item_id' => 1023,
                'attribute_id' => 273,
                'payloads' => '15s-eq2143au',
            ),
            61 => 
            array (
                'id' => 132,
                'item_id' => 1023,
                'attribute_id' => 274,
                'payloads' => '15s-eq2143au',
            ),
            62 => 
            array (
                'id' => 133,
                'item_id' => 1023,
                'attribute_id' => 275,
                'payloads' => 'White',
            ),
            63 => 
            array (
                'id' => 134,
                'item_id' => 1023,
                'attribute_id' => 276,
                'payloads' => '3 cell',
            ),
            64 => 
            array (
                'id' => 135,
                'item_id' => 1023,
                'attribute_id' => 277,
                'payloads' => 'AMD',
            ),
            65 => 
            array (
                'id' => 136,
                'item_id' => 1023,
                'attribute_id' => 278,
                'payloads' => 'Ryzen 3 Quad Core',
            ),
            66 => 
            array (
                'id' => 137,
                'item_id' => 1023,
                'attribute_id' => 279,
                'payloads' => '11th Gen',
            ),
            67 => 
            array (
                'id' => 138,
                'item_id' => 1023,
                'attribute_id' => 282,
                'payloads' => '4',
            ),
            68 => 
            array (
                'id' => 139,
                'item_id' => 1023,
                'attribute_id' => 283,
                'payloads' => 'Windows 11 Home',
            ),
            69 => 
            array (
                'id' => 140,
                'item_id' => 1023,
                'attribute_id' => 284,
                'payloads' => '64 bit',
            ),
            70 => 
            array (
                'id' => 141,
                'item_id' => 1023,
                'attribute_id' => 287,
                'payloads' => '1.69 Kg',
            ),
            71 => 
            array (
                'id' => 142,
                'item_id' => 1024,
                'attribute_id' => 288,
                'payloads' => 'White',
            ),
            72 => 
            array (
                'id' => 143,
                'item_id' => 1024,
                'attribute_id' => 289,
                'payloads' => '16 GB',
            ),
            73 => 
            array (
                'id' => 144,
                'item_id' => 1024,
                'attribute_id' => 290,
                'payloads' => '512 GB',
            ),
            74 => 
            array (
                'id' => 145,
                'item_id' => 1024,
                'attribute_id' => 291,
                'payloads' => 'FX706HC-HX059T',
            ),
            75 => 
            array (
                'id' => 146,
                'item_id' => 1024,
                'attribute_id' => 292,
                'payloads' => 'Gaming Laptop',
            ),
            76 => 
            array (
                'id' => 147,
                'item_id' => 1024,
                'attribute_id' => 293,
                'payloads' => '4 cell',
            ),
            77 => 
            array (
                'id' => 148,
                'item_id' => 1024,
                'attribute_id' => 294,
                'payloads' => 'Intel',
            ),
            78 => 
            array (
                'id' => 149,
                'item_id' => 1024,
                'attribute_id' => 295,
                'payloads' => 'Core i5',
            ),
            79 => 
            array (
                'id' => 150,
                'item_id' => 1024,
                'attribute_id' => 296,
                'payloads' => '11th Gen',
            ),
            80 => 
            array (
                'id' => 151,
                'item_id' => 1024,
                'attribute_id' => 297,
                'payloads' => '6',
            ),
            81 => 
            array (
                'id' => 152,
                'item_id' => 1024,
                'attribute_id' => 298,
                'payloads' => '64 bit',
            ),
            82 => 
            array (
                'id' => 153,
                'item_id' => 1024,
                'attribute_id' => 299,
                'payloads' => '39.9 x 26.9 x 2.33',
            ),
            83 => 
            array (
                'id' => 154,
                'item_id' => 1024,
                'attribute_id' => 300,
                'payloads' => '2.60 kg',
            ),
            84 => 
            array (
                'id' => 155,
                'item_id' => 1025,
                'attribute_id' => 288,
                'payloads' => 'Black',
            ),
            85 => 
            array (
                'id' => 156,
                'item_id' => 1025,
                'attribute_id' => 289,
                'payloads' => '8 GB',
            ),
            86 => 
            array (
                'id' => 157,
                'item_id' => 1025,
                'attribute_id' => 290,
                'payloads' => '256 GB',
            ),
            87 => 
            array (
                'id' => 158,
                'item_id' => 1025,
                'attribute_id' => 291,
                'payloads' => 'X515JA-EJ362WS',
            ),
            88 => 
            array (
                'id' => 159,
                'item_id' => 1025,
                'attribute_id' => 292,
                'payloads' => 'Thin and Light Laptop',
            ),
            89 => 
            array (
                'id' => 160,
                'item_id' => 1025,
                'attribute_id' => 293,
                'payloads' => '2 cell',
            ),
            90 => 
            array (
                'id' => 161,
                'item_id' => 1025,
                'attribute_id' => 294,
                'payloads' => 'Intel',
            ),
            91 => 
            array (
                'id' => 162,
                'item_id' => 1025,
                'attribute_id' => 295,
                'payloads' => 'Core i3',
            ),
            92 => 
            array (
                'id' => 163,
                'item_id' => 1025,
                'attribute_id' => 296,
                'payloads' => '10th Gen',
            ),
            93 => 
            array (
                'id' => 164,
                'item_id' => 1025,
                'attribute_id' => 298,
                'payloads' => '64 bit',
            ),
            94 => 
            array (
                'id' => 165,
                'item_id' => 1025,
                'attribute_id' => 299,
                'payloads' => '360.2 x 234.9 x 19.9 mm',
            ),
            95 => 
            array (
                'id' => 166,
                'item_id' => 1025,
                'attribute_id' => 300,
                'payloads' => '1.80 kg',
            ),
            96 => 
            array (
                'id' => 167,
                'item_id' => 1026,
                'attribute_id' => 301,
                'payloads' => 'White',
            ),
            97 => 
            array (
                'id' => 168,
                'item_id' => 1026,
                'attribute_id' => 302,
                'payloads' => '8 GB',
            ),
            98 => 
            array (
                'id' => 169,
                'item_id' => 1026,
                'attribute_id' => 303,
                'payloads' => '512 GB',
            ),
            99 => 
            array (
                'id' => 170,
                'item_id' => 1026,
                'attribute_id' => 304,
                'payloads' => 'XPS 9310',
            ),
            100 => 
            array (
                'id' => 171,
                'item_id' => 1026,
                'attribute_id' => 305,
                'payloads' => 'Upto 19 hours',
            ),
            101 => 
            array (
                'id' => 172,
                'item_id' => 1026,
                'attribute_id' => 306,
                'payloads' => '4 cell',
            ),
            102 => 
            array (
                'id' => 173,
                'item_id' => 1026,
                'attribute_id' => 307,
                'payloads' => 'Intel',
            ),
            103 => 
            array (
                'id' => 174,
                'item_id' => 1026,
                'attribute_id' => 308,
                'payloads' => 'Core i5',
            ),
            104 => 
            array (
                'id' => 175,
                'item_id' => 1026,
                'attribute_id' => 309,
                'payloads' => '11th Gen',
            ),
            105 => 
            array (
                'id' => 176,
                'item_id' => 1026,
                'attribute_id' => 310,
                'payloads' => '4',
            ),
            106 => 
            array (
                'id' => 177,
                'item_id' => 1026,
                'attribute_id' => 311,
                'payloads' => '64 bit',
            ),
            107 => 
            array (
                'id' => 178,
                'item_id' => 1026,
                'attribute_id' => 312,
                'payloads' => 'Windows 10 Home',
            ),
            108 => 
            array (
                'id' => 179,
                'item_id' => 1026,
                'attribute_id' => 313,
                'payloads' => '1.2 kg',
            ),
            109 => 
            array (
                'id' => 180,
                'item_id' => 1027,
                'attribute_id' => 301,
                'payloads' => 'White',
            ),
            110 => 
            array (
                'id' => 181,
                'item_id' => 1027,
                'attribute_id' => 302,
                'payloads' => '8 GB',
            ),
            111 => 
            array (
                'id' => 182,
                'item_id' => 1027,
                'attribute_id' => 303,
                'payloads' => '512 GB',
            ),
            112 => 
            array (
                'id' => 183,
                'item_id' => 1027,
                'attribute_id' => 304,
                'payloads' => 'Vostro 3400',
            ),
            113 => 
            array (
                'id' => 184,
                'item_id' => 1027,
                'attribute_id' => 305,
                'payloads' => 'Upto 10 Hours',
            ),
            114 => 
            array (
                'id' => 185,
                'item_id' => 1027,
                'attribute_id' => 306,
                'payloads' => '3 cell',
            ),
            115 => 
            array (
                'id' => 186,
                'item_id' => 1027,
                'attribute_id' => 307,
                'payloads' => 'Intel',
            ),
            116 => 
            array (
                'id' => 187,
                'item_id' => 1027,
                'attribute_id' => 308,
                'payloads' => 'Core i5',
            ),
            117 => 
            array (
                'id' => 188,
                'item_id' => 1027,
                'attribute_id' => 309,
                'payloads' => '11th Gen',
            ),
            118 => 
            array (
                'id' => 189,
                'item_id' => 1027,
                'attribute_id' => 310,
                'payloads' => '4',
            ),
            119 => 
            array (
                'id' => 190,
                'item_id' => 1027,
                'attribute_id' => 311,
                'payloads' => '64 bit',
            ),
            120 => 
            array (
                'id' => 191,
                'item_id' => 1027,
                'attribute_id' => 312,
                'payloads' => 'Windows 10',
            ),
            121 => 
            array (
                'id' => 192,
                'item_id' => 1027,
                'attribute_id' => 313,
                'payloads' => '1.58 kg',
            ),
            122 => 
            array (
                'id' => 193,
                'item_id' => 1028,
                'attribute_id' => 314,
                'payloads' => 'Black',
            ),
            123 => 
            array (
                'id' => 194,
                'item_id' => 1028,
                'attribute_id' => 315,
                'payloads' => '16 GB',
            ),
            124 => 
            array (
                'id' => 195,
                'item_id' => 1028,
                'attribute_id' => 316,
                'payloads' => '512 GB',
            ),
            125 => 
            array (
                'id' => 196,
                'item_id' => 1028,
                'attribute_id' => 317,
                'payloads' => '15ITL6',
            ),
            126 => 
            array (
                'id' => 197,
                'item_id' => 1028,
                'attribute_id' => 318,
                'payloads' => '15ITL6',
            ),
            127 => 
            array (
                'id' => 198,
                'item_id' => 1028,
                'attribute_id' => 319,
                'payloads' => 'Intel',
            ),
            128 => 
            array (
                'id' => 199,
                'item_id' => 1028,
                'attribute_id' => 320,
                'payloads' => 'Core i3',
            ),
            129 => 
            array (
                'id' => 200,
                'item_id' => 1028,
                'attribute_id' => 321,
                'payloads' => '11th Gen',
            ),
            130 => 
            array (
                'id' => 201,
                'item_id' => 1028,
                'attribute_id' => 322,
                'payloads' => 'DDR4',
            ),
            131 => 
            array (
                'id' => 202,
                'item_id' => 1028,
                'attribute_id' => 323,
                'payloads' => '2',
            ),
            132 => 
            array (
                'id' => 203,
                'item_id' => 1028,
                'attribute_id' => 324,
                'payloads' => '64 bit',
            ),
            133 => 
            array (
                'id' => 204,
                'item_id' => 1028,
                'attribute_id' => 325,
                'payloads' => 'Windows 11 Home',
            ),
            134 => 
            array (
                'id' => 205,
                'item_id' => 1028,
                'attribute_id' => 326,
                'payloads' => '1.65 kg',
            ),
            135 => 
            array (
                'id' => 206,
                'item_id' => 1029,
                'attribute_id' => 314,
                'payloads' => 'Green',
            ),
            136 => 
            array (
                'id' => 207,
                'item_id' => 1029,
                'attribute_id' => 315,
                'payloads' => '16 GB',
            ),
            137 => 
            array (
                'id' => 208,
                'item_id' => 1029,
                'attribute_id' => 316,
                'payloads' => '512 GB',
            ),
            138 => 
            array (
                'id' => 209,
                'item_id' => 1029,
                'attribute_id' => 317,
                'payloads' => '15ALC6',
            ),
            139 => 
            array (
                'id' => 210,
                'item_id' => 1029,
                'attribute_id' => 318,
                'payloads' => '15ALC6',
            ),
            140 => 
            array (
                'id' => 211,
                'item_id' => 1029,
                'attribute_id' => 319,
                'payloads' => 'AMD',
            ),
            141 => 
            array (
                'id' => 212,
                'item_id' => 1029,
                'attribute_id' => 320,
                'payloads' => 'Ryzen 5 Hexa Core',
            ),
            142 => 
            array (
                'id' => 213,
                'item_id' => 1029,
                'attribute_id' => 321,
                'payloads' => '11th Gen',
            ),
            143 => 
            array (
                'id' => 214,
                'item_id' => 1029,
                'attribute_id' => 322,
                'payloads' => 'DDR4',
            ),
            144 => 
            array (
                'id' => 215,
                'item_id' => 1029,
                'attribute_id' => 323,
                'payloads' => '6',
            ),
            145 => 
            array (
                'id' => 216,
                'item_id' => 1029,
                'attribute_id' => 324,
                'payloads' => '64 bit',
            ),
            146 => 
            array (
                'id' => 217,
                'item_id' => 1029,
                'attribute_id' => 325,
                'payloads' => 'Windows 11 Home',
            ),
            147 => 
            array (
                'id' => 218,
                'item_id' => 1029,
                'attribute_id' => 326,
                'payloads' => '1.65 kg',
            ),
            148 => 
            array (
                'id' => 219,
                'item_id' => 1030,
                'attribute_id' => 327,
                'payloads' => 'Black',
            ),
            149 => 
            array (
                'id' => 220,
                'item_id' => 1030,
                'attribute_id' => 328,
                'payloads' => '8 GB',
            ),
            150 => 
            array (
                'id' => 221,
                'item_id' => 1030,
                'attribute_id' => 329,
                'payloads' => '512 GB',
            ),
            151 => 
            array (
                'id' => 222,
                'item_id' => 1030,
                'attribute_id' => 330,
                'payloads' => 'SF514-55TA-72VG',
            ),
            152 => 
            array (
                'id' => 223,
                'item_id' => 1030,
                'attribute_id' => 331,
                'payloads' => 'Upto 15 hours',
            ),
            153 => 
            array (
                'id' => 224,
                'item_id' => 1030,
                'attribute_id' => 332,
                'payloads' => '4 cell',
            ),
            154 => 
            array (
                'id' => 225,
                'item_id' => 1030,
                'attribute_id' => 333,
                'payloads' => 'Intel',
            ),
            155 => 
            array (
                'id' => 226,
                'item_id' => 1030,
                'attribute_id' => 334,
                'payloads' => 'Core i7',
            ),
            156 => 
            array (
                'id' => 227,
                'item_id' => 1030,
                'attribute_id' => 335,
                'payloads' => '11th Gen',
            ),
            157 => 
            array (
                'id' => 228,
                'item_id' => 1030,
                'attribute_id' => 336,
                'payloads' => '4',
            ),
            158 => 
            array (
                'id' => 229,
                'item_id' => 1030,
                'attribute_id' => 337,
                'payloads' => '64 bit',
            ),
            159 => 
            array (
                'id' => 230,
                'item_id' => 1030,
                'attribute_id' => 338,
                'payloads' => 'Windows 10 Home',
            ),
            160 => 
            array (
                'id' => 231,
                'item_id' => 1030,
                'attribute_id' => 339,
                'payloads' => '64 bit',
            ),
            161 => 
            array (
                'id' => 232,
                'item_id' => 1030,
                'attribute_id' => 340,
                'payloads' => '1.05 kg',
            ),
            162 => 
            array (
                'id' => 233,
                'item_id' => 1031,
                'attribute_id' => 327,
                'payloads' => 'Green',
            ),
            163 => 
            array (
                'id' => 234,
                'item_id' => 1031,
                'attribute_id' => 328,
                'payloads' => '4 GB',
            ),
            164 => 
            array (
                'id' => 235,
                'item_id' => 1031,
                'attribute_id' => 329,
                'payloads' => '256 GB',
            ),
            165 => 
            array (
                'id' => 236,
                'item_id' => 1031,
                'attribute_id' => 330,
                'payloads' => 'A715-75G-50TA/ A715-75G-41G/ A715-75G-52AA',
            ),
            166 => 
            array (
                'id' => 237,
                'item_id' => 1031,
                'attribute_id' => 332,
                'payloads' => '3',
            ),
            167 => 
            array (
                'id' => 238,
                'item_id' => 1031,
                'attribute_id' => 333,
                'payloads' => 'Intel',
            ),
            168 => 
            array (
                'id' => 239,
                'item_id' => 1031,
                'attribute_id' => 334,
                'payloads' => 'Core i5',
            ),
            169 => 
            array (
                'id' => 240,
                'item_id' => 1031,
                'attribute_id' => 335,
                'payloads' => '10th Gen',
            ),
            170 => 
            array (
                'id' => 241,
                'item_id' => 1031,
                'attribute_id' => 337,
                'payloads' => '64 bit',
            ),
            171 => 
            array (
                'id' => 242,
                'item_id' => 1031,
                'attribute_id' => 338,
                'payloads' => 'Windows 10 Home',
            ),
            172 => 
            array (
                'id' => 243,
                'item_id' => 1031,
                'attribute_id' => 339,
                'payloads' => '64 bit',
            ),
            173 => 
            array (
                'id' => 244,
                'item_id' => 1031,
                'attribute_id' => 340,
                'payloads' => '2.15 Kg',
            ),
            174 => 
            array (
                'id' => 245,
                'item_id' => 1010,
                'attribute_id' => 225,
                'payloads' => 'Black',
            ),
            175 => 
            array (
                'id' => 246,
                'item_id' => 1010,
                'attribute_id' => 235,
                'payloads' => 'iOS 15',
            ),
            176 => 
            array (
                'id' => 247,
                'item_id' => 1010,
                'attribute_id' => 227,
                'payloads' => '64 GB',
            ),
            177 => 
            array (
                'id' => 248,
                'item_id' => 1010,
                'attribute_id' => 231,
                'payloads' => 'Dual Sim',
            ),
            178 => 
            array (
                'id' => 249,
                'item_id' => 1010,
                'attribute_id' => 237,
                'payloads' => '5G, 4G, 3G, 2G',
            ),
            179 => 
            array (
                'id' => 250,
                'item_id' => 1010,
                'attribute_id' => 226,
                'payloads' => '32 GB',
            ),
            180 => 
            array (
                'id' => 251,
                'item_id' => 1010,
                'attribute_id' => 241,
                'payloads' => 'v5.0',
            ),
            181 => 
            array (
                'id' => 252,
                'item_id' => 1010,
                'attribute_id' => 240,
                'payloads' => '238 g',
            ),
            182 => 
            array (
                'id' => 253,
                'item_id' => 1010,
                'attribute_id' => 239,
                'payloads' => 'No',
            ),
            183 => 
            array (
                'id' => 254,
                'item_id' => 1010,
                'attribute_id' => 238,
                'payloads' => 'Nano + eSIM',
            ),
            184 => 
            array (
                'id' => 255,
                'item_id' => 1010,
                'attribute_id' => 234,
                'payloads' => 'Super Retina XDR Display',
            ),
            185 => 
            array (
                'id' => 256,
                'item_id' => 1010,
                'attribute_id' => 236,
                'payloads' => 'A15 Bionic Chip',
            ),
            186 => 
            array (
                'id' => 257,
                'item_id' => 1010,
                'attribute_id' => 233,
                'payloads' => '2778 x 1284 Pixels',
            ),
            187 => 
            array (
                'id' => 258,
                'item_id' => 1010,
                'attribute_id' => 232,
            'payloads' => '17.02 cm (6.7 inch)',
            ),
            188 => 
            array (
                'id' => 259,
                'item_id' => 1010,
                'attribute_id' => 230,
                'payloads' => 'Smartphones',
            ),
            189 => 
            array (
                'id' => 260,
                'item_id' => 1010,
                'attribute_id' => 229,
                'payloads' => 'iPhone 13 Pro Max',
            ),
            190 => 
            array (
                'id' => 261,
                'item_id' => 1010,
                'attribute_id' => 228,
                'payloads' => 'MLLJ3HN/A',
            ),
            191 => 
            array (
                'id' => 262,
                'item_id' => 1010,
                'attribute_id' => 242,
                'payloads' => 'A15 Bionic Chip',
            ),
            192 => 
            array (
                'id' => 263,
                'item_id' => 1032,
                'attribute_id' => 225,
                'payloads' => 'Red',
            ),
            193 => 
            array (
                'id' => 264,
                'item_id' => 1032,
                'attribute_id' => 235,
                'payloads' => 'iOS 14',
            ),
            194 => 
            array (
                'id' => 265,
                'item_id' => 1032,
                'attribute_id' => 227,
                'payloads' => '256 GB',
            ),
            195 => 
            array (
                'id' => 266,
                'item_id' => 1032,
                'attribute_id' => 231,
                'payloads' => 'Dual Sim',
            ),
            196 => 
            array (
                'id' => 267,
                'item_id' => 1032,
                'attribute_id' => 237,
                'payloads' => '5G, 4G, 3G, 2G',
            ),
            197 => 
            array (
                'id' => 268,
                'item_id' => 1032,
                'attribute_id' => 226,
                'payloads' => '16 GB',
            ),
            198 => 
            array (
                'id' => 269,
                'item_id' => 1032,
                'attribute_id' => 241,
                'payloads' => 'v5.0',
            ),
            199 => 
            array (
                'id' => 270,
                'item_id' => 1032,
                'attribute_id' => 240,
                'payloads' => '226 g',
            ),
            200 => 
            array (
                'id' => 271,
                'item_id' => 1032,
                'attribute_id' => 239,
                'payloads' => 'No',
            ),
            201 => 
            array (
                'id' => 272,
                'item_id' => 1032,
                'attribute_id' => 238,
                'payloads' => 'Nano + eSIM',
            ),
            202 => 
            array (
                'id' => 273,
                'item_id' => 1032,
                'attribute_id' => 234,
            'payloads' => '17.02 cm (6.7 inch)',
            ),
            203 => 
            array (
                'id' => 274,
                'item_id' => 1032,
                'attribute_id' => 233,
                'payloads' => '2778 x 1284 Pixels',
            ),
            204 => 
            array (
                'id' => 275,
                'item_id' => 1032,
                'attribute_id' => 232,
            'payloads' => '17.02 cm (6.7 inch)',
            ),
            205 => 
            array (
                'id' => 276,
                'item_id' => 1032,
                'attribute_id' => 230,
                'payloads' => 'Smartphones',
            ),
            206 => 
            array (
                'id' => 277,
                'item_id' => 1032,
                'attribute_id' => 229,
                'payloads' => 'iPhone 12 Pro Max',
            ),
            207 => 
            array (
                'id' => 278,
                'item_id' => 1032,
                'attribute_id' => 228,
                'payloads' => 'MGDK3HN/A',
            ),
            208 => 
            array (
                'id' => 279,
                'item_id' => 1032,
                'attribute_id' => 242,
                'payloads' => 'A14 Bionic Chip with Next Generation Neural Engine',
            ),
            209 => 
            array (
                'id' => 280,
                'item_id' => 1033,
                'attribute_id' => 60,
                'payloads' => 'Black',
            ),
            210 => 
            array (
                'id' => 281,
                'item_id' => 1033,
                'attribute_id' => 69,
                'payloads' => '1600 x 720 Pixels',
            ),
            211 => 
            array (
                'id' => 282,
                'item_id' => 1033,
                'attribute_id' => 75,
                'payloads' => '5000 mAh',
            ),
            212 => 
            array (
                'id' => 283,
                'item_id' => 1033,
                'attribute_id' => 74,
                'payloads' => 'Nano + Nano',
            ),
            213 => 
            array (
                'id' => 284,
                'item_id' => 1033,
                'attribute_id' => 73,
                'payloads' => '4G VOLTE, 4G, 3G, 2G',
            ),
            214 => 
            array (
                'id' => 285,
                'item_id' => 1033,
                'attribute_id' => 72,
                'payloads' => 'Octa Core',
            ),
            215 => 
            array (
                'id' => 286,
                'item_id' => 1033,
                'attribute_id' => 71,
                'payloads' => 'Android 10',
            ),
            216 => 
            array (
                'id' => 287,
                'item_id' => 1033,
                'attribute_id' => 70,
                'payloads' => 'HD+ IPS Display',
            ),
            217 => 
            array (
                'id' => 288,
                'item_id' => 1033,
                'attribute_id' => 68,
            'payloads' => '16.59 cm (6.53 inch)',
            ),
            218 => 
            array (
                'id' => 289,
                'item_id' => 1033,
                'attribute_id' => 61,
                'payloads' => '16 GB',
            ),
            219 => 
            array (
                'id' => 290,
                'item_id' => 1033,
                'attribute_id' => 67,
                'payloads' => 'Yes',
            ),
            220 => 
            array (
                'id' => 291,
                'item_id' => 1033,
                'attribute_id' => 66,
                'payloads' => 'Dual Sim',
            ),
            221 => 
            array (
                'id' => 292,
                'item_id' => 1033,
                'attribute_id' => 65,
                'payloads' => 'Smartphones',
            ),
            222 => 
            array (
                'id' => 293,
                'item_id' => 1033,
                'attribute_id' => 64,
                'payloads' => '9i Sport',
            ),
            223 => 
            array (
                'id' => 294,
                'item_id' => 1033,
                'attribute_id' => 63,
                'payloads' => 'MZB0A0XIN|MZBOBQSIN',
            ),
            224 => 
            array (
                'id' => 295,
                'item_id' => 1033,
                'attribute_id' => 62,
                'payloads' => '256 GB',
            ),
            225 => 
            array (
                'id' => 296,
                'item_id' => 1033,
                'attribute_id' => 76,
                'payloads' => '194 g',
            ),
            226 => 
            array (
                'id' => 297,
                'item_id' => 1005,
                'attribute_id' => 159,
                'payloads' => 'Blue',
            ),
            227 => 
            array (
                'id' => 298,
                'item_id' => 1005,
                'attribute_id' => 168,
                'payloads' => '2408 x 1080 Pixels',
            ),
            228 => 
            array (
                'id' => 299,
                'item_id' => 1005,
                'attribute_id' => 174,
                'payloads' => '5000 mAh',
            ),
            229 => 
            array (
                'id' => 300,
                'item_id' => 1005,
                'attribute_id' => 173,
                'payloads' => 'Nano Sim',
            ),
            230 => 
            array (
                'id' => 301,
                'item_id' => 1005,
                'attribute_id' => 172,
                'payloads' => '5G, 4G, 3G, 2G',
            ),
            231 => 
            array (
                'id' => 302,
                'item_id' => 1005,
                'attribute_id' => 171,
                'payloads' => 'Octa Core',
            ),
            232 => 
            array (
                'id' => 303,
                'item_id' => 1005,
                'attribute_id' => 170,
                'payloads' => 'Android 12',
            ),
            233 => 
            array (
                'id' => 304,
                'item_id' => 1005,
                'attribute_id' => 169,
                'payloads' => 'Full HD+ LCD Display',
            ),
            234 => 
            array (
                'id' => 305,
                'item_id' => 1005,
                'attribute_id' => 167,
            'payloads' => '16.71 cm (6.58 inch)',
            ),
            235 => 
            array (
                'id' => 306,
                'item_id' => 1005,
                'attribute_id' => 160,
                'payloads' => '8 GB',
            ),
            236 => 
            array (
                'id' => 307,
                'item_id' => 1005,
                'attribute_id' => 166,
                'payloads' => 'Yes',
            ),
            237 => 
            array (
                'id' => 308,
                'item_id' => 1005,
                'attribute_id' => 165,
                'payloads' => 'Dual Sim',
            ),
            238 => 
            array (
                'id' => 309,
                'item_id' => 1005,
                'attribute_id' => 164,
                'payloads' => 'Smartphones',
            ),
            239 => 
            array (
                'id' => 310,
                'item_id' => 1005,
                'attribute_id' => 163,
                'payloads' => 'T1 5G',
            ),
            240 => 
            array (
                'id' => 311,
                'item_id' => 1005,
                'attribute_id' => 162,
                'payloads' => 'V2141',
            ),
            241 => 
            array (
                'id' => 312,
                'item_id' => 1005,
                'attribute_id' => 161,
                'payloads' => '256 GB',
            ),
            242 => 
            array (
                'id' => 313,
                'item_id' => 1005,
                'attribute_id' => 175,
                'payloads' => '187 g',
            ),
            243 => 
            array (
                'id' => 314,
                'item_id' => 1034,
                'attribute_id' => 341,
                'payloads' => 'Canon',
            ),
            244 => 
            array (
                'id' => 315,
                'item_id' => 1034,
                'attribute_id' => 342,
                'payloads' => 'EOS 200D II',
            ),
            245 => 
            array (
                'id' => 316,
                'item_id' => 1034,
                'attribute_id' => 343,
                'payloads' => 'eos200dii',
            ),
            246 => 
            array (
                'id' => 317,
                'item_id' => 1034,
                'attribute_id' => 344,
                'payloads' => '1920 x 1080',
            ),
            247 => 
            array (
                'id' => 318,
                'item_id' => 1034,
                'attribute_id' => 345,
                'payloads' => 'TFT',
            ),
            248 => 
            array (
                'id' => 319,
                'item_id' => 1034,
                'attribute_id' => 346,
                'payloads' => '3 inch',
            ),
            249 => 
            array (
                'id' => 320,
                'item_id' => 1034,
                'attribute_id' => 347,
                'payloads' => 'Lithium',
            ),
            250 => 
            array (
                'id' => 321,
                'item_id' => 1034,
                'attribute_id' => 348,
                'payloads' => '654 g',
            ),
            251 => 
            array (
                'id' => 322,
                'item_id' => 1034,
                'attribute_id' => 349,
                'payloads' => 'CMOS',
            ),
            252 => 
            array (
                'id' => 323,
                'item_id' => 1034,
                'attribute_id' => 350,
                'payloads' => 'Black',
            ),
            253 => 
            array (
                'id' => 324,
                'item_id' => 1035,
                'attribute_id' => 341,
                'payloads' => 'Canon',
            ),
            254 => 
            array (
                'id' => 325,
                'item_id' => 1035,
                'attribute_id' => 342,
                'payloads' => '1500D',
            ),
            255 => 
            array (
                'id' => 326,
                'item_id' => 1035,
                'attribute_id' => 343,
                'payloads' => 'EOS',
            ),
            256 => 
            array (
                'id' => 327,
                'item_id' => 1035,
                'attribute_id' => 344,
                'payloads' => '1920 x 1080',
            ),
            257 => 
            array (
                'id' => 328,
                'item_id' => 1035,
                'attribute_id' => 345,
                'payloads' => 'LCD',
            ),
            258 => 
            array (
                'id' => 329,
                'item_id' => 1035,
                'attribute_id' => 346,
                'payloads' => '3 inch',
            ),
            259 => 
            array (
                'id' => 330,
                'item_id' => 1035,
                'attribute_id' => 347,
                'payloads' => 'Lithium',
            ),
            260 => 
            array (
                'id' => 331,
                'item_id' => 1035,
                'attribute_id' => 348,
                'payloads' => '427 g',
            ),
            261 => 
            array (
                'id' => 332,
                'item_id' => 1035,
                'attribute_id' => 349,
                'payloads' => 'CMOS',
            ),
            262 => 
            array (
                'id' => 333,
                'item_id' => 1035,
                'attribute_id' => 350,
                'payloads' => 'Black',
            ),
            263 => 
            array (
                'id' => 334,
                'item_id' => 1036,
                'attribute_id' => 351,
                'payloads' => 'Silver',
            ),
            264 => 
            array (
                'id' => 335,
                'item_id' => 1036,
                'attribute_id' => 352,
                'payloads' => 'FUJIFILM',
            ),
            265 => 
            array (
                'id' => 336,
                'item_id' => 1036,
                'attribute_id' => 353,
                'payloads' => 'X-T200',
            ),
            266 => 
            array (
                'id' => 337,
                'item_id' => 1036,
                'attribute_id' => 354,
                'payloads' => 'X-T200',
            ),
            267 => 
            array (
                'id' => 338,
                'item_id' => 1036,
                'attribute_id' => 355,
                'payloads' => 'Mirrorless',
            ),
            268 => 
            array (
                'id' => 339,
                'item_id' => 1036,
                'attribute_id' => 356,
                'payloads' => 'CMOS',
            ),
            269 => 
            array (
                'id' => 340,
                'item_id' => 1036,
                'attribute_id' => 357,
                'payloads' => '23.5 x 15.7',
            ),
            270 => 
            array (
                'id' => 341,
                'item_id' => 1036,
                'attribute_id' => 358,
                'payloads' => '3.5 inch',
            ),
            271 => 
            array (
                'id' => 342,
                'item_id' => 1036,
                'attribute_id' => 359,
                'payloads' => 'Yes',
            ),
            272 => 
            array (
                'id' => 343,
                'item_id' => 1036,
                'attribute_id' => 360,
                'payloads' => '370 g',
            ),
            273 => 
            array (
                'id' => 344,
                'item_id' => 1037,
                'attribute_id' => 351,
                'payloads' => 'Silver',
            ),
            274 => 
            array (
                'id' => 345,
                'item_id' => 1037,
                'attribute_id' => 352,
                'payloads' => 'FUJIFILM',
            ),
            275 => 
            array (
                'id' => 346,
                'item_id' => 1037,
                'attribute_id' => 353,
                'payloads' => 'X-T3',
            ),
            276 => 
            array (
                'id' => 347,
                'item_id' => 1037,
                'attribute_id' => 354,
                'payloads' => 'X-T3',
            ),
            277 => 
            array (
                'id' => 348,
                'item_id' => 1037,
                'attribute_id' => 355,
                'payloads' => 'Mirrorless',
            ),
            278 => 
            array (
                'id' => 349,
                'item_id' => 1037,
                'attribute_id' => 356,
                'payloads' => 'CMOS',
            ),
            279 => 
            array (
                'id' => 350,
                'item_id' => 1037,
                'attribute_id' => 357,
                'payloads' => 'X-Trans CMOS IV APS-C',
            ),
            280 => 
            array (
                'id' => 351,
                'item_id' => 1037,
                'attribute_id' => 358,
                'payloads' => '3 inch',
            ),
            281 => 
            array (
                'id' => 352,
                'item_id' => 1037,
                'attribute_id' => 359,
                'payloads' => 'Yes',
            ),
            282 => 
            array (
                'id' => 353,
                'item_id' => 1037,
                'attribute_id' => 360,
                'payloads' => '539 g',
            ),
            283 => 
            array (
                'id' => 354,
                'item_id' => 1038,
                'attribute_id' => 361,
                'payloads' => 'White',
            ),
            284 => 
            array (
                'id' => 355,
                'item_id' => 1038,
                'attribute_id' => 362,
                'payloads' => 'SONY',
            ),
            285 => 
            array (
                'id' => 356,
                'item_id' => 1038,
                'attribute_id' => 363,
                'payloads' => 'DSC-RX100M7',
            ),
            286 => 
            array (
                'id' => 357,
                'item_id' => 1038,
                'attribute_id' => 364,
                'payloads' => 'DSC-RX100M7',
            ),
            287 => 
            array (
                'id' => 358,
                'item_id' => 1038,
                'attribute_id' => 365,
                'payloads' => 'CMOS',
            ),
            288 => 
            array (
                'id' => 359,
                'item_id' => 1038,
                'attribute_id' => 366,
                'payloads' => '1 inch',
            ),
            289 => 
            array (
                'id' => 360,
                'item_id' => 1038,
                'attribute_id' => 367,
                'payloads' => '3,840 x 2,160',
            ),
            290 => 
            array (
                'id' => 361,
                'item_id' => 1038,
                'attribute_id' => 368,
                'payloads' => '4K',
            ),
            291 => 
            array (
                'id' => 362,
                'item_id' => 1038,
                'attribute_id' => 369,
                'payloads' => '3 inch',
            ),
            292 => 
            array (
                'id' => 363,
                'item_id' => 1038,
                'attribute_id' => 370,
                'payloads' => 'SD Card',
            ),
            293 => 
            array (
                'id' => 364,
                'item_id' => 1038,
                'attribute_id' => 371,
                'payloads' => '302 g',
            ),
            294 => 
            array (
                'id' => 365,
                'item_id' => 1038,
                'attribute_id' => 372,
                'payloads' => 'Zoom',
            ),
            295 => 
            array (
                'id' => 366,
                'item_id' => 1039,
                'attribute_id' => 373,
                'payloads' => 'White',
            ),
            296 => 
            array (
                'id' => 367,
                'item_id' => 1039,
                'attribute_id' => 374,
                'payloads' => 'No Brand',
            ),
            297 => 
            array (
                'id' => 368,
                'item_id' => 1039,
                'attribute_id' => 375,
                'payloads' => '1920 x 1080 /1280 x 720P',
            ),
            298 => 
            array (
                'id' => 369,
                'item_id' => 1039,
                'attribute_id' => 376,
                'payloads' => 'No Battery, No Explosion, More Safe',
            ),
            299 => 
            array (
                'id' => 370,
                'item_id' => 1040,
                'attribute_id' => 373,
                'payloads' => 'White',
            ),
            300 => 
            array (
                'id' => 371,
                'item_id' => 1040,
                'attribute_id' => 374,
                'payloads' => 'Xiaomi 70mai',
            ),
            301 => 
            array (
                'id' => 372,
                'item_id' => 1041,
                'attribute_id' => 377,
                'payloads' => 'Black',
            ),
            302 => 
            array (
                'id' => 373,
                'item_id' => 1041,
                'attribute_id' => 378,
                'payloads' => 'SJCAM',
            ),
            303 => 
            array (
                'id' => 374,
                'item_id' => 1041,
                'attribute_id' => 379,
                'payloads' => 'SJ4000 Air 4K',
            ),
            304 => 
            array (
                'id' => 375,
                'item_id' => 1041,
                'attribute_id' => 380,
                'payloads' => '4000 Air 4K Full HD WiFi 30M Waterproof Sports Action Camera Waterproof DV Camcorder 16MP',
            ),
            305 => 
            array (
                'id' => 376,
                'item_id' => 1041,
                'attribute_id' => 381,
                'payloads' => '1080 FHD 1920*1080 720p 1280*720 60fps 720p 1280*720 30fps WVGA 848*480 VGA 640*480',
            ),
            306 => 
            array (
                'id' => 377,
                'item_id' => 1041,
                'attribute_id' => 382,
                'payloads' => '1080 FHD',
            ),
            307 => 
            array (
                'id' => 378,
                'item_id' => 1041,
                'attribute_id' => 383,
                'payloads' => 'MOV',
            ),
            308 => 
            array (
                'id' => 379,
                'item_id' => 1041,
                'attribute_id' => 384,
                'payloads' => 'CMOS',
            ),
            309 => 
            array (
                'id' => 380,
                'item_id' => 1041,
                'attribute_id' => 385,
                'payloads' => '1/3.2',
            ),
            310 => 
            array (
                'id' => 381,
                'item_id' => 1041,
                'attribute_id' => 386,
                'payloads' => 'LTPS LCD',
            ),
            311 => 
            array (
                'id' => 382,
                'item_id' => 1041,
                'attribute_id' => 387,
                'payloads' => '2 inch',
            ),
            312 => 
            array (
                'id' => 383,
                'item_id' => 1041,
                'attribute_id' => 388,
                'payloads' => '1920*1080',
            ),
            313 => 
            array (
                'id' => 384,
                'item_id' => 1041,
                'attribute_id' => 389,
                'payloads' => 'Li-ion Battery',
            ),
            314 => 
            array (
                'id' => 385,
                'item_id' => 1042,
                'attribute_id' => 377,
                'payloads' => 'Black',
            ),
            315 => 
            array (
                'id' => 386,
                'item_id' => 1042,
                'attribute_id' => 378,
                'payloads' => 'SJCAM',
            ),
            316 => 
            array (
                'id' => 387,
                'item_id' => 1042,
                'attribute_id' => 379,
                'payloads' => 'SJ6 Legend',
            ),
            317 => 
            array (
                'id' => 388,
                'item_id' => 1042,
                'attribute_id' => 380,
                'payloads' => 'SJ6 Legend',
            ),
            318 => 
            array (
                'id' => 389,
                'item_id' => 1042,
                'attribute_id' => 381,
                'payloads' => '4K, 1080P, 720P',
            ),
            319 => 
            array (
                'id' => 390,
                'item_id' => 1042,
                'attribute_id' => 382,
                'payloads' => '4K/24FPS',
            ),
            320 => 
            array (
                'id' => 391,
                'item_id' => 1042,
                'attribute_id' => 383,
                'payloads' => 'MP4',
            ),
            321 => 
            array (
                'id' => 392,
                'item_id' => 1042,
                'attribute_id' => 384,
                'payloads' => 'CMOS',
            ),
            322 => 
            array (
                'id' => 393,
                'item_id' => 1042,
                'attribute_id' => 385,
                'payloads' => '0.3',
            ),
            323 => 
            array (
                'id' => 394,
                'item_id' => 1042,
                'attribute_id' => 386,
                'payloads' => 'LCD',
            ),
            324 => 
            array (
                'id' => 395,
                'item_id' => 1042,
                'attribute_id' => 387,
                'payloads' => '2 inch',
            ),
            325 => 
            array (
                'id' => 396,
                'item_id' => 1042,
                'attribute_id' => 388,
                'payloads' => '480/240',
            ),
            326 => 
            array (
                'id' => 397,
                'item_id' => 1042,
                'attribute_id' => 389,
                'payloads' => 'Lithium Battery',
            ),
            327 => 
            array (
                'id' => 398,
                'item_id' => 1043,
                'attribute_id' => 390,
                'payloads' => 'Black',
            ),
            328 => 
            array (
                'id' => 399,
                'item_id' => 1043,
                'attribute_id' => 391,
                'payloads' => 'Wireless HD IP Double Antenna Security Camera With Live View',
            ),
            329 => 
            array (
                'id' => 400,
                'item_id' => 1043,
                'attribute_id' => 392,
                'payloads' => 'Wireless HD IP Double Antenna With Live View',
            ),
            330 => 
            array (
                'id' => 401,
                'item_id' => 1043,
                'attribute_id' => 393,
                'payloads' => 'Memory Card',
            ),
            331 => 
            array (
                'id' => 402,
                'item_id' => 1044,
                'attribute_id' => 390,
                'payloads' => 'White',
            ),
            332 => 
            array (
                'id' => 403,
                'item_id' => 1044,
                'attribute_id' => 391,
                'payloads' => 'V380 PRO',
            ),
            333 => 
            array (
                'id' => 404,
                'item_id' => 1044,
                'attribute_id' => 392,
                'payloads' => 'V380 Pro Home IP Dual Antenna Wireless CCTV Camera with Night Vision and SD Card Slot, Compatible with All Android and iOS Devices Security Camera',
            ),
            334 => 
            array (
                'id' => 405,
                'item_id' => 1001,
                'attribute_id' => 26,
                'payloads' => 'Pink',
            ),
            335 => 
            array (
                'id' => 406,
                'item_id' => 1001,
                'attribute_id' => 27,
                'payloads' => '4 GB',
            ),
            336 => 
            array (
                'id' => 407,
                'item_id' => 1001,
                'attribute_id' => 28,
                'payloads' => '64 GB',
            ),
            337 => 
            array (
                'id' => 408,
                'item_id' => 1001,
                'attribute_id' => 29,
                'payloads' => 'RMX3081',
            ),
            338 => 
            array (
                'id' => 409,
                'item_id' => 1001,
                'attribute_id' => 30,
                'payloads' => '8 Pro',
            ),
            339 => 
            array (
                'id' => 410,
                'item_id' => 1001,
                'attribute_id' => 31,
                'payloads' => 'Yes',
            ),
            340 => 
            array (
                'id' => 411,
                'item_id' => 1001,
                'attribute_id' => 32,
                'payloads' => 'Smartphones',
            ),
            341 => 
            array (
                'id' => 412,
                'item_id' => 1001,
                'attribute_id' => 33,
            'payloads' => '16.26 cm (6.4 inch)',
            ),
            342 => 
            array (
                'id' => 413,
                'item_id' => 1001,
                'attribute_id' => 34,
                'payloads' => '2400 x 1080 Pixels',
            ),
            343 => 
            array (
                'id' => 414,
                'item_id' => 1001,
                'attribute_id' => 35,
                'payloads' => 'Full HD+ Super AMOLED Display',
            ),
            344 => 
            array (
                'id' => 415,
                'item_id' => 1001,
                'attribute_id' => 36,
                'payloads' => 'Android 11',
            ),
            345 => 
            array (
                'id' => 416,
                'item_id' => 1001,
                'attribute_id' => 37,
                'payloads' => 'Qualcomm Snapdragon 720G',
            ),
            346 => 
            array (
                'id' => 417,
                'item_id' => 1001,
                'attribute_id' => 38,
                'payloads' => 'Dual Sim',
            ),
            347 => 
            array (
                'id' => 418,
                'item_id' => 1001,
                'attribute_id' => 39,
                'payloads' => '4G VOLTE, 4G, 3G, 2G',
            ),
            348 => 
            array (
                'id' => 419,
                'item_id' => 1001,
                'attribute_id' => 40,
                'payloads' => '4500 mAh',
            ),
            349 => 
            array (
                'id' => 420,
                'item_id' => 1001,
                'attribute_id' => 41,
                'payloads' => '176 g',
            ),
            350 => 
            array (
                'id' => 421,
                'item_id' => 1001,
                'attribute_id' => 42,
                'payloads' => 'Nano + Nano',
            ),
            351 => 
            array (
                'id' => 422,
                'item_id' => 1002,
                'attribute_id' => 43,
                'payloads' => 'Green',
            ),
            352 => 
            array (
                'id' => 423,
                'item_id' => 1002,
                'attribute_id' => 44,
                'payloads' => '8 GB',
            ),
            353 => 
            array (
                'id' => 424,
                'item_id' => 1002,
                'attribute_id' => 45,
                'payloads' => '128 GB',
            ),
            354 => 
            array (
                'id' => 425,
                'item_id' => 1002,
                'attribute_id' => 46,
                'payloads' => 'SM-A325FZKHINS',
            ),
            355 => 
            array (
                'id' => 426,
                'item_id' => 1002,
                'attribute_id' => 47,
                'payloads' => 'Galaxy A32',
            ),
            356 => 
            array (
                'id' => 427,
                'item_id' => 1002,
                'attribute_id' => 48,
                'payloads' => 'Smartphones',
            ),
            357 => 
            array (
                'id' => 428,
                'item_id' => 1002,
                'attribute_id' => 49,
                'payloads' => 'Dual Sim',
            ),
            358 => 
            array (
                'id' => 429,
                'item_id' => 1002,
                'attribute_id' => 50,
            'payloads' => '16.26 cm (6.4 inch)',
            ),
            359 => 
            array (
                'id' => 430,
                'item_id' => 1002,
                'attribute_id' => 51,
                'payloads' => '1080 x 2400$$pixels',
            ),
            360 => 
            array (
                'id' => 431,
                'item_id' => 1002,
                'attribute_id' => 52,
                'payloads' => 'Super AMOLED Display',
            ),
            361 => 
            array (
                'id' => 432,
                'item_id' => 1002,
                'attribute_id' => 53,
                'payloads' => 'Android 11',
            ),
            362 => 
            array (
                'id' => 433,
                'item_id' => 1002,
                'attribute_id' => 54,
                'payloads' => 'Mediatek Helio G80',
            ),
            363 => 
            array (
                'id' => 434,
                'item_id' => 1002,
                'attribute_id' => 55,
                'payloads' => 'Octa Core',
            ),
            364 => 
            array (
                'id' => 435,
                'item_id' => 1002,
                'attribute_id' => 56,
                'payloads' => '4G',
            ),
            365 => 
            array (
                'id' => 436,
                'item_id' => 1002,
                'attribute_id' => 57,
                'payloads' => 'Nano',
            ),
            366 => 
            array (
                'id' => 437,
                'item_id' => 1002,
                'attribute_id' => 58,
                'payloads' => '5000 mAh',
            ),
            367 => 
            array (
                'id' => 438,
                'item_id' => 1002,
                'attribute_id' => 59,
                'payloads' => '184 g',
            ),
            368 => 
            array (
                'id' => 439,
                'item_id' => 1003,
                'attribute_id' => 60,
                'payloads' => 'Black',
            ),
            369 => 
            array (
                'id' => 440,
                'item_id' => 1003,
                'attribute_id' => 61,
                'payloads' => '8 GB',
            ),
            370 => 
            array (
                'id' => 441,
                'item_id' => 1003,
                'attribute_id' => 62,
                'payloads' => '128 GB',
            ),
            371 => 
            array (
                'id' => 442,
                'item_id' => 1003,
                'attribute_id' => 63,
                'payloads' => 'MZB9627IN',
            ),
            372 => 
            array (
                'id' => 443,
                'item_id' => 1003,
                'attribute_id' => 64,
                'payloads' => 'M2 Pro',
            ),
            373 => 
            array (
                'id' => 444,
                'item_id' => 1003,
                'attribute_id' => 65,
                'payloads' => 'Smartphones',
            ),
            374 => 
            array (
                'id' => 445,
                'item_id' => 1003,
                'attribute_id' => 66,
                'payloads' => 'Dual Sim',
            ),
            375 => 
            array (
                'id' => 446,
                'item_id' => 1003,
                'attribute_id' => 67,
                'payloads' => 'Yes',
            ),
            376 => 
            array (
                'id' => 447,
                'item_id' => 1003,
                'attribute_id' => 68,
            'payloads' => '16.59 cm (6.53 inch)',
            ),
            377 => 
            array (
                'id' => 448,
                'item_id' => 1003,
                'attribute_id' => 69,
                'payloads' => '2400 x 1080 Pixels',
            ),
            378 => 
            array (
                'id' => 449,
                'item_id' => 1003,
                'attribute_id' => 70,
                'payloads' => 'Full HD+ Display',
            ),
            379 => 
            array (
                'id' => 450,
                'item_id' => 1003,
                'attribute_id' => 71,
                'payloads' => 'Android 10',
            ),
            380 => 
            array (
                'id' => 451,
                'item_id' => 1003,
                'attribute_id' => 72,
                'payloads' => 'Octa Core',
            ),
            381 => 
            array (
                'id' => 452,
                'item_id' => 1003,
                'attribute_id' => 73,
                'payloads' => '4G, 3G, 2G',
            ),
            382 => 
            array (
                'id' => 453,
                'item_id' => 1003,
                'attribute_id' => 74,
                'payloads' => 'Nano + Nano',
            ),
            383 => 
            array (
                'id' => 454,
                'item_id' => 1003,
                'attribute_id' => 75,
                'payloads' => '5000 mAh',
            ),
            384 => 
            array (
                'id' => 455,
                'item_id' => 1003,
                'attribute_id' => 76,
                'payloads' => '209 g',
            ),
            385 => 
            array (
                'id' => 456,
                'item_id' => 1004,
                'attribute_id' => 142,
                'payloads' => 'Pink',
            ),
            386 => 
            array (
                'id' => 457,
                'item_id' => 1004,
                'attribute_id' => 143,
                'payloads' => '8 GB',
            ),
            387 => 
            array (
                'id' => 458,
                'item_id' => 1004,
                'attribute_id' => 144,
                'payloads' => '128 GB',
            ),
            388 => 
            array (
                'id' => 459,
                'item_id' => 1004,
                'attribute_id' => 145,
                'payloads' => 'CPH2269',
            ),
            389 => 
            array (
                'id' => 460,
                'item_id' => 1004,
                'attribute_id' => 146,
                'payloads' => 'A16',
            ),
            390 => 
            array (
                'id' => 461,
                'item_id' => 1004,
                'attribute_id' => 147,
                'payloads' => 'Smartphones',
            ),
            391 => 
            array (
                'id' => 462,
                'item_id' => 1004,
                'attribute_id' => 148,
                'payloads' => 'Dual Sim',
            ),
            392 => 
            array (
                'id' => 463,
                'item_id' => 1004,
                'attribute_id' => 149,
                'payloads' => 'Yes',
            ),
            393 => 
            array (
                'id' => 464,
                'item_id' => 1004,
                'attribute_id' => 150,
            'payloads' => '16.56 cm (6.52 inch)',
            ),
            394 => 
            array (
                'id' => 465,
                'item_id' => 1004,
                'attribute_id' => 151,
                'payloads' => '720 x 1600 Pixels',
            ),
            395 => 
            array (
                'id' => 466,
                'item_id' => 1004,
                'attribute_id' => 152,
                'payloads' => '720 x 1600 Pixels',
            ),
            396 => 
            array (
                'id' => 467,
                'item_id' => 1004,
                'attribute_id' => 153,
                'payloads' => 'Android 11',
            ),
            397 => 
            array (
                'id' => 468,
                'item_id' => 1004,
                'attribute_id' => 154,
                'payloads' => 'Octa Core',
            ),
            398 => 
            array (
                'id' => 469,
                'item_id' => 1004,
                'attribute_id' => 155,
                'payloads' => '4G VOLTE, 4G, 3G, 2G',
            ),
            399 => 
            array (
                'id' => 470,
                'item_id' => 1004,
                'attribute_id' => 156,
                'payloads' => 'Nano SIM',
            ),
            400 => 
            array (
                'id' => 471,
                'item_id' => 1004,
                'attribute_id' => 157,
                'payloads' => '5000 mAh',
            ),
            401 => 
            array (
                'id' => 472,
                'item_id' => 1004,
                'attribute_id' => 158,
                'payloads' => '190 g',
            ),
            402 => 
            array (
                'id' => 473,
                'item_id' => 1006,
                'attribute_id' => 176,
                'payloads' => 'Green',
            ),
            403 => 
            array (
                'id' => 474,
                'item_id' => 1006,
                'attribute_id' => 177,
                'payloads' => '4 GB',
            ),
            404 => 
            array (
                'id' => 475,
                'item_id' => 1006,
                'attribute_id' => 180,
                'payloads' => '128 GB',
            ),
            405 => 
            array (
                'id' => 476,
                'item_id' => 1006,
                'attribute_id' => 181,
                'payloads' => 'X6812',
            ),
            406 => 
            array (
                'id' => 477,
                'item_id' => 1006,
                'attribute_id' => 182,
                'payloads' => 'Hot 11S',
            ),
            407 => 
            array (
                'id' => 478,
                'item_id' => 1006,
                'attribute_id' => 183,
                'payloads' => 'Smartphones',
            ),
            408 => 
            array (
                'id' => 479,
                'item_id' => 1006,
                'attribute_id' => 184,
                'payloads' => 'Dual Sim',
            ),
            409 => 
            array (
                'id' => 480,
                'item_id' => 1006,
                'attribute_id' => 185,
                'payloads' => 'Yes',
            ),
            410 => 
            array (
                'id' => 481,
                'item_id' => 1006,
                'attribute_id' => 186,
            'payloads' => '17.22 cm (6.78 inch)',
            ),
            411 => 
            array (
                'id' => 482,
                'item_id' => 1006,
                'attribute_id' => 187,
                'payloads' => '2480 x 1080 Pixels',
            ),
            412 => 
            array (
                'id' => 483,
                'item_id' => 1006,
                'attribute_id' => 188,
                'payloads' => 'Full HD+ LCD LTPS Display',
            ),
            413 => 
            array (
                'id' => 484,
                'item_id' => 1006,
                'attribute_id' => 189,
                'payloads' => 'Android 11',
            ),
            414 => 
            array (
                'id' => 485,
                'item_id' => 1006,
                'attribute_id' => 190,
                'payloads' => 'Octa Core',
            ),
            415 => 
            array (
                'id' => 486,
                'item_id' => 1006,
                'attribute_id' => 191,
                'payloads' => '4G, 3G, 2G',
            ),
            416 => 
            array (
                'id' => 487,
                'item_id' => 1006,
                'attribute_id' => 192,
                'payloads' => 'Nano + Nano',
            ),
            417 => 
            array (
                'id' => 488,
                'item_id' => 1006,
                'attribute_id' => 193,
                'payloads' => '5000 mAh',
            ),
            418 => 
            array (
                'id' => 489,
                'item_id' => 1006,
                'attribute_id' => 194,
                'payloads' => '205 g',
            ),
            419 => 
            array (
                'id' => 490,
                'item_id' => 1007,
                'attribute_id' => 195,
                'payloads' => 'Green',
            ),
            420 => 
            array (
                'id' => 491,
                'item_id' => 1007,
                'attribute_id' => 196,
                'payloads' => '8 GB',
            ),
            421 => 
            array (
                'id' => 492,
                'item_id' => 1007,
                'attribute_id' => 197,
                'payloads' => '256 GB',
            ),
            422 => 
            array (
                'id' => 493,
                'item_id' => 1007,
                'attribute_id' => 198,
                'payloads' => 'PAMR0000IN',
            ),
            423 => 
            array (
                'id' => 494,
                'item_id' => 1007,
                'attribute_id' => 199,
                'payloads' => 'G10 Power',
            ),
            424 => 
            array (
                'id' => 495,
                'item_id' => 1007,
                'attribute_id' => 200,
                'payloads' => 'Smartphones',
            ),
            425 => 
            array (
                'id' => 496,
                'item_id' => 1007,
                'attribute_id' => 201,
                'payloads' => 'Dual Sim',
            ),
            426 => 
            array (
                'id' => 497,
                'item_id' => 1007,
                'attribute_id' => 202,
            'payloads' => '16.54 cm (6.51 inch)',
            ),
            427 => 
            array (
                'id' => 498,
                'item_id' => 1007,
                'attribute_id' => 203,
                'payloads' => '1600 x 720 Pixels',
            ),
            428 => 
            array (
                'id' => 499,
                'item_id' => 1007,
                'attribute_id' => 204,
                'payloads' => 'HD+ IPS LCD Display',
            ),
            429 => 
            array (
                'id' => 500,
                'item_id' => 1007,
                'attribute_id' => 205,
                'payloads' => 'Android 11',
            ),
            430 => 
            array (
                'id' => 501,
                'item_id' => 1007,
                'attribute_id' => 206,
                'payloads' => 'Octa Core',
            ),
            431 => 
            array (
                'id' => 502,
                'item_id' => 1007,
                'attribute_id' => 207,
                'payloads' => 'nano',
            ),
            432 => 
            array (
                'id' => 503,
                'item_id' => 1007,
                'attribute_id' => 208,
                'payloads' => '6000 mAh',
            ),
            433 => 
            array (
                'id' => 504,
                'item_id' => 1007,
                'attribute_id' => 209,
                'payloads' => '220 g',
            ),
            434 => 
            array (
                'id' => 505,
                'item_id' => 1008,
                'attribute_id' => 210,
                'payloads' => 'Black',
            ),
            435 => 
            array (
                'id' => 506,
                'item_id' => 1008,
                'attribute_id' => 211,
                'payloads' => '8 GB',
            ),
            436 => 
            array (
                'id' => 507,
                'item_id' => 1008,
                'attribute_id' => 212,
                'payloads' => '256 GB',
            ),
            437 => 
            array (
                'id' => 508,
                'item_id' => 1008,
                'attribute_id' => 213,
                'payloads' => 'KF6j',
            ),
            438 => 
            array (
                'id' => 509,
                'item_id' => 1008,
                'attribute_id' => 214,
                'payloads' => 'SPARK 7',
            ),
            439 => 
            array (
                'id' => 510,
                'item_id' => 1008,
                'attribute_id' => 215,
                'payloads' => 'Smartphones',
            ),
            440 => 
            array (
                'id' => 511,
                'item_id' => 1008,
                'attribute_id' => 216,
                'payloads' => 'Dual Sim',
            ),
            441 => 
            array (
                'id' => 512,
                'item_id' => 1008,
                'attribute_id' => 217,
                'payloads' => 'Yes',
            ),
            442 => 
            array (
                'id' => 513,
                'item_id' => 1008,
                'attribute_id' => 218,
            'payloads' => '16.51 cm (6.5 inch)',
            ),
            443 => 
            array (
                'id' => 514,
                'item_id' => 1008,
                'attribute_id' => 219,
                'payloads' => '720 x 1600$$pixel',
            ),
            444 => 
            array (
                'id' => 515,
                'item_id' => 1008,
                'attribute_id' => 220,
                'payloads' => 'Android Android Q ANDROID 10',
            ),
            445 => 
            array (
                'id' => 516,
                'item_id' => 1008,
                'attribute_id' => 221,
                'payloads' => 'Octa Core',
            ),
            446 => 
            array (
                'id' => 517,
                'item_id' => 1008,
                'attribute_id' => 222,
                'payloads' => '4G VOLTE',
            ),
            447 => 
            array (
                'id' => 518,
                'item_id' => 1008,
                'attribute_id' => 223,
                'payloads' => 'nano',
            ),
            448 => 
            array (
                'id' => 519,
                'item_id' => 1008,
                'attribute_id' => 224,
                'payloads' => '6000 mAh',
            ),
            449 => 
            array (
                'id' => 520,
                'item_id' => 1011,
                'attribute_id' => 26,
                'payloads' => 'Pink',
            ),
            450 => 
            array (
                'id' => 521,
                'item_id' => 1011,
                'attribute_id' => 27,
                'payloads' => '2 GB',
            ),
            451 => 
            array (
                'id' => 522,
                'item_id' => 1011,
                'attribute_id' => 28,
                'payloads' => '32 GB',
            ),
            452 => 
            array (
                'id' => 523,
                'item_id' => 1011,
                'attribute_id' => 29,
                'payloads' => 'RMX3261 / RMX3263',
            ),
            453 => 
            array (
                'id' => 524,
                'item_id' => 1011,
                'attribute_id' => 30,
                'payloads' => 'C21Y',
            ),
            454 => 
            array (
                'id' => 525,
                'item_id' => 1011,
                'attribute_id' => 31,
                'payloads' => 'Yes',
            ),
            455 => 
            array (
                'id' => 526,
                'item_id' => 1011,
                'attribute_id' => 32,
                'payloads' => 'Smartphones',
            ),
            456 => 
            array (
                'id' => 527,
                'item_id' => 1011,
                'attribute_id' => 33,
            'payloads' => '16.51 cm (6.5 inch)',
            ),
            457 => 
            array (
                'id' => 528,
                'item_id' => 1011,
                'attribute_id' => 34,
                'payloads' => '1600 x 720 Pixels',
            ),
            458 => 
            array (
                'id' => 529,
                'item_id' => 1011,
                'attribute_id' => 35,
                'payloads' => 'HD+ LCD In-cell Display',
            ),
            459 => 
            array (
                'id' => 530,
                'item_id' => 1011,
                'attribute_id' => 36,
                'payloads' => 'Android 11',
            ),
            460 => 
            array (
                'id' => 531,
                'item_id' => 1011,
                'attribute_id' => 37,
                'payloads' => 'Unisoc T610',
            ),
            461 => 
            array (
                'id' => 532,
                'item_id' => 1011,
                'attribute_id' => 38,
                'payloads' => 'Dual Sim',
            ),
            462 => 
            array (
                'id' => 533,
                'item_id' => 1011,
                'attribute_id' => 39,
                'payloads' => '4G, 3G, 2G',
            ),
            463 => 
            array (
                'id' => 534,
                'item_id' => 1011,
                'attribute_id' => 40,
                'payloads' => '5000 mAh',
            ),
            464 => 
            array (
                'id' => 535,
                'item_id' => 1011,
                'attribute_id' => 41,
                'payloads' => '200 g',
            ),
            465 => 
            array (
                'id' => 536,
                'item_id' => 1011,
                'attribute_id' => 42,
                'payloads' => 'Nano + Nano',
            ),
            466 => 
            array (
                'id' => 537,
                'item_id' => 1012,
                'attribute_id' => 43,
                'payloads' => 'Pink',
            ),
            467 => 
            array (
                'id' => 538,
                'item_id' => 1012,
                'attribute_id' => 44,
                'payloads' => '8 GB',
            ),
            468 => 
            array (
                'id' => 539,
                'item_id' => 1012,
                'attribute_id' => 45,
                'payloads' => '128 GB',
            ),
            469 => 
            array (
                'id' => 540,
                'item_id' => 1012,
                'attribute_id' => 46,
                'payloads' => 'SM-A127GLBIINS',
            ),
            470 => 
            array (
                'id' => 541,
                'item_id' => 1012,
                'attribute_id' => 47,
                'payloads' => 'Galaxy A12',
            ),
            471 => 
            array (
                'id' => 542,
                'item_id' => 1012,
                'attribute_id' => 48,
                'payloads' => 'Smartphones',
            ),
            472 => 
            array (
                'id' => 543,
                'item_id' => 1012,
                'attribute_id' => 49,
                'payloads' => 'Dual Sim',
            ),
            473 => 
            array (
                'id' => 544,
                'item_id' => 1012,
                'attribute_id' => 50,
            'payloads' => '16.55 cm (6.515 inch)',
            ),
            474 => 
            array (
                'id' => 545,
                'item_id' => 1012,
                'attribute_id' => 51,
                'payloads' => '1080 x 2400$pixels',
            ),
            475 => 
            array (
                'id' => 546,
                'item_id' => 1012,
                'attribute_id' => 52,
                'payloads' => 'Full HD+ Super AMOLED Display',
            ),
            476 => 
            array (
                'id' => 547,
                'item_id' => 1012,
                'attribute_id' => 53,
                'payloads' => 'Android 11',
            ),
            477 => 
            array (
                'id' => 548,
                'item_id' => 1012,
                'attribute_id' => 54,
                'payloads' => 'Exynos 850',
            ),
            478 => 
            array (
                'id' => 549,
                'item_id' => 1012,
                'attribute_id' => 55,
                'payloads' => 'Octa Core',
            ),
            479 => 
            array (
                'id' => 550,
                'item_id' => 1012,
                'attribute_id' => 56,
                'payloads' => '4G',
            ),
            480 => 
            array (
                'id' => 551,
                'item_id' => 1012,
                'attribute_id' => 57,
                'payloads' => 'Nano',
            ),
            481 => 
            array (
                'id' => 552,
                'item_id' => 1012,
                'attribute_id' => 58,
                'payloads' => '5000 mAh',
            ),
            482 => 
            array (
                'id' => 553,
                'item_id' => 1012,
                'attribute_id' => 59,
                'payloads' => '221 g',
            ),
            483 => 
            array (
                'id' => 554,
                'item_id' => 1013,
                'attribute_id' => 142,
                'payloads' => 'Green',
            ),
            484 => 
            array (
                'id' => 555,
                'item_id' => 1013,
                'attribute_id' => 143,
                'payloads' => '6 GB',
            ),
            485 => 
            array (
                'id' => 556,
                'item_id' => 1013,
                'attribute_id' => 144,
                'payloads' => '64 GB',
            ),
            486 => 
            array (
                'id' => 557,
                'item_id' => 1013,
                'attribute_id' => 145,
                'payloads' => 'CPH2269',
            ),
            487 => 
            array (
                'id' => 558,
                'item_id' => 1013,
                'attribute_id' => 146,
                'payloads' => 'A95',
            ),
            488 => 
            array (
                'id' => 559,
                'item_id' => 1013,
                'attribute_id' => 147,
                'payloads' => 'Smartphones',
            ),
            489 => 
            array (
                'id' => 560,
                'item_id' => 1013,
                'attribute_id' => 148,
                'payloads' => 'Dual Sim',
            ),
            490 => 
            array (
                'id' => 561,
                'item_id' => 1013,
                'attribute_id' => 149,
                'payloads' => 'Yes',
            ),
            491 => 
            array (
                'id' => 562,
                'item_id' => 1013,
                'attribute_id' => 150,
            'payloads' => '16.56 cm (6.52 inch)',
            ),
            492 => 
            array (
                'id' => 563,
                'item_id' => 1013,
                'attribute_id' => 151,
                'payloads' => '720 x 1600 Pixels',
            ),
            493 => 
            array (
                'id' => 564,
                'item_id' => 1013,
                'attribute_id' => 152,
                'payloads' => 'AMOLED',
            ),
            494 => 
            array (
                'id' => 565,
                'item_id' => 1013,
                'attribute_id' => 153,
                'payloads' => 'Android 11',
            ),
            495 => 
            array (
                'id' => 566,
                'item_id' => 1013,
                'attribute_id' => 154,
                'payloads' => 'Octa Core',
            ),
            496 => 
            array (
                'id' => 567,
                'item_id' => 1013,
                'attribute_id' => 155,
                'payloads' => '4G VOLTE, 4G, 3G, 2G',
            ),
            497 => 
            array (
                'id' => 568,
                'item_id' => 1013,
                'attribute_id' => 156,
                'payloads' => 'Nano SIM',
            ),
            498 => 
            array (
                'id' => 569,
                'item_id' => 1013,
                'attribute_id' => 157,
                'payloads' => '5000 mAh',
            ),
            499 => 
            array (
                'id' => 570,
                'item_id' => 1013,
                'attribute_id' => 158,
                'payloads' => '190 g',
            ),
        ));
        \DB::table('item_attributes')->insert(array (
            0 => 
            array (
                'id' => 571,
                'item_id' => 1014,
                'attribute_id' => 195,
                'payloads' => 'Green',
            ),
            1 => 
            array (
                'id' => 572,
                'item_id' => 1014,
                'attribute_id' => 196,
                'payloads' => '4 GB',
            ),
            2 => 
            array (
                'id' => 573,
                'item_id' => 1014,
                'attribute_id' => 197,
                'payloads' => '64 GB',
            ),
            3 => 
            array (
                'id' => 574,
                'item_id' => 1014,
                'attribute_id' => 198,
                'payloads' => 'PANB0000IN',
            ),
            4 => 
            array (
                'id' => 575,
                'item_id' => 1014,
                'attribute_id' => 199,
                'payloads' => 'G60',
            ),
            5 => 
            array (
                'id' => 576,
                'item_id' => 1014,
                'attribute_id' => 200,
                'payloads' => 'Smartphones',
            ),
            6 => 
            array (
                'id' => 577,
                'item_id' => 1014,
                'attribute_id' => 201,
                'payloads' => 'Dual Sim',
            ),
            7 => 
            array (
                'id' => 578,
                'item_id' => 1014,
                'attribute_id' => 202,
            'payloads' => '17.27 cm (6.8 inch)',
            ),
            8 => 
            array (
                'id' => 579,
                'item_id' => 1014,
                'attribute_id' => 203,
                'payloads' => '2460 x 1080 Pixels',
            ),
            9 => 
            array (
                'id' => 580,
                'item_id' => 1014,
                'attribute_id' => 204,
                'payloads' => 'Full HD+ IPS LCD Display',
            ),
            10 => 
            array (
                'id' => 581,
                'item_id' => 1014,
                'attribute_id' => 205,
                'payloads' => 'Android 11',
            ),
            11 => 
            array (
                'id' => 582,
                'item_id' => 1014,
                'attribute_id' => 206,
                'payloads' => 'Octa Core',
            ),
            12 => 
            array (
                'id' => 583,
                'item_id' => 1014,
                'attribute_id' => 207,
                'payloads' => 'nano',
            ),
            13 => 
            array (
                'id' => 584,
                'item_id' => 1014,
                'attribute_id' => 208,
                'payloads' => '6000 mAh',
            ),
            14 => 
            array (
                'id' => 585,
                'item_id' => 1014,
                'attribute_id' => 209,
                'payloads' => '220 g',
            ),
            15 => 
            array (
                'id' => 586,
                'item_id' => 1044,
                'attribute_id' => 393,
                'payloads' => 'Memory Card',
            ),
            16 => 
            array (
                'id' => 587,
                'item_id' => 1046,
                'attribute_id' => 395,
                'payloads' => 'Black',
            ),
            17 => 
            array (
                'id' => 588,
                'item_id' => 1046,
                'attribute_id' => 396,
                'payloads' => 'MJSXJ02CM / MJSXJ05CM',
            ),
            18 => 
            array (
                'id' => 589,
                'item_id' => 1046,
                'attribute_id' => 397,
                'payloads' => 'Yes',
            ),
            19 => 
            array (
                'id' => 590,
                'item_id' => 1046,
                'attribute_id' => 398,
                'payloads' => '360° 1080p WiFi Smart',
            ),
            20 => 
            array (
                'id' => 591,
                'item_id' => 1047,
                'attribute_id' => 395,
                'payloads' => 'White',
            ),
            21 => 
            array (
                'id' => 592,
                'item_id' => 1047,
                'attribute_id' => 396,
                'payloads' => 'RMH2001',
            ),
            22 => 
            array (
                'id' => 593,
                'item_id' => 1047,
                'attribute_id' => 397,
                'payloads' => 'Yes',
            ),
            23 => 
            array (
                'id' => 594,
                'item_id' => 1047,
                'attribute_id' => 398,
                'payloads' => '360 Deg 1080p Wifi Smart',
            ),
            24 => 
            array (
                'id' => 595,
                'item_id' => 1048,
                'attribute_id' => 26,
                'payloads' => 'Pink',
            ),
            25 => 
            array (
                'id' => 596,
                'item_id' => 1048,
                'attribute_id' => 27,
                'payloads' => '4 GB',
            ),
            26 => 
            array (
                'id' => 597,
                'item_id' => 1048,
                'attribute_id' => 28,
                'payloads' => '64 GB',
            ),
            27 => 
            array (
                'id' => 598,
                'item_id' => 1048,
                'attribute_id' => 29,
                'payloads' => 'RMX3430',
            ),
            28 => 
            array (
                'id' => 599,
                'item_id' => 1048,
                'attribute_id' => 30,
                'payloads' => 'Narzo 50A',
            ),
            29 => 
            array (
                'id' => 600,
                'item_id' => 1048,
                'attribute_id' => 31,
                'payloads' => 'Yes',
            ),
            30 => 
            array (
                'id' => 601,
                'item_id' => 1048,
                'attribute_id' => 32,
                'payloads' => 'Smartphones',
            ),
            31 => 
            array (
                'id' => 602,
                'item_id' => 1048,
                'attribute_id' => 33,
            'payloads' => '16.51 cm (6.5 inch)',
            ),
            32 => 
            array (
                'id' => 603,
                'item_id' => 1048,
                'attribute_id' => 34,
                'payloads' => '1600 x 720 Pixels',
            ),
            33 => 
            array (
                'id' => 604,
                'item_id' => 1048,
                'attribute_id' => 35,
                'payloads' => 'HD+ LCD In-cell Display',
            ),
            34 => 
            array (
                'id' => 605,
                'item_id' => 1048,
                'attribute_id' => 36,
                'payloads' => 'Android 11',
            ),
            35 => 
            array (
                'id' => 606,
                'item_id' => 1048,
                'attribute_id' => 37,
                'payloads' => 'MediaTek Helio G85',
            ),
            36 => 
            array (
                'id' => 607,
                'item_id' => 1048,
                'attribute_id' => 38,
                'payloads' => 'Dual Sim',
            ),
            37 => 
            array (
                'id' => 608,
                'item_id' => 1048,
                'attribute_id' => 39,
                'payloads' => '4G VOLTE, 4G, 3G, 2G',
            ),
            38 => 
            array (
                'id' => 609,
                'item_id' => 1048,
                'attribute_id' => 40,
                'payloads' => '6000 mAh',
            ),
            39 => 
            array (
                'id' => 610,
                'item_id' => 1048,
                'attribute_id' => 41,
                'payloads' => '207 g',
            ),
            40 => 
            array (
                'id' => 611,
                'item_id' => 1048,
                'attribute_id' => 42,
                'payloads' => 'Nano + Nano',
            ),
        ));
        
        
    }
}