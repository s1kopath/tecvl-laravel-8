<?php

namespace Modules\CMS\Database\Seeders;

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
            ['id' => 57, 'label' => 'CMS', 'link' => NULL, 'params' => NULL, 'is_default' => 1, 'icon' => 'fas fa-box', 'parent' => 0, 'sort' => 35, 'class' => NULL, 'menu' => 1, 'depth' => 0,],
            ['id' => 58, 'label' => 'sliders', 'link' => 'sliders', 'params' => '{"permission":"Modules\\\\CMS\\\\Http\\\\Controllers\\\\SliderController@index", "route_name":["slider.index", "slide.create", "slide.edit"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 57, 'sort' => 36, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => 60, 'label' => 'Pages', 'link' => 'page/list', 'params' => '{"permission":"Modules\\\\CMS\\\\Http\\\\Controllers\\\\CMSController@index", "route_name":["page.index", "page.create", "page.edit"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 57, 'sort' => 38, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => NULL, 'label' => 'Homepages', 'link' => 'page/home/list', 'params' => '{"permission":"Modules\\\\CMS\\\\Http\\\\Controllers\\\\CMSController@index", "route_name":["page.home", "builder.edit"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 57, 'sort' => 37, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => 62, 'label' => 'Theme Options', 'link' => 'theme/list', 'params' => '{"permission":"Modules\\\\CMS\\\\Http\\\\Controllers\\\\ThemeOptionController@list", "route_name":["theme.index", "theme.store"], "menu_level":"1"}', 'is_default' => 1, 'icon' => NULL, 'parent' => 57, 'sort' => 39, 'class' => NULL, 'menu' => 1, 'depth' => 1,]
        ], 'id');
    }
}
