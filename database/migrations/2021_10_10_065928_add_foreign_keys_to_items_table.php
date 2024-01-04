<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign(['brand_id'])->references(['id'])->on('brands')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'])->references(['id'])->on('vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['shop_id'])->references(['id'])->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['parent_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_brand_id_foreign');
            $table->dropForeign('items_vendor_id_foreign');
            $table->dropForeign('items_shop_id_foreign');
        });
    }
}
