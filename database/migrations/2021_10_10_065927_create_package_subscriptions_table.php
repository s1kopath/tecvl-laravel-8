<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_subscriptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100)->nullable();
            $table->integer('vendor_id')->nullable()->index();
            $table->integer('package_id')->nullable()->index();
            $table->date('activation_date')->nullable();
            $table->date('billing_date')->nullable()->index();
            $table->date('next_billing_date')->nullable()->index();
            $table->string('billing_name', 191)->nullable();
            $table->string('billing_first_name', 100)->nullable();
            $table->string('billing_last_name', 100)->nullable();
            $table->string('billing_email', 64)->nullable()->index('package_subscriptions_email_index');
            $table->string('billing_street_address', 64)->nullable();
            $table->string('billing_street_address2', 64)->nullable();
            $table->string('billing_city', 64)->nullable();
            $table->string('billing_state', 64)->nullable();
            $table->string('billing_zip', 16)->nullable();
            $table->string('billing_country', 64)->nullable();
            $table->string('billing_phone', 16)->nullable();
            $table->decimal('billing_price', 16, 8)->nullable()->default(0);
            $table->string('billing_cycle', 45)->nullable();
            $table->decimal('amount_billed', 16, 8)->nullable()->default(0);
            $table->decimal('amount_received', 16, 8)->nullable()->default(0);
            $table->decimal('amount_due', 16, 8)->nullable()->default(0);
            $table->string('payment_processor', 45)->nullable()->default('2co')->index();
            $table->string('transaction_order_number', 45)->nullable()->index();
            $table->string('transaction_invoice_id', 45)->nullable()->index('package_subscriptions_transcation_invoice_index');
            $table->string('transaction_reference', 45)->nullable()->index();
            $table->tinyInteger('is_customized')->nullable()->index();
            $table->integer('customized_records')->nullable();
            $table->boolean('is_renewed')->nullable()->index();
            $table->string('status', 45)->nullable()->index()->comment('Pending / Active / Expired / Paused');
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
        Schema::dropIfExists('package_subscriptions');
    }
}
