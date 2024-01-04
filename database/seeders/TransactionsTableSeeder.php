<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('transactions')->delete();

        \DB::table('transactions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 3,
                'currency_id' => 3,
                'account_id' => NULL,
                'shop_id' => NULL,
                'vendor_id' => NULL,
                'order_id' => NULL,
                'withdrawal_method_id' => 2,
                'exchange_currency_id' => NULL,
                'exchange_rate' => NULL,
                'amount' => '25.00000000',
                'charge_amount' => NULL,
                'commission_amount' => NULL,
                'discount_amount' => NULL,
                'paid_amount' => NULL,
                'total_amount' => '25.00000000',
                'transaction_type' => 'Withdrawal',
                'transaction_date' => '2022-02-27',
                'reference_number' => NULL,
                'reference_type' => NULL,
                'description' => NULL,
                'params' => NULL,
                'status' => 'Pending',
            ),
        ));


    }
}
