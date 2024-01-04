<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('option_group_id')->index('options_option_group_id_foreign_idx');
            $table->string('option')->nullable()->index();
            $table->boolean('is_default')->default(false);
            $table->decimal('price', 16, 8)->index();
            $table->string('price_type', 10)->index();
            $table->string('status', 8)->default('Active')->index();
            $table->integer('order_by')->nullable();
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
        Schema::dropIfExists('options');
    }
}
