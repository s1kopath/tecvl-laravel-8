<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_templates', function (Blueprint $table) {
            $table->foreign(['language_id'])->references(['id'])->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['parent_id'])->references(['id'])->on('sms_templates')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_templates', function (Blueprint $table) {
            $table->dropForeign('sms_templates_language_id_foreign');
            $table->dropForeign('sms_templates_parent_id_foreign');
        });
    }
}
