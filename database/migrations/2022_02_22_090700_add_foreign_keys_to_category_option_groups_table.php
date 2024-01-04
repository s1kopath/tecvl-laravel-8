<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCategoryOptionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_option_groups', function (Blueprint $table) {
            $table->foreign(['category_id'], 'option_group_categories_category_id_foreign')->references(['id'])->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['option_group_id'], 'option_group_categories_option_group_id_foreign')->references(['id'])->on('option_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_option_groups', function (Blueprint $table) {
            $table->dropForeign('option_group_categories_category_id_foreign');
            $table->dropForeign('option_group_categories_option_group_id_foreign');
        });
    }
}
