<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyShippingIdToItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_details', function (Blueprint $table) {
            $table->foreign(['shipping_id'])->references(['id'])->on('shippings')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_details', function (Blueprint $table) {
            $table->dropForeign('item_details_shipping_id_foreign');
        });
    }
}
