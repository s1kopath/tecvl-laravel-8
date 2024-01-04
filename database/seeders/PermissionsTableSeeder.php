<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'index',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'store',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'detail',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'update',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@updatePassword',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updatePassword',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'App\\Http\\Controllers\\Api\\UserController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'destroy',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'App\\Http\\Controllers\\Api\\RoleController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'index',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'App\\Http\\Controllers\\Api\\RoleController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'store',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'App\\Http\\Controllers\\Api\\RoleController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'detail',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'App\\Http\\Controllers\\Api\\RoleController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'update',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'App\\Http\\Controllers\\Api\\RoleController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'destroy',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'App\\Http\\Controllers\\Api\\MailTemplateController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'index',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'App\\Http\\Controllers\\Api\\MailTemplateController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'store',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'App\\Http\\Controllers\\Api\\MailTemplateController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'detail',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'App\\Http\\Controllers\\Api\\MailTemplateController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'update',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'App\\Http\\Controllers\\Api\\MailTemplateController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'destroy',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'App\\Http\\Controllers\\Api\\SmsTemplateController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'index',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'App\\Http\\Controllers\\Api\\SmsTemplateController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'store',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'App\\Http\\Controllers\\Api\\SmsTemplateController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'detail',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'App\\Http\\Controllers\\Api\\SmsTemplateController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'update',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'App\\Http\\Controllers\\Api\\SmsTemplateController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'destroy',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'App\\Http\\Controllers\\Api\\PreferenceController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PreferenceController',
                'controller_name' => 'PreferenceController',
                'method_name' => 'index',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'App\\Http\\Controllers\\Api\\EmailConfigurationController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\EmailConfigurationController',
                'controller_name' => 'EmailConfigurationController',
                'method_name' => 'index',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'App\\Http\\Controllers\\Api\\CompanySettingController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CompanySettingController',
                'controller_name' => 'CompanySettingController',
                'method_name' => 'index',
            ),
            24 => 
            array (
                'id' => 26,
                'name' => 'App\\Http\\Controllers\\Api\\SmsConfigurationController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\SmsConfigurationController',
                'controller_name' => 'SmsConfigurationController',
                'method_name' => 'index',
            ),
            25 => 
            array (
                'id' => 27,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@currencyConverterSetup',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'currencyConverterSetup',
            ),
            26 => 
            array (
                'id' => 28,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'index',
            ),
            27 => 
            array (
                'id' => 29,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'store',
            ),
            28 => 
            array (
                'id' => 30,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'update',
            ),
            29 => 
            array (
                'id' => 31,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'detail',
            ),
            30 => 
            array (
                'id' => 32,
                'name' => 'App\\Http\\Controllers\\Api\\CurrencyController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'destroy',
            ),
            31 => 
            array (
                'id' => 33,
                'name' => 'App\\Http\\Controllers\\Api\\TaxController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'index',
            ),
            32 => 
            array (
                'id' => 34,
                'name' => 'App\\Http\\Controllers\\Api\\TaxController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'store',
            ),
            33 => 
            array (
                'id' => 35,
                'name' => 'App\\Http\\Controllers\\Api\\TaxController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'update',
            ),
            34 => 
            array (
                'id' => 36,
                'name' => 'App\\Http\\Controllers\\Api\\TaxController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'detail',
            ),
            35 => 
            array (
                'id' => 37,
                'name' => 'App\\Http\\Controllers\\Api\\PackageController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'index',
            ),
            36 => 
            array (
                'id' => 38,
                'name' => 'App\\Http\\Controllers\\Api\\PackageController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'store',
            ),
            37 => 
            array (
                'id' => 39,
                'name' => 'App\\Http\\Controllers\\Api\\PackageController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'update',
            ),
            38 => 
            array (
                'id' => 40,
                'name' => 'App\\Http\\Controllers\\Api\\PackageController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'detail',
            ),
            39 => 
            array (
                'id' => 41,
                'name' => 'App\\Http\\Controllers\\Api\\PackageController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'destroy',
            ),
            40 => 
            array (
                'id' => 52,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'index',
            ),
            41 => 
            array (
                'id' => 53,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'store',
            ),
            42 => 
            array (
                'id' => 54,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'update',
            ),
            43 => 
            array (
                'id' => 55,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'detail',
            ),
            44 => 
            array (
                'id' => 56,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'destroy',
            ),
            45 => 
            array (
                'id' => 57,
                'name' => 'App\\Http\\Controllers\\Api\\BrandController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'index',
            ),
            46 => 
            array (
                'id' => 58,
                'name' => 'App\\Http\\Controllers\\Api\\BrandController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'store',
            ),
            47 => 
            array (
                'id' => 59,
                'name' => 'App\\Http\\Controllers\\Api\\BrandController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'update',
            ),
            48 => 
            array (
                'id' => 60,
                'name' => 'App\\Http\\Controllers\\Api\\BrandController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'detail',
            ),
            49 => 
            array (
                'id' => 61,
                'name' => 'App\\Http\\Controllers\\Api\\BrandController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'destroy',
            ),
            50 => 
            array (
                'id' => 62,
                'name' => 'App\\Http\\Controllers\\Api\\VendorController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'index',
            ),
            51 => 
            array (
                'id' => 63,
                'name' => 'App\\Http\\Controllers\\Api\\VendorController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'store',
            ),
            52 => 
            array (
                'id' => 64,
                'name' => 'App\\Http\\Controllers\\Api\\VendorController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'update',
            ),
            53 => 
            array (
                'id' => 65,
                'name' => 'App\\Http\\Controllers\\Api\\VendorController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'detail',
            ),
            54 => 
            array (
                'id' => 66,
                'name' => 'App\\Http\\Controllers\\Api\\VendorController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'destroy',
            ),
            55 => 
            array (
                'id' => 72,
                'name' => 'App\\Http\\Controllers\\LoginController@showLoginForm',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showLoginForm',
            ),
            56 => 
            array (
                'id' => 73,
                'name' => 'App\\Http\\Controllers\\LoginController@showLoginForm',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showLoginForm',
            ),
            57 => 
            array (
                'id' => 74,
                'name' => 'App\\Http\\Controllers\\LoginController@authenticate',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'authenticate',
            ),
            58 => 
            array (
                'id' => 75,
                'name' => 'App\\Http\\Controllers\\CustomerAuth\\LoginController@showLoginForm',
                'controller_path' => 'App\\Http\\Controllers\\CustomerAuth\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showLoginForm',
            ),
            59 => 
            array (
                'id' => 76,
                'name' => 'App\\Http\\Controllers\\LoginController@logout',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'logout',
            ),
            60 => 
            array (
                'id' => 77,
                'name' => 'App\\Http\\Controllers\\DashboardController@index',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'index',
            ),
            61 => 
            array (
                'id' => 78,
                'name' => 'App\\Http\\Controllers\\RoleController@index',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'index',
            ),
            62 => 
            array (
                'id' => 79,
                'name' => 'App\\Http\\Controllers\\RoleController@create',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'create',
            ),
            63 => 
            array (
                'id' => 80,
                'name' => 'App\\Http\\Controllers\\RoleController@store',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'store',
            ),
            64 => 
            array (
                'id' => 81,
                'name' => 'App\\Http\\Controllers\\RoleController@edit',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'edit',
            ),
            65 => 
            array (
                'id' => 82,
                'name' => 'App\\Http\\Controllers\\RoleController@update',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'update',
            ),
            66 => 
            array (
                'id' => 83,
                'name' => 'App\\Http\\Controllers\\RoleController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\RoleController',
                'controller_name' => 'RoleController',
                'method_name' => 'destroy',
            ),
            67 => 
            array (
                'id' => 84,
                'name' => 'App\\Http\\Controllers\\PermissionRoleController@index',
                'controller_path' => 'App\\Http\\Controllers\\PermissionRoleController',
                'controller_name' => 'PermissionRoleController',
                'method_name' => 'index',
            ),
            68 => 
            array (
                'id' => 85,
                'name' => 'App\\Http\\Controllers\\PermissionRoleController@generatePermission',
                'controller_path' => 'App\\Http\\Controllers\\PermissionRoleController',
                'controller_name' => 'PermissionRoleController',
                'method_name' => 'generatePermission',
            ),
            69 => 
            array (
                'id' => 86,
                'name' => 'App\\Http\\Controllers\\PermissionRoleController@assignPermission',
                'controller_path' => 'App\\Http\\Controllers\\PermissionRoleController',
                'controller_name' => 'PermissionRoleController',
                'method_name' => 'assignPermission',
            ),
            70 => 
            array (
                'id' => 87,
                'name' => 'App\\Http\\Controllers\\UserController@index',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'index',
            ),
            71 => 
            array (
                'id' => 88,
                'name' => 'App\\Http\\Controllers\\UserController@create',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'create',
            ),
            72 => 
            array (
                'id' => 89,
                'name' => 'App\\Http\\Controllers\\UserController@store',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'store',
            ),
            73 => 
            array (
                'id' => 90,
                'name' => 'App\\Http\\Controllers\\UserController@edit',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'edit',
            ),
            74 => 
            array (
                'id' => 91,
                'name' => 'App\\Http\\Controllers\\UserController@updatePassword',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updatePassword',
            ),
            75 => 
            array (
                'id' => 92,
                'name' => 'App\\Http\\Controllers\\UserController@update',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'update',
            ),
            76 => 
            array (
                'id' => 93,
                'name' => 'App\\Http\\Controllers\\UserController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'destroy',
            ),
            77 => 
            array (
                'id' => 94,
                'name' => 'App\\Http\\Controllers\\UserController@import',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'import',
            ),
            78 => 
            array (
                'id' => 95,
                'name' => 'App\\Http\\Controllers\\UserController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'pdf',
            ),
            79 => 
            array (
                'id' => 96,
                'name' => 'App\\Http\\Controllers\\UserController@csv',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'csv',
            ),
            80 => 
            array (
                'id' => 97,
                'name' => 'App\\Http\\Controllers\\ItemController@index',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'index',
            ),
            81 => 
            array (
                'id' => 98,
                'name' => 'App\\Http\\Controllers\\ItemController@create',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'create',
            ),
            82 => 
            array (
                'id' => 99,
                'name' => 'App\\Http\\Controllers\\ItemController@store',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'store',
            ),
            83 => 
            array (
                'id' => 100,
                'name' => 'App\\Http\\Controllers\\ItemController@edit',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'edit',
            ),
            84 => 
            array (
                'id' => 101,
                'name' => 'App\\Http\\Controllers\\ItemController@getItemOption',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'getItemOption',
            ),
            85 => 
            array (
                'id' => 102,
                'name' => 'App\\Http\\Controllers\\ItemController@update',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'update',
            ),
            86 => 
            array (
                'id' => 103,
                'name' => 'App\\Http\\Controllers\\ItemController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'destroy',
            ),
            87 => 
            array (
                'id' => 104,
                'name' => 'App\\Http\\Controllers\\ItemController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'pdf',
            ),
            88 => 
            array (
                'id' => 105,
                'name' => 'App\\Http\\Controllers\\ItemController@csv',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'csv',
            ),
            89 => 
            array (
                'id' => 106,
                'name' => 'App\\Http\\Controllers\\VendorController@index',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'index',
            ),
            90 => 
            array (
                'id' => 107,
                'name' => 'App\\Http\\Controllers\\VendorController@create',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'create',
            ),
            91 => 
            array (
                'id' => 108,
                'name' => 'App\\Http\\Controllers\\VendorController@store',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'store',
            ),
            92 => 
            array (
                'id' => 109,
                'name' => 'App\\Http\\Controllers\\VendorController@edit',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'edit',
            ),
            93 => 
            array (
                'id' => 110,
                'name' => 'App\\Http\\Controllers\\VendorController@update',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'update',
            ),
            94 => 
            array (
                'id' => 111,
                'name' => 'App\\Http\\Controllers\\VendorController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'destroy',
            ),
            95 => 
            array (
                'id' => 112,
                'name' => 'App\\Http\\Controllers\\VendorController@import',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'import',
            ),
            96 => 
            array (
                'id' => 113,
                'name' => 'App\\Http\\Controllers\\VendorController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'pdf',
            ),
            97 => 
            array (
                'id' => 114,
                'name' => 'App\\Http\\Controllers\\VendorController@csv',
                'controller_path' => 'App\\Http\\Controllers\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'csv',
            ),
            98 => 
            array (
                'id' => 115,
                'name' => 'App\\Http\\Controllers\\BrandController@index',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'index',
            ),
            99 => 
            array (
                'id' => 116,
                'name' => 'App\\Http\\Controllers\\BrandController@create',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'create',
            ),
            100 => 
            array (
                'id' => 117,
                'name' => 'App\\Http\\Controllers\\BrandController@store',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'store',
            ),
            101 => 
            array (
                'id' => 118,
                'name' => 'App\\Http\\Controllers\\BrandController@edit',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'edit',
            ),
            102 => 
            array (
                'id' => 119,
                'name' => 'App\\Http\\Controllers\\BrandController@update',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'update',
            ),
            103 => 
            array (
                'id' => 120,
                'name' => 'App\\Http\\Controllers\\BrandController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'destroy',
            ),
            104 => 
            array (
                'id' => 121,
                'name' => 'App\\Http\\Controllers\\BrandController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'pdf',
            ),
            105 => 
            array (
                'id' => 122,
                'name' => 'App\\Http\\Controllers\\BrandController@csv',
                'controller_path' => 'App\\Http\\Controllers\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'csv',
            ),
            106 => 
            array (
                'id' => 123,
                'name' => 'App\\Http\\Controllers\\AttributeController@index',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'index',
            ),
            107 => 
            array (
                'id' => 124,
                'name' => 'App\\Http\\Controllers\\AttributeController@create',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'create',
            ),
            108 => 
            array (
                'id' => 125,
                'name' => 'App\\Http\\Controllers\\AttributeController@store',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'store',
            ),
            109 => 
            array (
                'id' => 126,
                'name' => 'App\\Http\\Controllers\\AttributeController@edit',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'edit',
            ),
            110 => 
            array (
                'id' => 127,
                'name' => 'App\\Http\\Controllers\\AttributeController@getAttribute',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'getAttribute',
            ),
            111 => 
            array (
                'id' => 128,
                'name' => 'App\\Http\\Controllers\\AttributeController@update',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'update',
            ),
            112 => 
            array (
                'id' => 129,
                'name' => 'App\\Http\\Controllers\\AttributeController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'destroy',
            ),
            113 => 
            array (
                'id' => 130,
                'name' => 'App\\Http\\Controllers\\AttributeController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'pdf',
            ),
            114 => 
            array (
                'id' => 131,
                'name' => 'App\\Http\\Controllers\\AttributeController@csv',
                'controller_path' => 'App\\Http\\Controllers\\AttributeController',
                'controller_name' => 'AttributeController',
                'method_name' => 'csv',
            ),
            115 => 
            array (
                'id' => 132,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@index',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'index',
            ),
            116 => 
            array (
                'id' => 133,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@create',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'create',
            ),
            117 => 
            array (
                'id' => 134,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@store',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'store',
            ),
            118 => 
            array (
                'id' => 135,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@edit',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'edit',
            ),
            119 => 
            array (
                'id' => 136,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@update',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'update',
            ),
            120 => 
            array (
                'id' => 137,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'destroy',
            ),
            121 => 
            array (
                'id' => 138,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'pdf',
            ),
            122 => 
            array (
                'id' => 139,
                'name' => 'App\\Http\\Controllers\\AttributeGroupController@csv',
                'controller_path' => 'App\\Http\\Controllers\\AttributeGroupController',
                'controller_name' => 'AttributeGroupController',
                'method_name' => 'csv',
            ),
            123 => 
            array (
                'id' => 140,
                'name' => 'App\\Http\\Controllers\\OptionController@index',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'index',
            ),
            124 => 
            array (
                'id' => 141,
                'name' => 'App\\Http\\Controllers\\OptionController@create',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'create',
            ),
            125 => 
            array (
                'id' => 142,
                'name' => 'App\\Http\\Controllers\\OptionController@store',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'store',
            ),
            126 => 
            array (
                'id' => 143,
                'name' => 'App\\Http\\Controllers\\OptionController@edit',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'edit',
            ),
            127 => 
            array (
                'id' => 144,
                'name' => 'App\\Http\\Controllers\\OptionController@getOption',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'getOption',
            ),
            128 => 
            array (
                'id' => 145,
                'name' => 'App\\Http\\Controllers\\OptionController@update',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'update',
            ),
            129 => 
            array (
                'id' => 146,
                'name' => 'App\\Http\\Controllers\\OptionController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'destroy',
            ),
            130 => 
            array (
                'id' => 147,
                'name' => 'App\\Http\\Controllers\\OptionController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'pdf',
            ),
            131 => 
            array (
                'id' => 148,
                'name' => 'App\\Http\\Controllers\\OptionController@csv',
                'controller_path' => 'App\\Http\\Controllers\\OptionController',
                'controller_name' => 'OptionController',
                'method_name' => 'csv',
            ),
            132 => 
            array (
                'id' => 149,
                'name' => 'App\\Http\\Controllers\\CategoryController@index',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'index',
            ),
            133 => 
            array (
                'id' => 150,
                'name' => 'App\\Http\\Controllers\\CategoryController@store',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'store',
            ),
            134 => 
            array (
                'id' => 151,
                'name' => 'App\\Http\\Controllers\\CategoryController@getData',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'getData',
            ),
            135 => 
            array (
                'id' => 152,
                'name' => 'App\\Http\\Controllers\\CategoryController@getParentData',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'getParentData',
            ),
            136 => 
            array (
                'id' => 153,
                'name' => 'App\\Http\\Controllers\\CategoryController@moveNode',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'moveNode',
            ),
            137 => 
            array (
                'id' => 154,
                'name' => 'App\\Http\\Controllers\\CategoryController@edit',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'edit',
            ),
            138 => 
            array (
                'id' => 155,
                'name' => 'App\\Http\\Controllers\\CategoryController@update',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'update',
            ),
            139 => 
            array (
                'id' => 156,
                'name' => 'App\\Http\\Controllers\\CategoryController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'destroy',
            ),
            140 => 
            array (
                'id' => 157,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@index',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'index',
            ),
            141 => 
            array (
                'id' => 158,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@create',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'create',
            ),
            142 => 
            array (
                'id' => 159,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@store',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'store',
            ),
            143 => 
            array (
                'id' => 160,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@edit',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'edit',
            ),
            144 => 
            array (
                'id' => 161,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@update',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'update',
            ),
            145 => 
            array (
                'id' => 162,
                'name' => 'App\\Http\\Controllers\\MailTemplateController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\MailTemplateController',
                'controller_name' => 'MailTemplateController',
                'method_name' => 'destroy',
            ),
            146 => 
            array (
                'id' => 163,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@index',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'index',
            ),
            147 => 
            array (
                'id' => 164,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@create',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'create',
            ),
            148 => 
            array (
                'id' => 165,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@store',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'store',
            ),
            149 => 
            array (
                'id' => 166,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@edit',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'edit',
            ),
            150 => 
            array (
                'id' => 167,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@update',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'update',
            ),
            151 => 
            array (
                'id' => 168,
                'name' => 'App\\Http\\Controllers\\SmsTemplateController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\SmsTemplateController',
                'controller_name' => 'SmsTemplateController',
                'method_name' => 'destroy',
            ),
            152 => 
            array (
                'id' => 169,
                'name' => 'App\\Http\\Controllers\\PreferenceController@index',
                'controller_path' => 'App\\Http\\Controllers\\PreferenceController',
                'controller_name' => 'PreferenceController',
                'method_name' => 'index',
            ),
            153 => 
            array (
                'id' => 170,
                'name' => 'App\\Http\\Controllers\\PreferenceController@theme',
                'controller_path' => 'App\\Http\\Controllers\\PreferenceController',
                'controller_name' => 'PreferenceController',
                'method_name' => 'theme',
            ),
            154 => 
            array (
                'id' => 171,
                'name' => 'App\\Http\\Controllers\\EmailConfigurationController@index',
                'controller_path' => 'App\\Http\\Controllers\\EmailConfigurationController',
                'controller_name' => 'EmailConfigurationController',
                'method_name' => 'index',
            ),
            155 => 
            array (
                'id' => 172,
                'name' => 'App\\Http\\Controllers\\CompanySettingController@index',
                'controller_path' => 'App\\Http\\Controllers\\CompanySettingController',
                'controller_name' => 'CompanySettingController',
                'method_name' => 'index',
            ),
            156 => 
            array (
                'id' => 173,
                'name' => 'App\\Http\\Controllers\\CompanySettingController@deleteImage',
                'controller_path' => 'App\\Http\\Controllers\\CompanySettingController',
                'controller_name' => 'CompanySettingController',
                'method_name' => 'deleteImage',
            ),
            157 => 
            array (
                'id' => 174,
                'name' => 'App\\Http\\Controllers\\CompanySettingController@deleteIcon',
                'controller_path' => 'App\\Http\\Controllers\\CompanySettingController',
                'controller_name' => 'CompanySettingController',
                'method_name' => 'deleteIcon',
            ),
            158 => 
            array (
                'id' => 175,
                'name' => 'App\\Http\\Controllers\\LanguageController@translation',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'translation',
            ),
            159 => 
            array (
                'id' => 176,
                'name' => 'App\\Http\\Controllers\\LanguageController@index',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'index',
            ),
            160 => 
            array (
                'id' => 177,
                'name' => 'App\\Http\\Controllers\\LanguageController@store',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'store',
            ),
            161 => 
            array (
                'id' => 178,
                'name' => 'App\\Http\\Controllers\\LanguageController@edit',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'edit',
            ),
            162 => 
            array (
                'id' => 179,
                'name' => 'App\\Http\\Controllers\\LanguageController@update',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'update',
            ),
            163 => 
            array (
                'id' => 180,
                'name' => 'App\\Http\\Controllers\\LanguageController@delete',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'delete',
            ),
            164 => 
            array (
                'id' => 181,
                'name' => 'App\\Http\\Controllers\\LanguageController@translationStore',
                'controller_path' => 'App\\Http\\Controllers\\LanguageController',
                'controller_name' => 'LanguageController',
                'method_name' => 'translationStore',
            ),
            165 => 
            array (
                'id' => 182,
                'name' => 'App\\Http\\Controllers\\CurrencyController@index',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'index',
            ),
            166 => 
            array (
                'id' => 183,
                'name' => 'App\\Http\\Controllers\\CurrencyController@store',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'store',
            ),
            167 => 
            array (
                'id' => 184,
                'name' => 'App\\Http\\Controllers\\CurrencyController@edit',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'edit',
            ),
            168 => 
            array (
                'id' => 185,
                'name' => 'App\\Http\\Controllers\\CurrencyController@update',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'update',
            ),
            169 => 
            array (
                'id' => 186,
                'name' => 'App\\Http\\Controllers\\CurrencyController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'destroy',
            ),
            170 => 
            array (
                'id' => 187,
                'name' => 'App\\Http\\Controllers\\CurrencyController@validCurrencyName',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'validCurrencyName',
            ),
            171 => 
            array (
                'id' => 188,
                'name' => 'App\\Http\\Controllers\\TaxController@index',
                'controller_path' => 'App\\Http\\Controllers\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'index',
            ),
            172 => 
            array (
                'id' => 189,
                'name' => 'App\\Http\\Controllers\\TaxController@store',
                'controller_path' => 'App\\Http\\Controllers\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'store',
            ),
            173 => 
            array (
                'id' => 190,
                'name' => 'App\\Http\\Controllers\\TaxController@edit',
                'controller_path' => 'App\\Http\\Controllers\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'edit',
            ),
            174 => 
            array (
                'id' => 191,
                'name' => 'App\\Http\\Controllers\\TaxController@update',
                'controller_path' => 'App\\Http\\Controllers\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'update',
            ),
            175 => 
            array (
                'id' => 197,
                'name' => 'App\\Http\\Controllers\\PackageController@index',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'index',
            ),
            176 => 
            array (
                'id' => 198,
                'name' => 'App\\Http\\Controllers\\PackageController@create',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'create',
            ),
            177 => 
            array (
                'id' => 199,
                'name' => 'App\\Http\\Controllers\\PackageController@store',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'store',
            ),
            178 => 
            array (
                'id' => 200,
                'name' => 'App\\Http\\Controllers\\PackageController@edit',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'edit',
            ),
            179 => 
            array (
                'id' => 201,
                'name' => 'App\\Http\\Controllers\\PackageController@update',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'update',
            ),
            180 => 
            array (
                'id' => 202,
                'name' => 'App\\Http\\Controllers\\PackageController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'destroy',
            ),
            181 => 
            array (
                'id' => 203,
                'name' => 'App\\Http\\Controllers\\PackageController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'pdf',
            ),
            182 => 
            array (
                'id' => 204,
                'name' => 'App\\Http\\Controllers\\PackageController@csv',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'csv',
            ),
            183 => 
            array (
                'id' => 205,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@index',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'index',
            ),
            184 => 
            array (
                'id' => 206,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@create',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'create',
            ),
            185 => 
            array (
                'id' => 207,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@store',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'store',
            ),
            186 => 
            array (
                'id' => 208,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@show',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'show',
            ),
            187 => 
            array (
                'id' => 209,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@edit',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'edit',
            ),
            188 => 
            array (
                'id' => 210,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@update',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'update',
            ),
            189 => 
            array (
                'id' => 211,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'destroy',
            ),
            190 => 
            array (
                'id' => 212,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'pdf',
            ),
            191 => 
            array (
                'id' => 213,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@csv',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'csv',
            ),
            192 => 
            array (
                'id' => 231,
                'name' => 'App\\Http\\Controllers\\SmsConfigurationController@index',
                'controller_path' => 'App\\Http\\Controllers\\SmsConfigurationController',
                'controller_name' => 'SmsConfigurationController',
                'method_name' => 'index',
            ),
            193 => 
            array (
                'id' => 232,
                'name' => 'App\\Http\\Controllers\\CurrencyController@currencyConverterSetup',
                'controller_path' => 'App\\Http\\Controllers\\CurrencyController',
                'controller_name' => 'CurrencyController',
                'method_name' => 'currencyConverterSetup',
            ),
            194 => 
            array (
                'id' => 233,
                'name' => 'App\\Http\\Controllers\\FilesController@downloadAttachment',
                'controller_path' => 'App\\Http\\Controllers\\FilesController',
                'controller_name' => 'FilesController',
                'method_name' => 'downloadAttachment',
            ),
            195 => 
            array (
                'id' => 234,
                'name' => 'App\\Http\\Controllers\\DashboardController@switchLanguage',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'switchLanguage',
            ),
            196 => 
            array (
                'id' => 245,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'index',
            ),
            197 => 
            array (
                'id' => 246,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'store',
            ),
            198 => 
            array (
                'id' => 247,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'update',
            ),
            199 => 
            array (
                'id' => 248,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'detail',
            ),
            200 => 
            array (
                'id' => 249,
                'name' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'destroy',
            ),
            201 => 
            array (
                'id' => 250,
                'name' => 'App\\Http\\Controllers\\PackageController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'pdf',
            ),
            202 => 
            array (
                'id' => 251,
                'name' => 'App\\Http\\Controllers\\PackageController@csv',
                'controller_path' => 'App\\Http\\Controllers\\PackageController',
                'controller_name' => 'PackageController',
                'method_name' => 'csv',
            ),
            203 => 
            array (
                'id' => 252,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'pdf',
            ),
            204 => 
            array (
                'id' => 253,
                'name' => 'App\\Http\\Controllers\\PackageSubscriptionController@csv',
                'controller_path' => 'App\\Http\\Controllers\\PackageSubscriptionController',
                'controller_name' => 'PackageSubscriptionController',
                'method_name' => 'csv',
            ),
            205 => 
            array (
                'id' => 254,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'index',
            ),
            206 => 
            array (
                'id' => 255,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController',
                'controller_name' => 'AuthorizationController',
                'method_name' => 'authorize',
            ),
            207 => 
            array (
                'id' => 256,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController',
                'controller_name' => 'ApproveAuthorizationController',
                'method_name' => 'approve',
            ),
            208 => 
            array (
                'id' => 257,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController',
                'controller_name' => 'DenyAuthorizationController',
                'method_name' => 'deny',
            ),
            209 => 
            array (
                'id' => 258,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController',
                'controller_name' => 'AccessTokenController',
                'method_name' => 'issueToken',
            ),
            210 => 
            array (
                'id' => 259,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController',
                'controller_name' => 'AuthorizedAccessTokenController',
                'method_name' => 'forUser',
            ),
            211 => 
            array (
                'id' => 260,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController',
                'controller_name' => 'AuthorizedAccessTokenController',
                'method_name' => 'destroy',
            ),
            212 => 
            array (
                'id' => 261,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController',
                'controller_name' => 'TransientTokenController',
                'method_name' => 'refresh',
            ),
            213 => 
            array (
                'id' => 262,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController',
                'controller_name' => 'ClientController',
                'method_name' => 'forUser',
            ),
            214 => 
            array (
                'id' => 263,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@store',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController',
                'controller_name' => 'ClientController',
                'method_name' => 'store',
            ),
            215 => 
            array (
                'id' => 264,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@update',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController',
                'controller_name' => 'ClientController',
                'method_name' => 'update',
            ),
            216 => 
            array (
                'id' => 265,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController',
                'controller_name' => 'ClientController',
                'method_name' => 'destroy',
            ),
            217 => 
            array (
                'id' => 266,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController',
                'controller_name' => 'ScopeController',
                'method_name' => 'all',
            ),
            218 => 
            array (
                'id' => 267,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController',
                'controller_name' => 'PersonalAccessTokenController',
                'method_name' => 'forUser',
            ),
            219 => 
            array (
                'id' => 268,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController',
                'controller_name' => 'PersonalAccessTokenController',
                'method_name' => 'store',
            ),
            220 => 
            array (
                'id' => 269,
                'name' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
                'controller_path' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController',
                'controller_name' => 'PersonalAccessTokenController',
                'method_name' => 'destroy',
            ),
            221 => 
            array (
                'id' => 271,
                'name' => 'App\\Http\\Controllers\\Api\\AuthController@login',
                'controller_path' => 'App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'login',
            ),
            222 => 
            array (
                'id' => 272,
                'name' => 'App\\Http\\Controllers\\Api\\AuthController@logout',
                'controller_path' => 'App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'logout',
            ),
            223 => 
            array (
                'id' => 278,
                'name' => 'App\\Http\\Controllers\\LoginController@showResetForm',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showResetForm',
            ),
            224 => 
            array (
                'id' => 279,
                'name' => 'App\\Http\\Controllers\\LoginController@setPassword',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'setPassword',
            ),
            225 => 
            array (
                'id' => 280,
                'name' => 'App\\Http\\Controllers\\LoginController@sendResetLinkEmail',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'sendResetLinkEmail',
            ),
            226 => 
            array (
                'id' => 281,
                'name' => 'App\\Http\\Controllers\\LoginController@reset',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'reset',
            ),
            227 => 
            array (
                'id' => 282,
                'name' => 'App\\Http\\Controllers\\UserController@verification',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'verification',
            ),
            228 => 
            array (
                'id' => 283,
                'name' => 'App\\Http\\Controllers\\UserController@updateProfile',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updateProfile',
            ),
            229 => 
            array (
                'id' => 284,
                'name' => 'App\\Http\\Controllers\\UserController@profile',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'profile',
            ),
            230 => 
            array (
                'id' => 285,
                'name' => 'App\\Http\\Controllers\\UserController@updateProfilePassword',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updateProfilePassword',
            ),
            231 => 
            array (
                'id' => 286,
                'name' => 'App\\Http\\Controllers\\ItemController@view',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'view',
            ),
            232 => 
            array (
                'id' => 287,
                'name' => 'App\\Http\\Controllers\\ItemController@search',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'search',
            ),
            233 => 
            array (
                'id' => 289,
                'name' => 'App\\Http\\Controllers\\FilesController@uploadEventAttachments',
                'controller_path' => 'App\\Http\\Controllers\\FilesController',
                'controller_name' => 'FilesController',
                'method_name' => 'uploadEventAttachments',
            ),
            234 => 
            array (
                'id' => 290,
                'name' => 'App\\Http\\Controllers\\FilesController@deleteEventAttachment',
                'controller_path' => 'App\\Http\\Controllers\\FilesController',
                'controller_name' => 'FilesController',
                'method_name' => 'deleteEventAttachment',
            ),
            235 => 
            array (
                'id' => 291,
                'name' => 'App\\Http\\Controllers\\FilesController@isValidFileSize',
                'controller_path' => 'App\\Http\\Controllers\\FilesController',
                'controller_name' => 'FilesController',
                'method_name' => 'isValidFileSize',
            ),
            236 => 
            array (
                'id' => 292,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorController@profile',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'profile',
            ),
            237 => 
            array (
                'id' => 293,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorController@update',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'update',
            ),
            238 => 
            array (
                'id' => 294,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorController@updatePassword',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'updatePassword',
            ),
            239 => 
            array (
                'id' => 295,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorController@logout',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorController',
                'controller_name' => 'VendorController',
                'method_name' => 'logout',
            ),
            240 => 
            array (
                'id' => 304,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'index',
            ),
            241 => 
            array (
                'id' => 305,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@packageList',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'packageList',
            ),
            242 => 
            array (
                'id' => 306,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@packageSubscription',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'packageSubscription',
            ),
            243 => 
            array (
                'id' => 307,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@cancelSubscription',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'cancelSubscription',
            ),
            244 => 
            array (
                'id' => 308,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@paymentSubscription',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'paymentSubscription',
            ),
            245 => 
            array (
                'id' => 310,
                'name' => 'App\\Http\\Controllers\\Api\\AuthController@sendResetLinkEmail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'sendResetLinkEmail',
            ),
            246 => 
            array (
                'id' => 311,
                'name' => 'App\\Http\\Controllers\\Api\\AuthController@setPassword',
                'controller_path' => 'App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'setPassword',
            ),
            247 => 
            array (
                'id' => 312,
                'name' => 'App\\Http\\Controllers\\ItemController@updateRealted',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'updateRealted',
            ),
            248 => 
            array (
                'id' => 313,
                'name' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController@renewSubscription',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\MySubscriptionController',
                'controller_name' => 'MySubscriptionController',
                'method_name' => 'renewSubscription',
            ),
            249 => 
            array (
                'id' => 314,
                'name' => 'App\\Http\\Controllers\\ReviewController@index',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'index',
            ),
            250 => 
            array (
                'id' => 315,
                'name' => 'App\\Http\\Controllers\\ReviewController@edit',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'edit',
            ),
            251 => 
            array (
                'id' => 316,
                'name' => 'App\\Http\\Controllers\\ReviewController@view',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'view',
            ),
            252 => 
            array (
                'id' => 317,
                'name' => 'App\\Http\\Controllers\\ReviewController@update',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'update',
            ),
            253 => 
            array (
                'id' => 318,
                'name' => 'App\\Http\\Controllers\\ReviewController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'destroy',
            ),
            254 => 
            array (
                'id' => 319,
                'name' => 'App\\Http\\Controllers\\ReviewController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'pdf',
            ),
            255 => 
            array (
                'id' => 320,
                'name' => 'App\\Http\\Controllers\\ReviewController@csv',
                'controller_path' => 'App\\Http\\Controllers\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'csv',
            ),
            256 => 
            array (
                'id' => 321,
                'name' => 'App\\Http\\Controllers\\SsoController@index',
                'controller_path' => 'App\\Http\\Controllers\\SsoController',
                'controller_name' => 'SsoController',
                'method_name' => 'index',
            ),
            257 => 
            array (
                'id' => 322,
                'name' => 'App\\Http\\Controllers\\MaintenanceModeController@enable',
                'controller_path' => 'App\\Http\\Controllers\\MaintenanceModeController',
                'controller_name' => 'MaintenanceModeController',
                'method_name' => 'enable',
            ),
            258 => 
            array (
                'id' => 323,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'index',
            ),
            259 => 
            array (
                'id' => 324,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@login',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'login',
            ),
            260 => 
            array (
                'id' => 325,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@authenticate',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'authenticate',
            ),
            261 => 
            array (
                'id' => 326,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@verification',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'verification',
            ),
            262 => 
            array (
                'id' => 327,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@showSignUpform',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showSignUpform',
            ),
            263 => 
            array (
                'id' => 328,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@signUp',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'signUp',
            ),
            264 => 
            array (
                'id' => 329,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@logout',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'logout',
            ),
            265 => 
            array (
                'id' => 330,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@redirectToGoogle',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'redirectToGoogle',
            ),
            266 => 
            array (
                'id' => 331,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@handelGoogleCallback',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'handelGoogleCallback',
            ),
            267 => 
            array (
                'id' => 332,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@redirectToFacebook',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'redirectToFacebook',
            ),
            268 => 
            array (
                'id' => 333,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@handelFacebookCallback',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'handelFacebookCallback',
            ),
            269 => 
            array (
                'id' => 334,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@itemDetails',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'itemDetails',
            ),
            270 => 
            array (
                'id' => 335,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@reviewStore',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'reviewStore',
            ),
            271 => 
            array (
                'id' => 336,
                'name' => 'App\\Http\\Controllers\\Site\\DashboardController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'index',
            ),
            272 => 
            array (
                'id' => 339,
                'name' => 'Modules\\Addons\\Http\\Controllers\\AddonsController@upload',
                'controller_path' => 'Modules\\Addons\\Http\\Controllers\\AddonsController',
                'controller_name' => 'AddonsController',
                'method_name' => 'upload',
            ),
            273 => 
            array (
                'id' => 340,
                'name' => 'Modules\\Addons\\Http\\Controllers\\AddonsController@switchStatus',
                'controller_path' => 'Modules\\Addons\\Http\\Controllers\\AddonsController',
                'controller_name' => 'AddonsController',
                'method_name' => 'switchStatus',
            ),
            274 => 
            array (
                'id' => 342,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController@index',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'index',
            ),
            275 => 
            array (
                'id' => 343,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController@store',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'store',
            ),
            276 => 
            array (
                'id' => 344,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController@update',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'update',
            ),
            277 => 
            array (
                'id' => 345,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController@detail',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'detail',
            ),
            278 => 
            array (
                'id' => 346,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController@destroy',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Api\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'destroy',
            ),
            279 => 
            array (
                'id' => 347,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@index',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'index',
            ),
            280 => 
            array (
                'id' => 348,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@create',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'create',
            ),
            281 => 
            array (
                'id' => 349,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@store',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'store',
            ),
            282 => 
            array (
                'id' => 350,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@edit',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'edit',
            ),
            283 => 
            array (
                'id' => 351,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@update',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'update',
            ),
            284 => 
            array (
                'id' => 352,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@destroy',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'destroy',
            ),
            285 => 
            array (
                'id' => 357,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController@index',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController',
                'controller_name' => 'CouponRedeemController',
                'method_name' => 'index',
            ),
            286 => 
            array (
                'id' => 358,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController@pdf',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController',
                'controller_name' => 'CouponRedeemController',
                'method_name' => 'pdf',
            ),
            287 => 
            array (
                'id' => 359,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController@csv',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponRedeemController',
                'controller_name' => 'CouponRedeemController',
                'method_name' => 'csv',
            ),
            288 => 
            array (
                'id' => 360,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController@index',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'index',
            ),
            289 => 
            array (
                'id' => 361,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController@store',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'store',
            ),
            290 => 
            array (
                'id' => 362,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController@update',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'update',
            ),
            291 => 
            array (
                'id' => 363,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController@detail',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'detail',
            ),
            292 => 
            array (
                'id' => 364,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController@destroy',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'destroy',
            ),
            293 => 
            array (
                'id' => 370,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@index',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'index',
            ),
            294 => 
            array (
                'id' => 371,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@create',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'create',
            ),
            295 => 
            array (
                'id' => 372,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@store',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'store',
            ),
            296 => 
            array (
                'id' => 373,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@edit',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'edit',
            ),
            297 => 
            array (
                'id' => 374,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@update',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'update',
            ),
            298 => 
            array (
                'id' => 375,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@destroy',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'destroy',
            ),
            299 => 
            array (
                'id' => 376,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@pdf',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'pdf',
            ),
            300 => 
            array (
                'id' => 377,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@csv',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'csv',
            ),
            301 => 
            array (
                'id' => 378,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@shopPdf',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'shopPdf',
            ),
            302 => 
            array (
                'id' => 379,
                'name' => 'Modules\\Shop\\Http\\Controllers\\ShopController@shopCsv',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'shopCsv',
            ),
            303 => 
            array (
                'id' => 388,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@edit',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'edit',
            ),
            304 => 
            array (
                'id' => 389,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@update',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'update',
            ),
            305 => 
            array (
                'id' => 390,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@editPassword',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'editPassword',
            ),
            306 => 
            array (
                'id' => 391,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@updatePassword',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updatePassword',
            ),
            307 => 
            array (
                'id' => 392,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@setting',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'setting',
            ),
            308 => 
            array (
                'id' => 393,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'destroy',
            ),
            309 => 
            array (
                'id' => 394,
                'name' => 'App\\Http\\Controllers\\Site\\WishlistController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\WishlistController',
                'controller_name' => 'WishlistController',
                'method_name' => 'index',
            ),
            310 => 
            array (
                'id' => 395,
                'name' => 'App\\Http\\Controllers\\Site\\WishlistController@store',
                'controller_path' => 'App\\Http\\Controllers\\Site\\WishlistController',
                'controller_name' => 'WishlistController',
                'method_name' => 'store',
            ),
            311 => 
            array (
                'id' => 396,
                'name' => 'App\\Http\\Controllers\\Site\\WishlistController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\WishlistController',
                'controller_name' => 'WishlistController',
                'method_name' => 'destroy',
            ),
            312 => 
            array (
                'id' => 397,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'index',
            ),
            313 => 
            array (
                'id' => 398,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@create',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'create',
            ),
            314 => 
            array (
                'id' => 399,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@store',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'store',
            ),
            315 => 
            array (
                'id' => 400,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@edit',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'edit',
            ),
            316 => 
            array (
                'id' => 401,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@update',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'update',
            ),
            317 => 
            array (
                'id' => 402,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'destroy',
            ),
            318 => 
            array (
                'id' => 403,
                'name' => 'App\\Http\\Controllers\\Site\\ReviewController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'index',
            ),
            319 => 
            array (
                'id' => 404,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'index',
            ),
            320 => 
            array (
                'id' => 405,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@store',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'store',
            ),
            321 => 
            array (
                'id' => 406,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@reduceQuantity',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'reduceQuantity',
            ),
            322 => 
            array (
                'id' => 407,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroy',
            ),
            323 => 
            array (
                'id' => 408,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'index',
            ),
            324 => 
            array (
                'id' => 410,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@destroySelected',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroySelected',
            ),
            325 => 
            array (
                'id' => 411,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@storeSelected',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'storeSelected',
            ),
            326 => 
            array (
                'id' => 412,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@checkCoupon',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'checkCoupon',
            ),
            327 => 
            array (
                'id' => 413,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@index',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'index',
            ),
            328 => 
            array (
                'id' => 414,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@create',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'create',
            ),
            329 => 
            array (
                'id' => 415,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@store',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'store',
            ),
            330 => 
            array (
                'id' => 416,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@edit',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'edit',
            ),
            331 => 
            array (
                'id' => 417,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@update',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'update',
            ),
            332 => 
            array (
                'id' => 418,
                'name' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController@destroy',
                'controller_path' => 'Modules\\Shipping\\Http\\Controllers\\ShippingController',
                'controller_name' => 'ShippingController',
                'method_name' => 'destroy',
            ),
            333 => 
            array (
                'id' => 419,
                'name' => 'App\\Http\\Controllers\\Site\\DashboardController@switchLanguage',
                'controller_path' => 'App\\Http\\Controllers\\Site\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'switchLanguage',
            ),
            334 => 
            array (
                'id' => 420,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@orderDetails',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'orderDetails',
            ),
            335 => 
            array (
                'id' => 421,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'index',
            ),
            336 => 
            array (
                'id' => 422,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'destroy',
            ),
            337 => 
            array (
                'id' => 423,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'pdf',
            ),
            338 => 
            array (
                'id' => 428,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController@index',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController',
                'controller_name' => 'BlogCategoryController',
                'method_name' => 'index',
            ),
            339 => 
            array (
                'id' => 431,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController@delete',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController',
                'controller_name' => 'BlogCategoryController',
                'method_name' => 'delete',
            ),
            340 => 
            array (
                'id' => 432,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@index',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'index',
            ),
            341 => 
            array (
                'id' => 433,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@create',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'create',
            ),
            342 => 
            array (
                'id' => 434,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@edit',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'edit',
            ),
            343 => 
            array (
                'id' => 435,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@delete',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'delete',
            ),
            344 => 
            array (
                'id' => 444,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@index',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'index',
            ),
            345 => 
            array (
                'id' => 445,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@create',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'create',
            ),
            346 => 
            array (
                'id' => 446,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@edit',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'edit',
            ),
            347 => 
            array (
                'id' => 447,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@delete',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'delete',
            ),
            348 => 
            array (
                'id' => 452,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@csv',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'csv',
            ),
            349 => 
            array (
                'id' => 453,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'index',
            ),
            350 => 
            array (
                'id' => 454,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@edit',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'edit',
            ),
            351 => 
            array (
                'id' => 455,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@view',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'view',
            ),
            352 => 
            array (
                'id' => 456,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@update',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'update',
            ),
            353 => 
            array (
                'id' => 457,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'destroy',
            ),
            354 => 
            array (
                'id' => 458,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'pdf',
            ),
            355 => 
            array (
                'id' => 459,
                'name' => 'App\\Http\\Controllers\\Vendor\\ReviewController@csv',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'csv',
            ),
            356 => 
            array (
                'id' => 460,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@fetch',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'fetch',
            ),
            357 => 
            array (
                'id' => 461,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@store',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'store',
            ),
            358 => 
            array (
                'id' => 462,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@confirmation',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'confirmation',
            ),
            359 => 
            array (
                'id' => 463,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@checkOut',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'checkOut',
            ),
            360 => 
            array (
                'id' => 464,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@updateReview',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'updateReview',
            ),
            361 => 
            array (
                'id' => 465,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@deleteReview',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'deleteReview',
            ),
            362 => 
            array (
                'id' => 466,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@filterReview',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'filterReview',
            ),
            363 => 
            array (
                'id' => 467,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@blogDetails',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'blogDetails',
            ),
            364 => 
            array (
                'id' => 468,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@blogCategory',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'blogCategory',
            ),
            365 => 
            array (
                'id' => 469,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@page',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'page',
            ),
            366 => 
            array (
                'id' => 470,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@categoryItems',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'categoryItems',
            ),
            367 => 
            array (
                'id' => 471,
                'name' => 'App\\Http\\Controllers\\Site\\CartController@destroyAll',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroyAll',
            ),
            368 => 
            array (
                'id' => 472,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@filter',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'filter',
            ),
            369 => 
            array (
                'id' => 473,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@search',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'search',
            ),
            370 => 
            array (
                'id' => 474,
                'name' => 'App\\Http\\Controllers\\Site\\CompareController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CompareController',
                'controller_name' => 'CompareController',
                'method_name' => 'index',
            ),
            371 => 
            array (
                'id' => 475,
                'name' => 'App\\Http\\Controllers\\Site\\CompareController@store',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CompareController',
                'controller_name' => 'CompareController',
                'method_name' => 'store',
            ),
            372 => 
            array (
                'id' => 476,
                'name' => 'App\\Http\\Controllers\\Site\\CompareController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\CompareController',
                'controller_name' => 'CompareController',
                'method_name' => 'destroy',
            ),
            373 => 
            array (
                'id' => 477,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController@store',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController',
                'controller_name' => 'BlogCategoryController',
                'method_name' => 'store',
            ),
            374 => 
            array (
                'id' => 478,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController@update',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogCategoryController',
                'controller_name' => 'BlogCategoryController',
                'method_name' => 'update',
            ),
            375 => 
            array (
                'id' => 479,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@store',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'store',
            ),
            376 => 
            array (
                'id' => 480,
                'name' => 'Modules\\Blog\\Http\\Controllers\\BlogController@update',
                'controller_path' => 'Modules\\Blog\\Http\\Controllers\\BlogController',
                'controller_name' => 'BlogController',
                'method_name' => 'update',
            ),
            377 => 
            array (
                'id' => 481,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@store',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'store',
            ),
            378 => 
            array (
                'id' => 482,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@update',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'update',
            ),
            379 => 
            array (
                'id' => 488,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuBuilderController@index',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuBuilderController',
                'controller_name' => 'MenuBuilderController',
                'method_name' => 'index',
            ),
            380 => 
            array (
                'id' => 489,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@createNewMenu',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'createNewMenu',
            ),
            381 => 
            array (
                'id' => 490,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@delete',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'delete',
            ),
            382 => 
            array (
                'id' => 491,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@addCustomMenu',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'addCustomMenu',
            ),
            383 => 
            array (
                'id' => 492,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@update',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'update',
            ),
            384 => 
            array (
                'id' => 493,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@generateMenuControl',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'generateMenuControl',
            ),
            385 => 
            array (
                'id' => 494,
                'name' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController@deleteMenu',
                'controller_path' => 'Modules\\MenuBuilder\\Http\\Controllers\\MenuController',
                'controller_name' => 'MenuController',
                'method_name' => 'deleteMenu',
            ),
            386 => 
            array (
                'id' => 496,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@profile',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'profile',
            ),
            387 => 
            array (
                'id' => 497,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'update',
            ),
            388 => 
            array (
                'id' => 498,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@updatePassword',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'updatePassword',
            ),
            389 => 
            array (
                'id' => 499,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'destroy',
            ),
            390 => 
            array (
                'id' => 500,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@login',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'login',
            ),
            391 => 
            array (
                'id' => 501,
                'name' => 'App\\Http\\Controllers\\Api\\User\\WishlistController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\WishlistController',
                'controller_name' => 'WishlistController',
                'method_name' => 'index',
            ),
            392 => 
            array (
                'id' => 502,
                'name' => 'App\\Http\\Controllers\\Api\\User\\WishlistController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\WishlistController',
                'controller_name' => 'WishlistController',
                'method_name' => 'destroy',
            ),
            393 => 
            array (
                'id' => 503,
                'name' => 'App\\Http\\Controllers\\Api\\User\\ReviewController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'index',
            ),
            394 => 
            array (
                'id' => 504,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@sendResetLinkEmail',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'sendResetLinkEmail',
            ),
            395 => 
            array (
                'id' => 505,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@setPassword',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'setPassword',
            ),
            396 => 
            array (
                'id' => 508,
                'name' => 'App\\Http\\Controllers\\Api\\User\\AddressController@addresses',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'addresses',
            ),
            397 => 
            array (
                'id' => 509,
                'name' => 'App\\Http\\Controllers\\Api\\User\\AddressController@storeAddress',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'storeAddress',
            ),
            398 => 
            array (
                'id' => 510,
                'name' => 'App\\Http\\Controllers\\Api\\User\\AddressController@updateAddress',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'updateAddress',
            ),
            399 => 
            array (
                'id' => 511,
                'name' => 'App\\Http\\Controllers\\Api\\User\\AddressController@destroyAddress',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'destroyAddress',
            ),
            400 => 
            array (
                'id' => 512,
                'name' => 'App\\Http\\Controllers\\Api\\User\\OrderController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'index',
            ),
            401 => 
            array (
                'id' => 514,
                'name' => 'App\\Http\\Controllers\\Api\\User\\OrderController@details',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'details',
            ),
            402 => 
            array (
                'id' => 515,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@logout',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'logout',
            ),
            403 => 
            array (
                'id' => 516,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'index',
            ),
            404 => 
            array (
                'id' => 517,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'store',
            ),
            405 => 
            array (
                'id' => 518,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'update',
            ),
            406 => 
            array (
                'id' => 519,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@search',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'search',
            ),
            407 => 
            array (
                'id' => 520,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'detail',
            ),
            408 => 
            array (
                'id' => 521,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@getItemOption',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'getItemOption',
            ),
            409 => 
            array (
                'id' => 522,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@updateRealte',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'updateRealte',
            ),
            410 => 
            array (
                'id' => 523,
                'name' => 'App\\Http\\Controllers\\Api\\ItemController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'destroy',
            ),
            411 => 
            array (
                'id' => 524,
                'name' => 'App\\Http\\Controllers\\Api\\CategoryController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'index',
            ),
            412 => 
            array (
                'id' => 525,
                'name' => 'App\\Http\\Controllers\\Api\\CategoryController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'store',
            ),
            413 => 
            array (
                'id' => 526,
                'name' => 'App\\Http\\Controllers\\Api\\CategoryController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'update',
            ),
            414 => 
            array (
                'id' => 527,
                'name' => 'App\\Http\\Controllers\\Api\\CategoryController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'detail',
            ),
            415 => 
            array (
                'id' => 528,
                'name' => 'App\\Http\\Controllers\\Api\\CategoryController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'destroy',
            ),
            416 => 
            array (
                'id' => 529,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CategoryController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'index',
            ),
            417 => 
            array (
                'id' => 530,
                'name' => 'App\\Http\\Controllers\\Api\\User\\ItemController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'index',
            ),
            418 => 
            array (
                'id' => 531,
                'name' => 'App\\Http\\Controllers\\Api\\User\\BrandController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\BrandController',
                'controller_name' => 'BrandController',
                'method_name' => 'index',
            ),
            419 => 
            array (
                'id' => 532,
                'name' => 'App\\Http\\Controllers\\OrderStatusController@index',
                'controller_path' => 'App\\Http\\Controllers\\OrderStatusController',
                'controller_name' => 'OrderStatusController',
                'method_name' => 'index',
            ),
            420 => 
            array (
                'id' => 533,
                'name' => 'App\\Http\\Controllers\\OrderStatusController@store',
                'controller_path' => 'App\\Http\\Controllers\\OrderStatusController',
                'controller_name' => 'OrderStatusController',
                'method_name' => 'store',
            ),
            421 => 
            array (
                'id' => 534,
                'name' => 'App\\Http\\Controllers\\OrderStatusController@edit',
                'controller_path' => 'App\\Http\\Controllers\\OrderStatusController',
                'controller_name' => 'OrderStatusController',
                'method_name' => 'edit',
            ),
            422 => 
            array (
                'id' => 535,
                'name' => 'App\\Http\\Controllers\\OrderStatusController@update',
                'controller_path' => 'App\\Http\\Controllers\\OrderStatusController',
                'controller_name' => 'OrderStatusController',
                'method_name' => 'update',
            ),
            423 => 
            array (
                'id' => 536,
                'name' => 'App\\Http\\Controllers\\OrderStatusController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\OrderStatusController',
                'controller_name' => 'OrderStatusController',
                'method_name' => 'destroy',
            ),
            424 => 
            array (
                'id' => 548,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@index',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'index',
            ),
            425 => 
            array (
                'id' => 549,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@view',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'view',
            ),
            426 => 
            array (
                'id' => 550,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@changeStatus',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'changeStatus',
            ),
            427 => 
            array (
                'id' => 551,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'destroy',
            ),
            428 => 
            array (
                'id' => 552,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'pdf',
            ),
            429 => 
            array (
                'id' => 553,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@csv',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'csv',
            ),
            430 => 
            array (
                'id' => 554,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'index',
            ),
            431 => 
            array (
                'id' => 555,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@view',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'view',
            ),
            432 => 
            array (
                'id' => 556,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@changeStatus',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'changeStatus',
            ),
            433 => 
            array (
                'id' => 557,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'pdf',
            ),
            434 => 
            array (
                'id' => 558,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@csv',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'csv',
            ),
            435 => 
            array (
                'id' => 559,
                'name' => 'App\\Http\\Controllers\\ItemController@import',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'import',
            ),
            436 => 
            array (
                'id' => 560,
                'name' => 'App\\Http\\Controllers\\TaxController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\TaxController',
                'controller_name' => 'TaxController',
                'method_name' => 'destroy',
            ),
            437 => 
            array (
                'id' => 561,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@invoicePrint',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'invoicePrint',
            ),
            438 => 
            array (
                'id' => 562,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController@invoicePrint',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorOrderController',
                'controller_name' => 'VendorOrderController',
                'method_name' => 'invoicePrint',
            ),
            439 => 
            array (
                'id' => 563,
                'name' => 'App\\Http\\Controllers\\Site\\SellerController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SellerController',
                'controller_name' => 'SellerController',
                'method_name' => 'index',
            ),
            440 => 
            array (
                'id' => 564,
                'name' => 'App\\Http\\Controllers\\Site\\SellerController@allItem',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SellerController',
                'controller_name' => 'SellerController',
                'method_name' => 'allItem',
            ),
            441 => 
            array (
                'id' => 565,
                'name' => 'App\\Http\\Controllers\\Site\\DashboardController@removeWelcome',
                'controller_path' => 'App\\Http\\Controllers\\Site\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'removeWelcome',
            ),
            442 => 
            array (
                'id' => 566,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@track',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'track',
            ),
            443 => 
            array (
                'id' => 568,
                'name' => 'App\\Http\\Controllers\\UserController@wallet',
                'controller_path' => 'App\\Http\\Controllers\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'wallet',
            ),
            444 => 
            array (
                'id' => 569,
                'name' => 'Modules\\Commission\\Http\\Controllers\\CommissionController@index',
                'controller_path' => 'Modules\\Commission\\Http\\Controllers\\CommissionController',
                'controller_name' => 'CommissionController',
                'method_name' => 'index',
            ),
            445 => 
            array (
                'id' => 570,
                'name' => 'Modules\\Commission\\Http\\Controllers\\CommissionController@store',
                'controller_path' => 'Modules\\Commission\\Http\\Controllers\\CommissionController',
                'controller_name' => 'CommissionController',
                'method_name' => 'store',
            ),
            446 => 
            array (
                'id' => 571,
                'name' => 'App\\Http\\Controllers\\Site\\SellerController@index',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SellerController',
                'controller_name' => 'SellerController',
                'method_name' => 'index',
            ),
            447 => 
            array (
                'id' => 572,
                'name' => 'App\\Http\\Controllers\\Site\\SellerController@allItem',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SellerController',
                'controller_name' => 'SellerController',
                'method_name' => 'allItem',
            ),
            448 => 
            array (
                'id' => 573,
                'name' => 'App\\Http\\Controllers\\Site\\DashboardController@removeWelcome',
                'controller_path' => 'App\\Http\\Controllers\\Site\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'removeWelcome',
            ),
            449 => 
            array (
                'id' => 574,
                'name' => 'App\\Http\\Controllers\\AddonsMangerController@index',
                'controller_path' => 'App\\Http\\Controllers\\AddonsMangerController',
                'controller_name' => 'AddonsMangerController',
                'method_name' => 'index',
            ),
            450 => 
            array (
                'id' => 577,
                'name' => 'Modules\\Razorpay\\Http\\Controllers\\RazorpayController@store',
                'controller_path' => 'Modules\\Razorpay\\Http\\Controllers\\RazorpayController',
                'controller_name' => 'RazorpayController',
                'method_name' => 'store',
            ),
            451 => 
            array (
                'id' => 578,
                'name' => 'Modules\\Paystack\\Http\\Controllers\\PaystackController@store',
                'controller_path' => 'Modules\\Paystack\\Http\\Controllers\\PaystackController',
                'controller_name' => 'PaystackController',
                'method_name' => 'store',
            ),
            452 => 
            array (
                'id' => 579,
                'name' => 'Modules\\Paypal\\Http\\Controllers\\PaypalController@store',
                'controller_path' => 'Modules\\Paypal\\Http\\Controllers\\PaypalController',
                'controller_name' => 'PaypalController',
                'method_name' => 'store',
            ),
            453 => 
            array (
                'id' => 580,
                'name' => 'Modules\\Instamojo\\Http\\Controllers\\InstamojoController@store',
                'controller_path' => 'Modules\\Instamojo\\Http\\Controllers\\InstamojoController',
                'controller_name' => 'InstamojoController',
                'method_name' => 'store',
            ),
            454 => 
            array (
                'id' => 582,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@order',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'order',
            ),
            455 => 
            array (
                'id' => 583,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@paymentGateways',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentGateways',
            ),
            456 => 
            array (
                'id' => 584,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@pay',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'pay',
            ),
            457 => 
            array (
                'id' => 585,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@makePayment',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'makePayment',
            ),
            458 => 
            array (
                'id' => 586,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@paymentCallback',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentCallback',
            ),
            459 => 
            array (
                'id' => 587,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@paymentCancelled',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentCancelled',
            ),
            460 => 
            array (
                'id' => 588,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@paymentHook',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentHook',
            ),
            461 => 
            array (
                'id' => 589,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@enableModule',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'enableModule',
            ),
            462 => 
            array (
                'id' => 590,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController@disableModule',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'disableModule',
            ),
            463 => 
            array (
                'id' => 591,
                'name' => 'Modules\\Coinpayment\\Http\\Controllers\\CoinpaymentController@store',
                'controller_path' => 'Modules\\Coinpayment\\Http\\Controllers\\CoinpaymentController',
                'controller_name' => 'CoinpaymentController',
                'method_name' => 'store',
            ),
            464 => 
            array (
                'id' => 592,
                'name' => 'Modules\\Coinbase\\Http\\Controllers\\CoinbaseController@store',
                'controller_path' => 'Modules\\Coinbase\\Http\\Controllers\\CoinbaseController',
                'controller_name' => 'CoinbaseController',
                'method_name' => 'store',
            ),
            465 => 
            array (
                'id' => 593,
                'name' => 'Modules\\CMS\\Http\\Controllers\\ThemeOptionController@list',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\ThemeOptionController',
                'controller_name' => 'ThemeOptionController',
                'method_name' => 'list',
            ),
            466 => 
            array (
                'id' => 594,
                'name' => 'Modules\\CMS\\Http\\Controllers\\ThemeOptionController@store',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\ThemeOptionController',
                'controller_name' => 'ThemeOptionController',
                'method_name' => 'store',
            ),
            467 => 
            array (
                'id' => 595,
                'name' => 'Modules\\Stripe\\Http\\Controllers\\StripeController@store',
                'controller_path' => 'Modules\\Stripe\\Http\\Controllers\\StripeController',
                'controller_name' => 'StripeController',
                'method_name' => 'store',
            ),
            468 => 
            array (
                'id' => 597,
                'name' => 'Modules\\Refund\\Http\\Controllers\\RefundController@index',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'index',
            ),
            469 => 
            array (
                'id' => 598,
                'name' => 'Modules\\Refund\\Http\\Controllers\\RefundController@edit',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'edit',
            ),
            470 => 
            array (
                'id' => 599,
                'name' => 'Modules\\Refund\\Http\\Controllers\\RefundController@update',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'update',
            ),
            471 => 
            array (
                'id' => 600,
                'name' => 'App\\Http\\Controllers\\TransactionController@index',
                'controller_path' => 'App\\Http\\Controllers\\TransactionController',
                'controller_name' => 'TransactionController',
                'method_name' => 'index',
            ),
            472 => 
            array (
                'id' => 601,
                'name' => 'App\\Http\\Controllers\\TransactionController@edit',
                'controller_path' => 'App\\Http\\Controllers\\TransactionController',
                'controller_name' => 'TransactionController',
                'method_name' => 'edit',
            ),
            473 => 
            array (
                'id' => 602,
                'name' => 'App\\Http\\Controllers\\TransactionController@update',
                'controller_path' => 'App\\Http\\Controllers\\TransactionController',
                'controller_name' => 'TransactionController',
                'method_name' => 'update',
            ),
            474 => 
            array (
                'id' => 603,
                'name' => 'App\\Http\\Controllers\\TransactionController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\TransactionController',
                'controller_name' => 'TransactionController',
                'method_name' => 'pdf',
            ),
            475 => 
            array (
                'id' => 604,
                'name' => 'App\\Http\\Controllers\\TransactionController@csv',
                'controller_path' => 'App\\Http\\Controllers\\TransactionController',
                'controller_name' => 'TransactionController',
                'method_name' => 'csv',
            ),
            476 => 
            array (
                'id' => 605,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@index',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'index',
            ),
            477 => 
            array (
                'id' => 606,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@update',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'update',
            ),
            478 => 
            array (
                'id' => 607,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@import',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'import',
            ),
            479 => 
            array (
                'id' => 613,
                'name' => 'Modules\\Refund\\Http\\Controllers\\RefundController@pdf',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'pdf',
            ),
            480 => 
            array (
                'id' => 614,
                'name' => 'Modules\\Refund\\Http\\Controllers\\RefundController@csv',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'csv',
            ),
            481 => 
            array (
                'id' => 620,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@edit',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'edit',
            ),
            482 => 
            array (
                'id' => 621,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'pdf',
            ),
            483 => 
            array (
                'id' => 622,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@csv',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'csv',
            ),
            484 => 
            array (
                'id' => 623,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@setting',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'setting',
            ),
            485 => 
            array (
                'id' => 624,
                'name' => 'App\\Http\\Controllers\\WithdrawalController@updateSetting',
                'controller_path' => 'App\\Http\\Controllers\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'updateSetting',
            ),
            486 => 
            array (
                'id' => 625,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@index',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'index',
            ),
            487 => 
            array (
                'id' => 626,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@create',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'create',
            ),
            488 => 
            array (
                'id' => 627,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@store',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'store',
            ),
            489 => 
            array (
                'id' => 628,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@show',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'show',
            ),
            490 => 
            array (
                'id' => 629,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@edit',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'edit',
            ),
            491 => 
            array (
                'id' => 630,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@update',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'update',
            ),
            492 => 
            array (
                'id' => 631,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@destroy',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'destroy',
            ),
            493 => 
            array (
                'id' => 632,
                'name' => 'App\\Http\\Controllers\\Api\\User\\OrderController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'store',
            ),
            494 => 
            array (
                'id' => 633,
                'name' => 'App\\Http\\Controllers\\Api\\User\\OrderController@checkoutPayment',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'checkoutPayment',
            ),
            495 => 
            array (
                'id' => 634,
                'name' => 'App\\Http\\Controllers\\Api\\User\\OrderController@checkOut',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'checkOut',
            ),
            496 => 
            array (
                'id' => 635,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'index',
            ),
            497 => 
            array (
                'id' => 636,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'store',
            ),
            498 => 
            array (
                'id' => 637,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@reduceQuantity',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'reduceQuantity',
            ),
            499 => 
            array (
                'id' => 638,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroy',
            ),
        ));
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 639,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@destroySelected',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroySelected',
            ),
            1 => 
            array (
                'id' => 640,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@storeSelected',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'storeSelected',
            ),
            2 => 
            array (
                'id' => 641,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@destroyAll',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'destroyAll',
            ),
            3 => 
            array (
                'id' => 642,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@checkCoupon',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'checkCoupon',
            ),
            4 => 
            array (
                'id' => 643,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@orderPaid',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'orderPaid',
            ),
            5 => 
            array (
                'id' => 644,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@brandItems',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'brandItems',
            ),
            6 => 
            array (
                'id' => 645,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@getStock',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'getStock',
            ),
            7 => 
            array (
                'id' => 646,
                'name' => 'Modules\\Coinbase\\Http\\Controllers\\CoinbaseController@edit',
                'controller_path' => 'Modules\\Coinbase\\Http\\Controllers\\CoinbaseController',
                'controller_name' => 'CoinbaseController',
                'method_name' => 'edit',
            ),
            8 => 
            array (
                'id' => 647,
                'name' => 'Modules\\Coinpayment\\Http\\Controllers\\CoinpaymentController@edit',
                'controller_path' => 'Modules\\Coinpayment\\Http\\Controllers\\CoinpaymentController',
                'controller_name' => 'CoinpaymentController',
                'method_name' => 'edit',
            ),
            9 => 
            array (
                'id' => 648,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@order',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'order',
            ),
            10 => 
            array (
                'id' => 649,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@paymentGateways',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentGateways',
            ),
            11 => 
            array (
                'id' => 650,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@pay',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'pay',
            ),
            12 => 
            array (
                'id' => 651,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@makePayment',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'makePayment',
            ),
            13 => 
            array (
                'id' => 652,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@paymentCallback',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentCallback',
            ),
            14 => 
            array (
                'id' => 653,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@paymentCancelled',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentCancelled',
            ),
            15 => 
            array (
                'id' => 654,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@paymentHook',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'paymentHook',
            ),
            16 => 
            array (
                'id' => 655,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@enableModule',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'enableModule',
            ),
            17 => 
            array (
                'id' => 656,
                'name' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController@disableModule',
                'controller_path' => 'Modules\\Gateway\\Http\\Controllers\\Api\\GatewayController',
                'controller_name' => 'GatewayController',
                'method_name' => 'disableModule',
            ),
            18 => 
            array (
                'id' => 657,
                'name' => 'Modules\\Instamojo\\Http\\Controllers\\InstamojoController@edit',
                'controller_path' => 'Modules\\Instamojo\\Http\\Controllers\\InstamojoController',
                'controller_name' => 'InstamojoController',
                'method_name' => 'edit',
            ),
            19 => 
            array (
                'id' => 658,
                'name' => 'Modules\\Paypal\\Http\\Controllers\\PaypalController@edit',
                'controller_path' => 'Modules\\Paypal\\Http\\Controllers\\PaypalController',
                'controller_name' => 'PaypalController',
                'method_name' => 'edit',
            ),
            20 => 
            array (
                'id' => 659,
                'name' => 'Modules\\Paystack\\Http\\Controllers\\PaystackController@edit',
                'controller_path' => 'Modules\\Paystack\\Http\\Controllers\\PaystackController',
                'controller_name' => 'PaystackController',
                'method_name' => 'edit',
            ),
            21 => 
            array (
                'id' => 660,
                'name' => 'Modules\\Razorpay\\Http\\Controllers\\RazorpayController@edit',
                'controller_path' => 'Modules\\Razorpay\\Http\\Controllers\\RazorpayController',
                'controller_name' => 'RazorpayController',
                'method_name' => 'edit',
            ),
            22 => 
            array (
                'id' => 661,
                'name' => 'Modules\\Stripe\\Http\\Controllers\\StripeController@edit',
                'controller_path' => 'Modules\\Stripe\\Http\\Controllers\\StripeController',
                'controller_name' => 'StripeController',
                'method_name' => 'edit',
            ),
            23 => 
            array (
                'id' => 662,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@pdf',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'pdf',
            ),
            24 => 
            array (
                'id' => 663,
                'name' => 'Modules\\Popup\\Http\\Controllers\\PopupController@csv',
                'controller_path' => 'Modules\\Popup\\Http\\Controllers\\PopupController',
                'controller_name' => 'PopupController',
                'method_name' => 'csv',
            ),
            25 => 
            array (
                'id' => 679,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CartController@getStock',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CartController',
                'controller_name' => 'CartController',
                'method_name' => 'getStock',
            ),
            26 => 
            array (
                'id' => 680,
                'name' => 'App\\Http\\Controllers\\PreferenceController@password',
                'controller_path' => 'App\\Http\\Controllers\\PreferenceController',
                'controller_name' => 'PreferenceController',
                'method_name' => 'password',
            ),
            27 => 
            array (
                'id' => 681,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@showResetForm',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'showResetForm',
            ),
            28 => 
            array (
                'id' => 682,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@setPassword',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'setPassword',
            ),
            29 => 
            array (
                'id' => 683,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@sendResetLinkEmail',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'sendResetLinkEmail',
            ),
            30 => 
            array (
                'id' => 684,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@reset',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'reset',
            ),
            31 => 
            array (
                'id' => 685,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@checkDefault',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'checkDefault',
            ),
            32 => 
            array (
                'id' => 686,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@signUp',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'signUp',
            ),
            33 => 
            array (
                'id' => 687,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@quickView',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'quickView',
            ),
            34 => 
            array (
                'id' => 690,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@create',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'create',
            ),
            35 => 
            array (
                'id' => 691,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@store',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'store',
            ),
            36 => 
            array (
                'id' => 692,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@upload',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'upload',
            ),
            37 => 
            array (
                'id' => 693,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@uploadedFiles',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'uploadedFiles',
            ),
            38 => 
            array (
                'id' => 694,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@sortFiles',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'sortFiles',
            ),
            39 => 
            array (
                'id' => 695,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@paginateFiles',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'paginateFiles',
            ),
            40 => 
            array (
                'id' => 696,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@download',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'download',
            ),
            41 => 
            array (
                'id' => 697,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@maxFileId',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'maxFileId',
            ),
            42 => 
            array (
                'id' => 698,
                'name' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController@paginateData',
                'controller_path' => 'Modules\\MediaManager\\Http\\Controllers\\MediaManagerController',
                'controller_name' => 'MediaManagerController',
                'method_name' => 'paginateData',
            ),
            43 => 
            array (
                'id' => 699,
                'name' => 'Modules\\Report\\Http\\Controllers\\ReportController@index',
                'controller_path' => 'Modules\\Report\\Http\\Controllers\\ReportController',
                'controller_name' => 'ReportController',
                'method_name' => 'index',
            ),
            44 => 
            array (
                'id' => 700,
                'name' => 'App\\Http\\Controllers\\Api\\CountryController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\CountryController',
                'controller_name' => 'CountryController',
                'method_name' => 'index',
            ),
            45 => 
            array (
                'id' => 701,
                'name' => 'App\\Http\\Controllers\\ItemController@seoStoreOrUpdate',
                'controller_path' => 'App\\Http\\Controllers\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'seoStoreOrUpdate',
            ),
            46 => 
            array (
                'id' => 703,
                'name' => 'App\\Http\\Controllers\\Site\\AddressController@makeDefault',
                'controller_path' => 'App\\Http\\Controllers\\Site\\AddressController',
                'controller_name' => 'AddressController',
                'method_name' => 'makeDefault',
            ),
            47 => 
            array (
                'id' => 704,
                'name' => 'App\\Http\\Controllers\\Site\\ReviewController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Site\\ReviewController',
                'controller_name' => 'ReviewController',
                'method_name' => 'destroy',
            ),
            48 => 
            array (
                'id' => 741,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@index',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'index',
            ),
            49 => 
            array (
                'id' => 742,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@edit',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'edit',
            ),
            50 => 
            array (
                'id' => 743,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@update',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'update',
            ),
            51 => 
            array (
                'id' => 744,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@destroy',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'destroy',
            ),
            52 => 
            array (
                'id' => 745,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@pdf',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'pdf',
            ),
            53 => 
            array (
                'id' => 746,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@csv',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'csv',
            ),
            54 => 
            array (
                'id' => 747,
                'name' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController@store',
                'controller_path' => 'Modules\\Newsletter\\Http\\Controllers\\SubscriberController',
                'controller_name' => 'SubscriberController',
                'method_name' => 'store',
            ),
            55 => 
            array (
                'id' => 750,
                'name' => 'App\\Http\\Controllers\\DashboardController@getUserData',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'getUserData',
            ),
            56 => 
            array (
                'id' => 751,
                'name' => 'App\\Http\\Controllers\\DashboardController@getItemData',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'getItemData',
            ),
            57 => 
            array (
                'id' => 752,
                'name' => 'App\\Http\\Controllers\\DashboardController@mostSoldProducts',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'mostSoldProducts',
            ),
            58 => 
            array (
                'id' => 753,
                'name' => 'App\\Http\\Controllers\\DashboardController@mostActiveUsers',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'mostActiveUsers',
            ),
            59 => 
            array (
                'id' => 754,
                'name' => 'App\\Http\\Controllers\\DashboardController@vendorStats',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'vendorStats',
            ),
            60 => 
            array (
                'id' => 755,
                'name' => 'App\\Http\\Controllers\\DashboardController@salesOfTheMonth',
                'controller_path' => 'App\\Http\\Controllers\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'salesOfTheMonth',
            ),
            61 => 
            array (
                'id' => 756,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@create',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'create',
            ),
            62 => 
            array (
                'id' => 757,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@store',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'store',
            ),
            63 => 
            array (
                'id' => 758,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@edit',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'edit',
            ),
            64 => 
            array (
                'id' => 759,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@update',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'update',
            ),
            65 => 
            array (
                'id' => 760,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@search',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'search',
            ),
            66 => 
            array (
                'id' => 761,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@updateRelated',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'updateRelated',
            ),
            67 => 
            array (
                'id' => 762,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@view',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'view',
            ),
            68 => 
            array (
                'id' => 763,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@getItemOption',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'getItemOption',
            ),
            69 => 
            array (
                'id' => 764,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@getAttribute',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'getAttribute',
            ),
            70 => 
            array (
                'id' => 765,
                'name' => 'App\\Http\\Controllers\\Vendor\\ItemController@getOption',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'getOption',
            ),
            71 => 
            array (
                'id' => 766,
                'name' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'index',
            ),
            72 => 
            array (
                'id' => 767,
                'name' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController@setting',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'setting',
            ),
            73 => 
            array (
                'id' => 768,
                'name' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController@withdraw',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'withdraw',
            ),
            74 => 
            array (
                'id' => 769,
                'name' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'pdf',
            ),
            75 => 
            array (
                'id' => 770,
                'name' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController@csv',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\WithdrawalController',
                'controller_name' => 'WithdrawalController',
                'method_name' => 'csv',
            ),
            76 => 
            array (
                'id' => 771,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@getUserData',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'getUserData',
            ),
            77 => 
            array (
                'id' => 772,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@getItemData',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'getItemData',
            ),
            78 => 
            array (
                'id' => 773,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@mostSoldProducts',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'mostSoldProducts',
            ),
            79 => 
            array (
                'id' => 774,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@mostActiveUsers',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'mostActiveUsers',
            ),
            80 => 
            array (
                'id' => 775,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@vendorStats',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'vendorStats',
            ),
            81 => 
            array (
                'id' => 776,
                'name' => 'App\\Http\\Controllers\\Vendor\\DashboardController@salesOfTheMonth',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\DashboardController',
                'controller_name' => 'DashboardController',
                'method_name' => 'salesOfTheMonth',
            ),
            82 => 
            array (
                'id' => 777,
                'name' => 'App\\Http\\Controllers\\Site\\SellerController@vendorProfile',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SellerController',
                'controller_name' => 'SellerController',
                'method_name' => 'vendorProfile',
            ),
            83 => 
            array (
                'id' => 778,
                'name' => 'Modules\\Recaptcha\\Http\\Controllers\\RecaptchaController@edit',
                'controller_path' => 'Modules\\Recaptcha\\Http\\Controllers\\RecaptchaController',
                'controller_name' => 'RecaptchaController',
                'method_name' => 'edit',
            ),
            84 => 
            array (
                'id' => 779,
                'name' => 'Modules\\Recaptcha\\Http\\Controllers\\RecaptchaController@store',
                'controller_path' => 'Modules\\Recaptcha\\Http\\Controllers\\RecaptchaController',
                'controller_name' => 'RecaptchaController',
                'method_name' => 'store',
            ),
            85 => 
            array (
                'id' => 780,
                'name' => 'Modules\\CMS\\Http\\Controllers\\BuilderController@edit',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\BuilderController',
                'controller_name' => 'BuilderController',
                'method_name' => 'edit',
            ),
            86 => 
            array (
                'id' => 781,
                'name' => 'Modules\\CMS\\Http\\Controllers\\BuilderController@editElement',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\BuilderController',
                'controller_name' => 'BuilderController',
                'method_name' => 'editElement',
            ),
            87 => 
            array (
                'id' => 782,
                'name' => 'Modules\\CMS\\Http\\Controllers\\BuilderController@updateComponent',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\BuilderController',
                'controller_name' => 'BuilderController',
                'method_name' => 'updateComponent',
            ),
            88 => 
            array (
                'id' => 783,
                'name' => 'Modules\\CMS\\Http\\Controllers\\BuilderController@deleteComponent',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\BuilderController',
                'controller_name' => 'BuilderController',
                'method_name' => 'deleteComponent',
            ),
            89 => 
            array (
                'id' => 784,
                'name' => 'Modules\\CMS\\Http\\Controllers\\BuilderController@orderComponent',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\BuilderController',
                'controller_name' => 'BuilderController',
                'method_name' => 'orderComponent',
            ),
            90 => 
            array (
                'id' => 785,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@downloadPdf',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'downloadPdf',
            ),
            91 => 
            array (
                'id' => 786,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@downloadCsv',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'downloadCsv',
            ),
            92 => 
            array (
                'id' => 787,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@getShopByVendor',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'getShopByVendor',
            ),
            93 => 
            array (
                'id' => 788,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\CouponController@getCouponItem',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'getCouponItem',
            ),
            94 => 
            array (
                'id' => 789,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@index',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'index',
            ),
            95 => 
            array (
                'id' => 790,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@create',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'create',
            ),
            96 => 
            array (
                'id' => 791,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@store',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'store',
            ),
            97 => 
            array (
                'id' => 792,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@edit',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'edit',
            ),
            98 => 
            array (
                'id' => 793,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@update',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'update',
            ),
            99 => 
            array (
                'id' => 794,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@destroy',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'destroy',
            ),
            100 => 
            array (
                'id' => 795,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@pdf',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'pdf',
            ),
            101 => 
            array (
                'id' => 796,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@csv',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'csv',
            ),
            102 => 
            array (
                'id' => 797,
                'name' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController@item',
                'controller_path' => 'Modules\\Coupon\\Http\\Controllers\\Vendor\\CouponController',
                'controller_name' => 'CouponController',
                'method_name' => 'item',
            ),
            103 => 
            array (
                'id' => 798,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Api\\User\\RefundController@index',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Api\\User\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'index',
            ),
            104 => 
            array (
                'id' => 799,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Api\\User\\RefundController@refund',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Api\\User\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'refund',
            ),
            105 => 
            array (
                'id' => 800,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController@index',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'index',
            ),
            106 => 
            array (
                'id' => 801,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController@createRequest',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'createRequest',
            ),
            107 => 
            array (
                'id' => 802,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController@refund',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'refund',
            ),
            108 => 
            array (
                'id' => 803,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController@index',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'index',
            ),
            109 => 
            array (
                'id' => 804,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController@edit',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'edit',
            ),
            110 => 
            array (
                'id' => 805,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController@update',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'update',
            ),
            111 => 
            array (
                'id' => 806,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController@pdf',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'pdf',
            ),
            112 => 
            array (
                'id' => 807,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController@csv',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'csv',
            ),
            113 => 
            array (
                'id' => 808,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController@index',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'index',
            ),
            114 => 
            array (
                'id' => 809,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController@store',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'store',
            ),
            115 => 
            array (
                'id' => 810,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController@update',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'update',
            ),
            116 => 
            array (
                'id' => 811,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController@detail',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'detail',
            ),
            117 => 
            array (
                'id' => 812,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController@destroy',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Api\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'destroy',
            ),
            118 => 
            array (
                'id' => 813,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@index',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'index',
            ),
            119 => 
            array (
                'id' => 814,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@create',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'create',
            ),
            120 => 
            array (
                'id' => 815,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@store',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'store',
            ),
            121 => 
            array (
                'id' => 816,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@edit',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'edit',
            ),
            122 => 
            array (
                'id' => 817,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@update',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'update',
            ),
            123 => 
            array (
                'id' => 818,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@destroy',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'destroy',
            ),
            124 => 
            array (
                'id' => 819,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@pdf',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'pdf',
            ),
            125 => 
            array (
                'id' => 820,
                'name' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController@csv',
                'controller_path' => 'Modules\\Shop\\Http\\Controllers\\Vendor\\ShopController',
                'controller_name' => 'ShopController',
                'method_name' => 'csv',
            ),
            126 => 
            array (
                'id' => 821,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController@index',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController',
                'controller_name' => 'VendorTransactionController',
                'method_name' => 'index',
            ),
            127 => 
            array (
                'id' => 822,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController@pdf',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController',
                'controller_name' => 'VendorTransactionController',
                'method_name' => 'pdf',
            ),
            128 => 
            array (
                'id' => 823,
                'name' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController@csv',
                'controller_path' => 'App\\Http\\Controllers\\Vendor\\VendorTransactionController',
                'controller_name' => 'VendorTransactionController',
                'method_name' => 'csv',
            ),
            129 => 
            array (
                'id' => 824,
                'name' => 'App\\Http\\Controllers\\Api\\AuthController@verifyEmail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'verifyEmail',
            ),
            130 => 
            array (
                'id' => 825,
                'name' => 'App\\Http\\Controllers\\Api\\User\\CategoryController@subCategory',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\CategoryController',
                'controller_name' => 'CategoryController',
                'method_name' => 'subCategory',
            ),
            131 => 
            array (
                'id' => 826,
                'name' => 'App\\Http\\Controllers\\Api\\User\\ItemController@search',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'search',
            ),
            132 => 
            array (
                'id' => 827,
                'name' => 'App\\Http\\Controllers\\Api\\User\\ItemController@recentSearch',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\ItemController',
                'controller_name' => 'ItemController',
                'method_name' => 'recentSearch',
            ),
            133 => 
            array (
                'id' => 828,
                'name' => 'App\\Http\\Controllers\\LoginController@resetOtp',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'resetOtp',
            ),
            134 => 
            array (
                'id' => 829,
                'name' => 'App\\Http\\Controllers\\LoginController@impersonate',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'impersonate',
            ),
            135 => 
            array (
                'id' => 830,
                'name' => 'App\\Http\\Controllers\\LoginController@cancelImpersonate',
                'controller_path' => 'App\\Http\\Controllers\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'cancelImpersonate',
            ),
            136 => 
            array (
                'id' => 831,
                'name' => 'App\\Http\\Controllers\\AdminOrderController@update',
                'controller_path' => 'App\\Http\\Controllers\\AdminOrderController',
                'controller_name' => 'AdminOrderController',
                'method_name' => 'update',
            ),
            137 => 
            array (
                'id' => 832,
                'name' => 'App\\Http\\Controllers\\EmailController@emailVerifySetting',
                'controller_path' => 'App\\Http\\Controllers\\EmailController',
                'controller_name' => 'EmailController',
                'method_name' => 'emailVerifySetting',
            ),
            138 => 
            array (
                'id' => 833,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@checkEmailExistence',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'checkEmailExistence',
            ),
            139 => 
            array (
                'id' => 834,
                'name' => 'App\\Http\\Controllers\\Site\\LoginController@resetOtp',
                'controller_path' => 'App\\Http\\Controllers\\Site\\LoginController',
                'controller_name' => 'LoginController',
                'method_name' => 'resetOtp',
            ),
            140 => 
            array (
                'id' => 835,
                'name' => 'App\\Http\\Controllers\\Site\\UserController@removeImage',
                'controller_path' => 'App\\Http\\Controllers\\Site\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'removeImage',
            ),
            141 => 
            array (
                'id' => 836,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@home',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'home',
            ),
            142 => 
            array (
                'id' => 837,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController@refundDetails',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'refundDetails',
            ),
            143 => 
            array (
                'id' => 838,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'index',
            ),
            144 => 
            array (
                'id' => 839,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController@render',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController',
                'controller_name' => 'RenderFormController',
                'method_name' => 'render',
            ),
            145 => 
            array (
                'id' => 840,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController@submit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController',
                'controller_name' => 'RenderFormController',
                'method_name' => 'submit',
            ),
            146 => 
            array (
                'id' => 841,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController@feedback',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\RenderFormController',
                'controller_name' => 'RenderFormController',
                'method_name' => 'feedback',
            ),
            147 => 
            array (
                'id' => 842,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'index',
            ),
            148 => 
            array (
                'id' => 843,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@create',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'create',
            ),
            149 => 
            array (
                'id' => 844,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@store',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'store',
            ),
            150 => 
            array (
                'id' => 845,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@show',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'show',
            ),
            151 => 
            array (
                'id' => 846,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@edit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'edit',
            ),
            152 => 
            array (
                'id' => 847,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@update',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'update',
            ),
            153 => 
            array (
                'id' => 848,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController@destroy',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\MySubmissionController',
                'controller_name' => 'MySubmissionController',
                'method_name' => 'destroy',
            ),
            154 => 
            array (
                'id' => 849,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'index',
            ),
            155 => 
            array (
                'id' => 850,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'index',
            ),
            156 => 
            array (
                'id' => 851,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@create',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'create',
            ),
            157 => 
            array (
                'id' => 852,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@store',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'store',
            ),
            158 => 
            array (
                'id' => 853,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@show',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'show',
            ),
            159 => 
            array (
                'id' => 854,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@edit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'edit',
            ),
            160 => 
            array (
                'id' => 855,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@update',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'update',
            ),
            161 => 
            array (
                'id' => 856,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController@destroy',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\SubmissionController',
                'controller_name' => 'SubmissionController',
                'method_name' => 'destroy',
            ),
            162 => 
            array (
                'id' => 857,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'index',
            ),
            163 => 
            array (
                'id' => 858,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@create',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'create',
            ),
            164 => 
            array (
                'id' => 859,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@store',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'store',
            ),
            165 => 
            array (
                'id' => 860,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@show',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'show',
            ),
            166 => 
            array (
                'id' => 861,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@edit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'edit',
            ),
            167 => 
            array (
                'id' => 862,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@update',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'update',
            ),
            168 => 
            array (
                'id' => 863,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController@destroy',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\FormController',
                'controller_name' => 'FormController',
                'method_name' => 'destroy',
            ),
            169 => 
            array (
                'id' => 864,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@index',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'index',
            ),
            170 => 
            array (
                'id' => 865,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@edit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'edit',
            ),
            171 => 
            array (
                'id' => 866,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@update',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'update',
            ),
            172 => 
            array (
                'id' => 867,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@editSubmission',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'editSubmission',
            ),
            173 => 
            array (
                'id' => 868,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@editSubmission',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'editSubmission',
            ),
            174 => 
            array (
                'id' => 869,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@viewSubmission',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'viewSubmission',
            ),
            175 => 
            array (
                'id' => 870,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@submissionDelete',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'submissionDelete',
            ),
            176 => 
            array (
                'id' => 871,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@userKycForm',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'userKycForm',
            ),
            177 => 
            array (
                'id' => 872,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@userKycSubmit',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'userKycSubmit',
            ),
            178 => 
            array (
                'id' => 873,
                'name' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController@userKycUpdateSubmission',
                'controller_path' => 'Modules\\FormBuilder\\Http\\Controllers\\KycController',
                'controller_name' => 'KycController',
                'method_name' => 'userKycUpdateSubmission',
            ),
            179 => 
            array (
                'id' => 874,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@topSeller',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'topSeller',
            ),
            180 => 
            array (
                'id' => 875,
                'name' => 'App\\Http\\Controllers\\Api\\User\\UserController@track',
                'controller_path' => 'App\\Http\\Controllers\\Api\\User\\UserController',
                'controller_name' => 'UserController',
                'method_name' => 'track',
            ),
            181 => 
            array (
                'id' => 876,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@registerOrLoginUser',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'registerOrLoginUser',
            ),
            182 => 
            array (
                'id' => 877,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@allBlogs',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'allBlogs',
            ),
            183 => 
            array (
                'id' => 878,
                'name' => 'App\\Http\\Controllers\\Site\\SiteController@blogSearch',
                'controller_path' => 'App\\Http\\Controllers\\Site\\SiteController',
                'controller_name' => 'SiteController',
                'method_name' => 'blogSearch',
            ),
            184 => 
            array (
                'id' => 879,
                'name' => 'App\\Http\\Controllers\\Site\\OrderController@orderManage',
                'controller_path' => 'App\\Http\\Controllers\\Site\\OrderController',
                'controller_name' => 'OrderController',
                'method_name' => 'orderManage',
            ),
            185 => 
            array (
                'id' => 880,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@createHomepage',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'createHomepage',
            ),
            186 => 
            array (
                'id' => 881,
                'name' => 'Modules\\CMS\\Http\\Controllers\\CMSController@editHome',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\CMSController',
                'controller_name' => 'CMSController',
                'method_name' => 'editHome',
            ),
            187 => 
            array (
                'id' => 882,
                'name' => 'Modules\\Refund\\Http\\Controllers\\UserRefundController@refund',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\UserRefundController',
                'controller_name' => 'UserRefundController',
                'method_name' => 'refund',
            ),
            188 => 
            array (
                'id' => 883,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController@getItems',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundController',
                'controller_name' => 'RefundController',
                'method_name' => 'getItems',
            ),
            189 => 
            array (
                'id' => 884,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundProcessController@process',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Site\\RefundProcessController',
                'controller_name' => 'RefundProcessController',
                'method_name' => 'process',
            ),
            190 => 
            array (
                'id' => 885,
                'name' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundProcessController@process',
                'controller_path' => 'Modules\\Refund\\Http\\Controllers\\Vendor\\RefundProcessController',
                'controller_name' => 'RefundProcessController',
                'method_name' => 'process',
            ),
            191 => 
            array (
                'id' => 886,
                'name' => 'App\\Http\\Controllers\\Site\\beASellerController@beSeller',
                'controller_path' => 'App\\Http\\Controllers\\Site\\beASellerController',
                'controller_name' => 'beASellerController',
                'method_name' => 'beSeller',
            ),
            192 => 
            array (
                'id' => 887,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SlideController@create',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SlideController',
                'controller_name' => 'SlideController',
                'method_name' => 'create',
            ),
            193 => 
            array (
                'id' => 888,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SlideController@store',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SlideController',
                'controller_name' => 'SlideController',
                'method_name' => 'store',
            ),
            194 => 
            array (
                'id' => 889,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SlideController@edit',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SlideController',
                'controller_name' => 'SlideController',
                'method_name' => 'edit',
            ),
            195 => 
            array (
                'id' => 890,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SlideController@update',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SlideController',
                'controller_name' => 'SlideController',
                'method_name' => 'update',
            ),
            196 => 
            array (
                'id' => 891,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SlideController@delete',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SlideController',
                'controller_name' => 'SlideController',
                'method_name' => 'delete',
            ),
            197 => 
            array (
                'id' => 892,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SliderController@index',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SliderController',
                'controller_name' => 'SliderController',
                'method_name' => 'index',
            ),
            198 => 
            array (
                'id' => 893,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SliderController@store',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SliderController',
                'controller_name' => 'SliderController',
                'method_name' => 'store',
            ),
            199 => 
            array (
                'id' => 894,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SliderController@update',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SliderController',
                'controller_name' => 'SliderController',
                'method_name' => 'update',
            ),
            200 => 
            array (
                'id' => 895,
                'name' => 'Modules\\CMS\\Http\\Controllers\\SliderController@delete',
                'controller_path' => 'Modules\\CMS\\Http\\Controllers\\SliderController',
                'controller_name' => 'SliderController',
                'method_name' => 'delete',
            ),
            201 => 
            array (
                'id' => 897,
                'name' => '\\App\\Http\\Controllers\\Api\\AuthController@checkOtp',
                'controller_path' => '\\App\\Http\\Controllers\\Api\\AuthController',
                'controller_name' => 'AuthController',
                'method_name' => 'checkOtp',
            ),
            202 => 
            array (
                'id' => 898,
                'name' => 'App\\Http\\Controllers\\ProductSettingController@general',
                'controller_path' => 'App\\Http\\Controllers\\ProductSettingController',
                'controller_name' => 'ProductSettingController',
                'method_name' => 'general',
            ),
            203 => 
            array (
                'id' => 899,
                'name' => 'App\\Http\\Controllers\\ProductSettingController@inventory',
                'controller_path' => 'App\\Http\\Controllers\\ProductSettingController',
                'controller_name' => 'ProductSettingController',
                'method_name' => 'inventory',
            ),
            204 => 
            array (
                'id' => 900,
                'name' => 'App\\Http\\Controllers\\ProductSettingController@vendor',
                'controller_path' => 'App\\Http\\Controllers\\ProductSettingController',
                'controller_name' => 'ProductSettingController',
                'method_name' => 'vendor',
            ),
            205 => 
            array (
                'id' => 901,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@index',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'index',
            ),
            206 => 
            array (
                'id' => 902,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@store',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'store',
            ),
            207 => 
            array (
                'id' => 903,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@update',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'update',
            ),
            208 => 
            array (
                'id' => 904,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@search',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'search',
            ),
            209 => 
            array (
                'id' => 905,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@detail',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'detail',
            ),
            210 => 
            array (
                'id' => 906,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@updateRealte',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'updateRealte',
            ),
            211 => 
            array (
                'id' => 907,
                'name' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController@destroy',
                'controller_path' => 'App\\Http\\Controllers\\Api\\Vendor\\ApiVendorItemController',
                'controller_name' => 'ApiVendorItemController',
                'method_name' => 'destroy',
            ),
        ));
        
        
    }
}