<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryOptionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_option_groups', function (Blueprint $table) {
            $table->bigInteger('option_group_id')->index('option_group_categories_option_group_id_foreign_idx');
            $table->integer('category_id')->index('option_group_categories_category_id_foreign_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_option_groups');
    }
}
