<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemUpsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_upsales', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->index('item_upsales_item_id_idx');
            $table->integer('upsale_item_id')->index('item_upsales_upsale_item_id_foreign_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_upsales');
    }
}
