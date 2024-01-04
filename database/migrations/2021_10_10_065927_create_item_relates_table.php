<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRelatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_relates', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->index('item_relates_item_id_idx');
            $table->integer('related_item_id')->index('item_relates_related_item_id_foreign_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_relates');
    }
}
