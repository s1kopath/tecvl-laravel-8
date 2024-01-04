<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_coupons', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->index('item_coupons_item_id_foreign_idx');
            $table->unsignedBigInteger('coupon_id')->index('item_coupons_coupon_id_foreign_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_coupons');
    }
}
