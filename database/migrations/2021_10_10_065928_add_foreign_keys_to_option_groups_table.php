<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOptionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('option_groups', function (Blueprint $table) {
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
        Schema::table('option_groups', function (Blueprint $table) {
            $table->dropForeign('option_groups_category_id');
            $table->dropForeign('option_groups_vendor_id_foreign');
        });
    }
}
