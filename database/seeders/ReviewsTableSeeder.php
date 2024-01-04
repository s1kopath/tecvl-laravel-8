<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('reviews')->delete();

        \DB::table('reviews')->insert(array (
            0 =>
            array (
                'id' => 1,
                'comments' => 'Good Product',
                'rating' => 3,
                'reviewed_by' => NULL,
                'user_id' => 2,
                'item_id' => 1001,
                'is_public' => 1,
                'status' => 'Active',
                'created_at' => '2021-12-08 11:38:57',
            ),
            1 =>
            array (
                'id' => 2,
                'comments' => 'Good phone',
                'rating' => 3,
                'reviewed_by' => NULL,
                'user_id' => 2,
                'item_id' => 1002,
                'is_public' => 1,
                'status' => 'Active',
                'created_at' => '2021-12-08 15:45:25',
            ),
            2 =>
            array (
                'id' => 3,
                'comments' => 'I love this phone',
                'rating' => 5,
                'reviewed_by' => NULL,
                'user_id' => 2,
                'item_id' => 1003,
                'is_public' => 1,
                'status' => 'Active',
                'created_at' => '2021-12-08 15:45:54',
            ),
        ));


    }
}
