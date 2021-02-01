<?php return [
    'plugin' => [
        'name' => 'Addresses',
        'description' => 'All Romanian addresses',
        'backend-menu' => 'Addresses',
    ],

    'permissions' => 'Addresses access',

    'region' => [
        'form-labels' => [
            'name' => 'Name'
        ],

        'backend-menu' => 'Regions',
    ],

    'county' => [
        'form-labels' => [
            'name' => 'Name',
            'region' => 'Region'
        ],

        'backend-menu' => 'Counties',
    ],

    'cities' => [
        'form-labels' => [
            'name' => 'Name',
            'county' => 'County'
        ],

        'backend-menu' => 'Cities',
    ],

    'components' => [
        'addresses' => [
            'name' => 'Addresses',
            'description' => 'Allows to manipulate addresses'
        ],
    ],
];
