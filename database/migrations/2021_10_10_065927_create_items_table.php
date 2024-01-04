<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_code', 120)->index();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->string('summary')->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedSmallInteger('review_count')->nullable()->default('0');
            $table->decimal('review_average', 6)->nullable();
            $table->date('available_from')->nullable()->index('items_availability_from_index');
            $table->date('available_to')->nullable()->index('items_availability_to_index');
            $table->bigInteger('vendor_id')->nullable()->index('items_vendor_id_foreign_idx');
            $table->bigInteger('shop_id')->nullable()->index('items_shop_id_foreign_idx');
            $table->unsignedInteger('brand_id')->nullable()->index('items_brand_id_foreign_idx');
            $table->string('status', 8)->default('Active')->index();
            $table->boolean('is_virtual')->default(false);
            $table->boolean('is_shippable')->default(false);
            $table->boolean('is_shareable')->default(false);
            $table->integer('favourite_count')->nullable();
            $table->integer('wish_count')->nullable();
            $table->integer('purchase_count')->nullable();
            $table->decimal('price', 16, 8)->nullable()->index();
            $table->decimal('discount_amount', 16, 8)->nullable()->index();
            $table->string('discount_type', 20)->nullable()->index();
            $table->decimal('discounted_price', 16, 8)->nullable()->index();
            $table->date('discount_from')->nullable()->index();
            $table->date('discount_to')->nullable()->index();
            $table->decimal('maximum_discount_amount', 16, 8)->nullable();
            $table->decimal('minimum_order_for_discount', 16, 8)->nullable();
            $table->string('sku', 45)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->index('items_parent_id_foreign_idx');
            $table->text('item_excerpt');
            $table->unsignedSmallInteger('menu_order')->nullable()->default('0');
            $table->string('type', 25)->default('Item')->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('items');
    }
}
