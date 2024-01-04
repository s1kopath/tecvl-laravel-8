<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_categories')->delete();
        
        \DB::table('blog_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Blog',
                'status' => 'Active',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Travel',
                'status' => 'Active',
            ),
        ));
        
        
    }
}