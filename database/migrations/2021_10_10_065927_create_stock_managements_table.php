<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor_id')->nullable()->index('stock_managements_vendor_id_foreign_idx');
            $table->bigInteger('user_id')->index('stock_managements_user_id_foreign_idx');
            $table->unsignedInteger('location_id')->index('stock_managements_location_id_foreign_idx');
            $table->string('transaction_type', 12)->nullable()->index();
            $table->decimal('total_quantity', 16, 8)->index();
            $table->text('note')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_managements');
    }
}
