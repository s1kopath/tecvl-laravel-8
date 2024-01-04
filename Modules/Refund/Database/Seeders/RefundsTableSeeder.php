<?php

namespace Modules\Refund\Database\Seeders;

use Illuminate\Database\Seeder;

class RefundsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('refunds')->delete();

        \DB::table('refunds')->insert(array (
            0 =>
            array (
                'id' => 2,
                'user_id' => 2,
                'order_detail_id' => 1,
                'refund_reason_id' => 16,
                'quantity_sent' => 2,
                'refund_type' => 'Partial',
                'refund_method' => 'Wallet',
                'shipping_method' => 'Drop',
                'payment_status' => 'Paid',
                'status' => 'Pending',
            ),
        ));


    }
}
