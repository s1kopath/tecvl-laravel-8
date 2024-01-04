<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->nullable()->index('item_details_item_id_foreign_idx');
            $table->string('warranty_type', 25)->index();
            $table->string('warranty_period', 12)->nullable()->index();
            $table->text('warranty_policy')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable()->index('item_details_shipping_id_foreign_idx');
            $table->boolean('is_track_inventory')->nullable()->default(false);
            $table->boolean('is_hide_stock')->nullable()->default(false);
            $table->decimal('stock_quantity', 16, 8)->nullable()->index();
            $table->string('stock_status', 14)->nullable()->index();
            $table->boolean('is_downloadable')->nullable()->default(false)->index();
            $table->boolean('is_featured')->nullable()->default(false)->index();
            $table->boolean('is_discount')->nullable()->default(false);
            $table->boolean('is_cash_on_delivery')->nullable()->default(false)->index();
            $table->unsignedInteger('tax_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_details');
    }
}
