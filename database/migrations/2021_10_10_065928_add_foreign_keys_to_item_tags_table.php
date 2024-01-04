<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_tags', function (Blueprint $table) {
            $table->foreign(['tag_id'], 'item_tags_id_foreign')->references(['id'])->on('tags')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['item_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_tags', function (Blueprint $table) {
            $table->dropForeign('item_tags_id_foreign');
            $table->dropForeign('item_tags_item_id_foreign');
        });
    }
}
