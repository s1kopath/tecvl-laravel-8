<?php

namespace Modules\Popup\Database\Seeders;

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
                'id' => 64,
                'label' => 'popups',
                'link' => 'popups',
                'params' => '{"permission":"Modules\\\\Popup\\\\Http\\\\Controllers\\\\PopupController@index", "route_name":["popup.index", "popup.create", "popup.show", "popup.store", "popup.edit", "popup.update", "popup.delete"], "menu_level":"1"}',
                'is_default' => 1,
                'icon' => 'far fa-window-restore',
                'parent' => 73,
                'sort' => 29,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
            ),
        ], 'id');

    }
}
