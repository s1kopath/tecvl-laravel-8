<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CMS\Database\Seeders\AdminMenusTableSeeder;
use Modules\CMS\Database\Seeders\TemplateAndLayoutSeeder;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SlidersTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(AdminMenusTableSeeder::class);
        $this->call(TemplateAndLayoutSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
    }
}
