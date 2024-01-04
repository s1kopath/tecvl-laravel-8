<?php

namespace Modules\FormBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\MenuBuilder\Http\Models\MenuItems;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        /**
         * Auto generated seed file
         *
         * @return void
         */
        DB::table('menu_items')->upsert([
            ['id' => 70, 'label' => 'KYC', 'link' => 'form-builder/kyc-form', 'params' => '{"permission":"Modules\\\\FormBuilder\\\\Http\\\\Controllers\\\\KycController@index", "route_name":["formbuilder::kyc.index"], "menu_level":"1"}', 'is_default' => 1, 'icon' => 'fas fa-align-justify', 'parent' => 67, 'sort' => 34, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => 71, 'label' => 'KYC', 'link' => 'kyc', 'params' => '{"permission":"Modules\\\\FormBuilder\\\\Http\\\\Controllers\\\\KycController@userKycForm", "route_name":["kyc.user.show"], "menu_level":"3"}', 'is_default' => 1, 'icon' => 'far fa-address-card', 'parent' => 0, 'sort' => 10, 'class' => NULL, 'menu' => 3, 'depth' => 0,],
            ['id' => 68, 'label' => 'Forms', 'link' => 'form-builder', 'params' => '{"permission":"Modules\\\\FormBuilder\\\\Http\\\\Controllers\\\\FormController@index", "route_name":["formbuilder::forms.index"], "menu_level":"1"}', 'is_default' => 1, 'icon' => 'fas fa-align-justify', 'parent' => 67, 'sort' => 32, 'class' => NULL, 'menu' => 1, 'depth' => 1,],
            ['id' => 67, 'label' => 'Form Builder', 'link' => NULL, 'params' => NULL, 'is_default' => 0, 'icon' => 'fas fa-align-justify', 'parent' => 0, 'sort' => 31, 'class' => NULL, 'menu' => 1, 'depth' => 0,],
            ['id' => 69, 'label' => 'Submissions', 'link' => 'form-builder/submissions', 'params' => '{"permission":"Modules\\\\FormBuilder\\\\Http\\\\Controllers\\\\SubmissionController@index", "route_name":["formbuilder::submissions.all"], "menu_level":"1"}', 'is_default' => 1, 'icon' => 'fas fa-align-justify', 'parent' => 67, 'sort' => 33, 'class' => NULL, 'menu' => 1, 'depth' => 1],
        ], 'id');
    }
}
