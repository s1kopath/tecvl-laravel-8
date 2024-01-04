<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCouponRedeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupon_redeems', function (Blueprint $table) {
            $table->foreign(['coupon_id'])->references(['id'])->on('coupons')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            // $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupon_redeems', function (Blueprint $table) {
            $table->dropForeign('coupon_redeems_coupon_id_foreign');
            $table->dropForeign('coupon_redeems_user_id_foreign');
            // $table->dropForeign('coupon_redeems_order_id_foreign');
        });
    }
}
