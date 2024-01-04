<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailConfigurationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('email_configurations')->delete();

        \DB::table('email_configurations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'protocol' => 'smtp',
                'encryption' => 'tls',
                'smtp_host' => 'mail.homemaintaining.com',
                'smtp_port' => '2525',
                'smtp_email' => 'multivendor@homemaintaining.com',
                'smtp_username' => 'multivendor@homemaintaining.com',
                'smtp_password' => 'Es[@N8-_BE?G',
                'from_address' => 'multivendor@homemaintaining.com',
                'from_name' => 'multivendor@homemaintaining.com',
                'status' => 'active',
            ),
        ));


    }
}
