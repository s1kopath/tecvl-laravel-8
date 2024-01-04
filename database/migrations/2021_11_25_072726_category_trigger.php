<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // -- trigger on after delete item category
        \DB::unprepared('
            CREATE TRIGGER `item_categories_ADEL` AFTER DELETE ON `item_categories`
            FOR EACH ROW UPDATE categories SET item_counts = (select count(item_id) from item_categories WHERE category_id = categories.id) WHERE categories.id = OLD.category_id
        ');

        // -- trigger on after insert item category
        \DB::unprepared('
            CREATE TRIGGER `item_categories_AINS` AFTER INSERT ON `item_categories`
            FOR EACH ROW UPDATE categories SET item_counts = (select count(item_id) from item_categories WHERE category_id = categories.id) WHERE categories.id = NEW.category_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared('DROP TRIGGER `item_categories_ADEL`');
        \DB::unprepared('DROP TRIGGER `item_categories_AINS`');
    }
}
