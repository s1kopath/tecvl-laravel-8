<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemRelatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_relates', function (Blueprint $table) {
            $table->foreign(['item_id'], 'item_relates')->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_relates', function (Blueprint $table) {
            $table->dropForeign('item_relates');
        });
    }
}
