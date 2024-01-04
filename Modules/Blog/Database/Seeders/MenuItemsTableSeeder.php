<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
       DB::table('menu_items')->upsert([
        ['id' => 54, 'label' => 'category', 'link' => 'blog/category/list', 'params' => '{"permission":"Modules\\\\Blog\\\\Http\\\\Controllers\\\\BlogCategoryController@index", "route_name":["blog.category.index"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 56, 'sort' => 25, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
        ['id' => 55, 'label' => 'blog', 'link' => 'blog/list', 'params' => '{"permission":"Modules\\\\Blog\\\\Http\\\\Controllers\\\\BlogController@index", "route_name":["blog.index", "blog.create", "blog.edit"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 56, 'sort' => 26, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
        ['id' => 56, 'label' => 'Blog', 'link' => NULL, 'params' => NULL, 'is_default' => 1, 'icon' => 'fab fa-blogger-b', 'parent' => 0, 'sort' => 24, 'class' => NULL, 'menu' => 1, 'depth' => 0,]
    ], 'id');

    }
}
