<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // -- trigger on after delete item tag
        \DB::unprepared('
            CREATE TRIGGER `item_tags_ADEL` AFTER DELETE ON `item_tags`
            FOR EACH ROW UPDATE tags SET item_counts = (select count(item_id) from item_tags WHERE tag_id = tags.id) WHERE tags.id = OLD.tag_id
        ');

        // -- trigger on after insert item tag
        \DB::unprepared('
            CREATE TRIGGER `item_tags_AINS` AFTER INSERT ON `item_tags`
            FOR EACH ROW UPDATE tags SET item_counts = (select count(item_id) from item_tags WHERE tag_id = tags.id) WHERE tags.id = NEW.tag_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared('DROP TRIGGER `item_tags_ADEL`');
        \DB::unprepared('DROP TRIGGER `item_tags_AINS`');
    }
}
