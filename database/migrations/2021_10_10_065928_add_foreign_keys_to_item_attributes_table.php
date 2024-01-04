<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_attributes', function (Blueprint $table) {
            $table->foreign(['attribute_id'], 'item_attributes_attribute_id')->references(['id'])->on('attributes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['item_id'], 'item_attributes_item_id')->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_attributes', function (Blueprint $table) {
            $table->dropForeign('item_attributes_attribute_id');
            $table->dropForeign('item_attributes_item_id');
        });
    }
}
