<?php return [
    /** The minimum length of characters required for user passwords. */
    'minPasswordLength' => 9,

    /** The maximum length of user passwords. */
    'maxPasswordLength' => 255,

    /** The available user types. */
    'userTypes' => [
        'specialist',
        'school'
    ],

    /** The available user type options displayed in the admin view. */
    'userTypeOptions' => [
        'specialist' => 'Specialist',
        'school' => 'School'
    ],

    /** Login redirects based on user types. */
    'loginRedirects' => [
        'specialist' => '/',
        'school' => '/'
    ],

    /** Profile page for each user type. */
    'profilePages' => [
        'specialist' => 'profile',
        'school' => 'profile',
    ],
];
