<?php return [
    'plugin' => [
        'name' => 'Adrese',
        'description' => 'Toate adresele românești',
        'backend-menu' => 'Adrese',
    ],

    'region' => [
        'form-labels' => [
            'name' => 'Nume'
        ],

        'backend-menu' => 'Regiuni',
    ],

    'county' => [
        'form-labels' => [
            'name' => 'Nume',
            'region' => 'Regiune'
        ],

        'backend-menu' => 'Județe',
    ],

    'cities' => [
        'form-labels' => [
            'name' => 'Nume',
            'county' => 'Județ'
        ],

        'backend-menu' => 'Orașe',
    ],

    'components' => [
        'addresses' => [
            'name' => 'Adrese',
            'description' => 'Permite manipularea adreselor'
        ],
    ],
];
