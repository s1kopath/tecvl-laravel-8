<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('preferences')->delete();
        
        \DB::table('preferences')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category' => 'preference',
                'field' => 'row_per_page',
                'value' => '10',
            ),
            1 => 
            array (
                'id' => 2,
                'category' => 'preference',
                'field' => 'date_format',
                'value' => '1',
            ),
            2 => 
            array (
                'id' => 3,
                'category' => 'preference',
                'field' => 'date_sepa',
                'value' => '-',
            ),
            3 => 
            array (
                'id' => 4,
                'category' => 'preference',
                'field' => 'soft_name',
                'value' => 'goBilling',
            ),
            4 => 
            array (
                'id' => 5,
                'category' => 'company',
                'field' => 'site_short_name',
                'value' => 'ME',
            ),
            5 => 
            array (
                'id' => 6,
                'category' => 'preference',
                'field' => 'percentage',
                'value' => '0',
            ),
            6 => 
            array (
                'id' => 7,
                'category' => 'preference',
                'field' => 'quantity',
                'value' => '0',
            ),
            7 => 
            array (
                'id' => 8,
                'category' => 'preference',
                'field' => 'date_format_type',
                'value' => 'dd-mm-yyyy',
            ),
            8 => 
            array (
                'id' => 9,
                'category' => 'company',
                'field' => 'company_name',
                'value' => 'Multivendor',
            ),
            9 => 
            array (
                'id' => 10,
                'category' => 'company',
                'field' => 'company_email',
                'value' => 'admin@techvill.net',
            ),
            10 => 
            array (
                'id' => 11,
                'category' => 'company',
                'field' => 'company_phone',
                'value' => '+12013828901',
            ),
            11 => 
            array (
                'id' => 12,
                'category' => 'company',
                'field' => 'company_street',
                'value' => 'City Hall Park Path',
            ),
            12 => 
            array (
                'id' => 13,
                'category' => 'company',
                'field' => 'company_city',
                'value' => 'New york',
            ),
            13 => 
            array (
                'id' => 14,
                'category' => 'company',
                'field' => 'company_state',
                'value' => 'New yorktt',
            ),
            14 => 
            array (
                'id' => 15,
                'category' => 'company',
                'field' => 'company_zip_code',
                'value' => '116',
            ),
            15 => 
            array (
                'id' => 17,
                'category' => 'company',
                'field' => 'dflt_lang',
                'value' => 'en',
            ),
            16 => 
            array (
                'id' => 18,
                'category' => 'company',
                'field' => 'dflt_currency_id',
                'value' => '3',
            ),
            17 => 
            array (
                'id' => 19,
                'category' => 'company',
                'field' => 'sates_type_id',
                'value' => '1',
            ),
            18 => 
            array (
                'id' => 21,
                'category' => 'company',
                'field' => 'company_gstin',
                'value' => '11',
            ),
            19 => 
            array (
                'id' => 22,
                'category' => 'gl_account',
                'field' => 'supplier_debit_gl_acc',
                'value' => '4',
            ),
            20 => 
            array (
                'id' => 23,
                'category' => 'gl_account',
                'field' => 'supplier_credit_gl_acc',
                'value' => '4',
            ),
            21 => 
            array (
                'id' => 24,
                'category' => 'gl_account',
                'field' => 'customer_debit_gl_acc',
                'value' => '4',
            ),
            22 => 
            array (
                'id' => 25,
                'category' => 'gl_account',
                'field' => 'customer_credit_gl_acc',
                'value' => '4',
            ),
            23 => 
            array (
                'id' => 26,
                'category' => 'gl_account',
                'field' => 'user_transaction_debit_gl_acc',
                'value' => '4',
            ),
            24 => 
            array (
                'id' => 27,
                'category' => 'gl_account',
                'field' => 'user_transaction_credit_gl_acc',
                'value' => '4',
            ),
            25 => 
            array (
                'id' => 28,
                'category' => 'gl_account',
                'field' => 'bank_charge_gl_acc',
                'value' => '3',
            ),
            26 => 
            array (
                'id' => 29,
                'category' => 'preference',
                'field' => 'default_timezone',
                'value' => 'Asia/Manila',
            ),
            27 => 
            array (
                'id' => 39,
                'category' => 'company',
                'field' => 'company_country',
                'value' => '20',
            ),
            28 => 
            array (
                'id' => 44,
                'category' => 'preference',
                'field' => 'thousand_separator',
                'value' => ',',
            ),
            29 => 
            array (
                'id' => 45,
                'category' => 'preference',
                'field' => 'decimal_digits',
                'value' => '3',
            ),
            30 => 
            array (
                'id' => 46,
                'category' => 'preference',
                'field' => 'symbol_position',
                'value' => 'before',
            ),
            31 => 
            array (
                'id' => 47,
                'category' => 'company',
                'field' => 'company_icon',
                'value' => '4b24511c095a0ce03fdcb53acab1ef2d_25_data_center_icon_191506ico.ico',
            ),
            32 => 
            array (
                'id' => 48,
                'category' => 'company',
                'field' => 'company_logo',
                'value' => 'ce54b25300edb99322ac9987c9c44bae_25_0f5af83d90766696bc8aa3e0af2a233e_1_rover_logo_transparent1pngpng.png',
            ),
            33 => 
            array (
                'id' => 49,
                'category' => 'preference',
                'field' => 'pdf',
                'value' => 'mPdf',
            ),
            35 => 
            array (
                'id' => 51,
                'category' => 'preference',
                'field' => 'file_size',
                'value' => '10',
            ),
            37 => 
            array (
                'id' => 55,
                'category' => 'preference',
                'field' => 'sso_service',
                'value' => '["Facebook","Google"]',
            ),
            38 => 
            array (
                'id' => 56,
                'category' => 'preference',
                'field' => 'invoice_prefix',
                'value' => 'INV-',
            ),
            39 => 
            array (
                'id' => 61,
                'category' => 'verification',
                'field' => 'email',
                'value' => 'both',
            ),
            40 => 
            array (
                'id' => 62,
                'category' => 'product_inventory',
                'field' => 'manage_stock',
                'value' => '1',
            ),
            41 => 
            array (
                'id' => 63,
                'category' => 'product_inventory',
                'field' => 'hold_stock',
                'value' => '20',
            ),
            42 => 
            array (
                'id' => 64,
                'category' => 'product_inventory',
                'field' => 'notification_low_stock',
                'value' => '1',
            ),
            43 => 
            array (
                'id' => 65,
                'category' => 'product_inventory',
                'field' => 'notification_out_of_stock',
                'value' => '1',
            ),
            44 => 
            array (
                'id' => 66,
                'category' => 'product_inventory',
                'field' => 'stock_threshold',
                'value' => '1',
            ),
            45 => 
            array (
                'id' => 67,
                'category' => 'product_inventory',
                'field' => 'out_of_stock_visibility',
                'value' => '1',
            ),
            46 => 
            array (
                'id' => 68,
                'category' => 'product_inventory',
                'field' => 'stock_display_format',
                'value' => 'always_show',
            ),
            47 => 
            array (
                'id' => 69,
                'category' => 'product_general',
                'field' => 'taxes',
                'value' => '1',
            ),
            48 => 
            array (
                'id' => 70,
                'category' => 'product_general',
                'field' => 'coupons',
                'value' => '1',
            ),
            49 => 
            array (
                'id' => 71,
                'category' => 'product_general',
                'field' => 'calculate_coupon',
                'value' => '1',
            ),
            50 => 
            array (
                'id' => 72,
                'category' => 'product_general',
                'field' => 'measurement_weight',
                'value' => 'kg',
            ),
            51 => 
            array (
                'id' => 73,
                'category' => 'product_general',
                'field' => 'measurement_dimension',
                'value' => 'm',
            ),
            52 => 
            array (
                'id' => 74,
                'category' => 'product_general',
                'field' => 'reviews_enable_product_review',
                'value' => '1',
            ),
            53 => 
            array (
                'id' => 75,
                'category' => 'product_general',
                'field' => 'reviews_verified_owner_label',
                'value' => '1',
            ),
            54 => 
            array (
                'id' => 76,
                'category' => 'product_general',
                'field' => 'review_left',
                'value' => '1',
            ),
            55 => 
            array (
                'id' => 77,
                'category' => 'product_general',
                'field' => 'rating_enable',
                'value' => '1',
            ),
            56 => 
            array (
                'id' => 78,
                'category' => 'product_general',
                'field' => 'rating_required',
                'value' => '1',
            ),
            57 => 
            array (
                'id' => 79,
                'category' => 'product_vendor',
                'field' => 'show_sold_by',
                'value' => '1',
            ),
        ));
        
        
    }
}