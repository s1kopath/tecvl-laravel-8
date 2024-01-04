<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100)->nullable();
            $table->string('code', 45)->nullable();
            $table->text('description')->nullable();
            $table->text('params')->nullable();
            $table->decimal('price', 16, 8)->nullable();
            $table->string('billing_cycle', 45)->nullable()->comment('Monthly / Yearly');
            $table->integer('sort_order')->nullable();
            $table->boolean('is_private')->nullable()->default(false);
            $table->string('status', 45)->nullable();
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
        Schema::dropIfExists('packages');
    }
}
