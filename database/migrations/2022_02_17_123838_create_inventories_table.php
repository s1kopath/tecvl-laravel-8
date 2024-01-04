<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('item_option_id')->nullable()->index('inventories_item_option_id_foreign_idx');
            $table->string('label', 45)->nullable()->index();
            $table->bigInteger('vendor_id')->nullable()->index('inventories_vendor_id_foreign_idx');
            $table->decimal('quantity', 16, 8)->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
