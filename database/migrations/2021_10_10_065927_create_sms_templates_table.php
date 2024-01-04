<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->index('sms_templates_parent_id_foreign_idx');
            $table->string('name')->nullable()->index();
            $table->string('slug', 45)->nullable()->unique();
            $table->text('body');
            $table->integer('language_id')->index('sms_templates_language_id_foreign_idx');
            $table->string('status', 10)->default('Active')->index();
            $table->text('variables')->nullable();
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
        Schema::dropIfExists('sms_templates');
    }
}
