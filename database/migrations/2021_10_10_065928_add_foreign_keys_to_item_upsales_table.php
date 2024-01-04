<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemUpsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_upsales', function (Blueprint $table) {
            $table->foreign(['item_id'], 'item_upsales')->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_upsales', function (Blueprint $table) {
            $table->dropForeign('item_upsales');
        });
    }
}
