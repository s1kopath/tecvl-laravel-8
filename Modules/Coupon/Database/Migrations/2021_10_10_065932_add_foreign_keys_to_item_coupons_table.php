<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_coupons', function (Blueprint $table) {
            $table->foreign(['item_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['coupon_id'])->references(['id'])->on('coupons')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_coupons', function (Blueprint $table) {
            $table->dropForeign('item_coupons_item_id_foreign');
            $table->dropForeign('item_coupons_coupon_id_foreign');
        });
    }
}
