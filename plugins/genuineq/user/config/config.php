<?php return [
    /** The minimum length of characters required for user passwords. */
    'minPasswordLength' => 9,

    /** The maximum length of user passwords. */
    'maxPasswordLength' => 255,

    /** The available user types. */
    'userTypes' => [
        'specialist',
        'school',
        'parent'
    ],

    /** The available user type options displayed in the admin view. */
    'userTypeOptions' => [
        'specialist' => 'Specialist',
        'school' => 'School',
        'parent' => 'Parent',
    ],

    /** Login redirects based on user types. */
    'loginRedirects' => [
        'specialist' => 'specialist/dashboard',
        'school' => 'school/dashboard',
        'parent'=>'specialist/dashboard'
    ],

    /** Profile page for each user type. */
    'profilePages' => [
        'specialist' => 'specialist/profile',
        'school' => 'school/profile',
        'parent' => 'specialist/profile',
    ],
];
