<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStockManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_management_details', function (Blueprint $table) {
            $table->foreign(['item_id'])->references(['id'])->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['stock_management_id'])->references(['id'])->on('stock_managements')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_management_details', function (Blueprint $table) {
            $table->dropForeign('stock_management_details_item_id_foreign');
            $table->dropForeign('stock_management_details_stock_management_id_foreign');
        });
    }
}
