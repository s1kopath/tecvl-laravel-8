<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_type', 15)->index();
            $table->string('invoice_type', 15);
            $table->string('order_type', 15)->index();
            $table->bigInteger('user_id')->index('orders_user_id_foreign_idx');
            $table->unsignedInteger('address_id')->index('orders_address_id_foreign_idx');
            $table->string('tax_type', 15)->index();
            $table->string('reference', 45)->index();
            $table->unsignedBigInteger('order_reference_id')->nullable()->index();
            $table->text('note')->nullable();
            $table->date('order_date')->index();
            $table->date('due_date')->nullable()->index();
            $table->string('discount_on', 15);
            $table->unsignedInteger('currency_id')->index('orders_currency_id_foreign_idx');
            $table->decimal('exchange_rate', 16, 8)->index();
            $table->boolean('has_tax')->default(false);
            $table->boolean('has_description')->default(false);
            $table->boolean('has_item_discount')->default(false);
            $table->boolean('has_hsn')->default(false);
            $table->boolean('has_other_discount')->default(false);
            $table->boolean('has_shipping_charge')->default(false);
            $table->boolean('leave_door')->nullable();
            $table->string('has_custom_charge', 45)->default('0');
            $table->decimal('other_discount_amount', 16, 8)->nullable()->default(0);
            $table->string('other_discount_type', 45)->nullable();
            $table->decimal('shipping_charge', 16, 8)->nullable();
            $table->decimal('tax_charge', 16, 8)->nullable();
            $table->string('custom_charge_title')->nullable();
            $table->decimal('custom_charge_amount', 16, 8)->nullable();
            $table->decimal('total', 16, 8)->index();
            $table->decimal('paid', 16, 8)->index();
            $table->decimal('total_quantity', 16, 8);
            $table->decimal('amount_received', 16, 8)->nullable()->index();
            $table->unsignedInteger('order_status_id')->nullable()->index('orders_order_status_id_foreign_idx');
            $table->boolean('is_delivery')->default(false);
            $table->string('payment_status', 15)->default('Unpaid');
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
        Schema::dropIfExists('orders');
    }
}
