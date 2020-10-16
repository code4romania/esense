<?php return [
    /** The minimum length of characters required for user passwords. */
    'minPasswordLength' => 9,

    /** The maximum length of user passwords. */
    'maxPasswordLength' => 255,

    /** The available user types. */
    'userTypes' => [
        'driver',
        'administrator'
    ],

    /** The available user type options displayed in the admin view. */
    'userTypeOptions' => [
        'driver' => 'Driver',
        'administrator' => 'Administrator'
    ],

    /** Login redirects based on user types. */
    'loginRedirects' => [
        'driver' => '/',
        'administrator' => '/'
    ],

    /** Profile page for each user type. */
    'profilePages' => [
        'driver' => 'profile',
        'administrator' => 'profile',
    ],
];
