<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Agatha Williams',
                'email' => 'admin@techvill.net',
                'email_verified_at' => NULL,
                'password' => '$2y$10$i9TcRUzJ3U50b1dmPcNi1e/IMnR0sNUwAI8I.T5aY6BqM.X6Z5P7.',
                'phone' => NULL,
                'birthday' => NULL,
                'gender' => 'Male',
                'address' => NULL,
                'sso_account_id' => NULL,
                'sso_service' => NULL,
                'remember_token' => NULL,
                'status' => 'Active',
                'activation_code' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Blaine Keller',
                'email' => 'user@techvill.net',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gCnh8y2q0qvb3NIFQqiIKO2nd207kOHbgkvbpy6pzYfvxD9QYd42e',
                'phone' => NULL,
                'birthday' => NULL,
                'gender' => NULL,
                'address' => NULL,
                'sso_account_id' => NULL,
                'sso_service' => NULL,
                'remember_token' => NULL,
                'status' => 'Active',
                'activation_code' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Jamal',
                'email' => 'vendor@techvill.net',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NpOOxsJ0SssKawRKn3i8mOg/zKnmHuHO924FCZGwOJ49FbKqwuDlq',
                'phone' => NULL,
                'birthday' => NULL,
                'gender' => NULL,
                'address' => NULL,
                'sso_account_id' => NULL,
                'sso_service' => NULL,
                'remember_token' => NULL,
                'status' => 'Active',
                'activation_code' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'snowflake hamiz',
                'email' => 'user1@techvill.net',
                'email_verified_at' => NULL,
                'password' => '$2y$10$NBrKA4S3Z3ZXvSwi.lO5buYKjqFtaNNUjuGPDvKh2OyeMGzn4Zt/C',
                'phone' => NULL,
                'birthday' => NULL,
                'gender' => 'Male',
                'address' => NULL,
                'sso_account_id' => NULL,
                'sso_service' => NULL,
                'remember_token' => NULL,
                'status' => 'Active',
                'activation_code' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'glimmer queen',
                'email' => 'user2@techvill.net',
                'email_verified_at' => NULL,
                'password' => '$2y$10$GC.koGc2ZVYLLmLhRaqwv..ZtcLMmSE/Jh5jerYbNCWhtMuZ9KktC',
                'phone' => NULL,
                'birthday' => NULL,
                'gender' => 'Male',
                'address' => NULL,
                'sso_account_id' => NULL,
                'sso_service' => NULL,
                'remember_token' => NULL,
                'status' => 'Active',
                'activation_code' => NULL,
            ),
        ));


    }
}
