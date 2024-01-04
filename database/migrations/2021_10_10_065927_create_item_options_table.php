<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('item_id')->index('item_options_item_id_foreign_idx');
            $table->string('name', 100)->index();
            $table->string('type', 15)->index();
            $table->integer('order_by');
            $table->text('payloads');
            $table->boolean('is_required')->default(false);
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
        Schema::dropIfExists('item_options');
    }
}
