<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCrossSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_cross_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->index('item_cross_sales_item_id_idx');
            $table->integer('cross_sale_item_id')->index('item_cross_sales_cross_sale_item_id_foreign_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_cross_sales');
    }
}
