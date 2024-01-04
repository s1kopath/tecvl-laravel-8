<?php

namespace Modules\Report\Database\Seeders;

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
        array (
            'id' => 63,
            'label' => 'Reports',
            'link' => 'reports',
            'params' => '{"permission":"Modules\\\\Report\\\\Http\\\\Controllers\\\\ReportController@index", "route_name":["reports"], "menu_level":"1"}',
            'is_default' => 1,
            'icon' => 'fas fa-chart-bar',
            'parent' => 0,
            'sort' => 50,
            'class' => NULL,
            'menu' => 1,
            'depth' => 0,
        ),
    ], 'id');

    }
}
