<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageSubscriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('package_subscriptions')->delete();

        \DB::table('package_subscriptions')->insert(array (
            0 =>
            array (
                'id' => 2,
                'name' => 'Free',
                'vendor_id' => 1,
                'package_id' => 1,
                'activation_date' => now(),
                'billing_date' => now(),
                'next_billing_date' => date('Y-m-d', strtotime('+30 days')),
                'billing_name' => 'Jamal Smith',
                'billing_first_name' => 'Jamal',
                'billing_last_name' => 'Smith',
                'billing_email' => 'vendor@techvill.net',
                'billing_street_address' => NULL,
                'billing_street_address2' => NULL,
                'billing_city' => NULL,
                'billing_state' => NULL,
                'billing_zip' => NULL,
                'billing_country' => NULL,
                'billing_phone' => '01685478965',
                'billing_price' => '0.00000000',
                'billing_cycle' => 'monthly',
                'amount_billed' => '0.00000000',
                'amount_received' => '0.00000000',
                'amount_due' => '0.00000000',
                'payment_processor' => 'Stripe',
                'transaction_order_number' => 'aa3d3dgree3',
                'transaction_invoice_id' => 'sdkf3223d',
                'transaction_reference' => 'ska3232sd',
                'is_customized' => NULL,
                'customized_records' => NULL,
                'is_renewed' => NULL,
                'status' => 'active',
                'created_at' => '2021-11-15 09:27:59',
                'updated_at' => NULL,
            ),
        ));


    }
}
