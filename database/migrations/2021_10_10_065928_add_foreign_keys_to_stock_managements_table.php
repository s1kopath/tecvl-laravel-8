<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStockManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_managements', function (Blueprint $table) {
            $table->foreign(['location_id'])->references(['id'])->on('locations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'])->references(['id'])->on('vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_managements', function (Blueprint $table) {
            $table->dropForeign('stock_managements_location_id_foreign');
            $table->dropForeign('stock_managements_user_id_foreign');
            $table->dropForeign('stock_managements_vendor_id_foreign');
        });
    }
}
