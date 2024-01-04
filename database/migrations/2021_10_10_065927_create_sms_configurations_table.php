<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50);
            $table->string('status', 8);
            $table->string('key');
            $table->string('secret_key');
            $table->boolean('is_default')->default(false);
            $table->string('default_number', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_configurations');
    }
}
