<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_details', function (Blueprint $table) {
            $table->foreign(['item_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['tax_id'])->references(['id'])->on('taxes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_details', function (Blueprint $table) {
            $table->dropForeign('item_details_item_id_foreign');
            $table->dropForeign('item_details_tax_id_foreign');
        });
    }
}
