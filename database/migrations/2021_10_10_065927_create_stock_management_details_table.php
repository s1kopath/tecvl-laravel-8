<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_management_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_management_id')->index('stock_management_details_stock_management_id_foreign_idx');
            $table->unsignedBigInteger('item_id')->index('stock_management_details_item_id_foreign_idx');
            $table->text('description')->nullable();
            $table->decimal('quantity', 16, 8)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_management_details');
    }
}
