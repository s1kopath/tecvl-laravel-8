<?php

return [
    'name' => 'CashOnDelivery',
    'alias' => 'cashondelivery',
    'fa_logo' => 'fa fa-money',
    'options' => [
        ['label' => __('Settings'), 'type' => 'modal', 'url' => 'cash.edit'],
    ],

    /**
     * Stripe data validation
     */
    'fields' => [
        'instruction' => [
            'label' => __('Instruction'),
            'type' => 'textarea',
        ],
        'status' => [
            'label' => __('Status'),
            'type' => 'select',
            'required' => true,
            'options' => [
                'Active' => 1,
                'Inactive' =>  0
            ]
        ]
    ],

    'store_route' => 'cash.store',
];
