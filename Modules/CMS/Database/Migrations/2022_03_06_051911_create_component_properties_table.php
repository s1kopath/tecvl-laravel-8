<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->unique(['name', 'component_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_properties');
    }
}
