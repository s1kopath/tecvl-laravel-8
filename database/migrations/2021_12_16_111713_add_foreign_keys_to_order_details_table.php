<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign(['shipping_id'])->references(['id'])->on('shippings')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'])->references(['id'])->on('vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['item_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['order_status_id'])->references(['id'])->on('order_statuses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['shop_id'])->references(['id'])->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('order_details_shipping_id_foreign');
            $table->dropForeign('order_details_vendor_id_foreign');
            $table->dropForeign('order_details_item_id_foreign');
            $table->dropForeign('order_details_order_status_id_foreign');
            $table->dropForeign('order_details_shop_id_foreign');
            $table->dropForeign('order_details_order_id_foreign');
        });
    }
}
