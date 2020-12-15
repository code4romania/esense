<?php return [
    'plugin' => [
        'name' => 'Profile',
        'description' => 'Extends the user plugin and creates profile for it.',
        'backend-menu' => 'Profiles'
    ],

    'school' => [
        'form-labels' => [
            'contact_person' => 'Contact Person',
            'name' => 'Name',
            'phone' => 'Phone',
            'description' => 'Description',
            'county' => 'County',
            'city' => 'City'
        ],

        'backend-menu' => 'Schools'
    ],

    'specialist' => [
        'form-labels' => [
            'user' => 'User',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'county' => 'County',
            'city' => 'City',
            'school' => 'School',
            'description' => 'Description'
        ],

        'backend-menu' => 'Specialists'
    ],

    'components' => [
        'specialist' => [
            'name' => 'Specialist',
            'description' => 'Allows to update, delete, archive and unarchive specialists.',

            'message' => [
                'profile_update_successful' => 'Profile successfully updated',
            ],

            'validation' => [
                'surname_required' => 'Name required',
                'surname_regex' => 'Name can only contain letters, space and character -',
                'name_required' => 'First name required',
                'name_regex' => 'First name can only contain letters, space and character -',
                'phone_required' => 'Phone number required',
                'phone_numeric' => 'Phone number can only contain digits',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Email address is invalid',
                'county_required' => 'County required',
                'city_required' => 'City required',
                'description_string' => 'Description must be string',
            ],
        ],

        'school' => [
            'name' => 'School',
            'description' => 'Allows to update schools',

            'backend' => [
                'reset_page' => 'Password reset page',
                'reset_page_desc' => 'The page for password reset'
            ],

            'message' => [
                'archive_successful' => 'Archive Successfully',
                'archive_failed' => 'Archiving failed',
                'unzip_successful' => 'Unzip successfully',
                'unzip_failed' => 'Unzip failed',
                'delete_successful' => 'Delete successfully',
                'delete_failed' => 'Delete failed',
                'update_successful' => 'The specialist was successfully updated',
                'profile_update_successful' => 'Profile successfully updated',
                'user_invite_successful' => 'Invitation successfully sent to specialist',
                'user_invite_failed' => 'Failed invitation for specialist',
                'user_already_affiliated_1' => 'Specialist',
                'user_already_affiliated_2' => 'is already affiliated',
                'user_is_school_1' => 'Specialist',
                'user_is_school_2' => 'is already registered as a school',
                'specialist_create_error' => "There was a problem. Please try again"
            ],

            'validation' => [
                'surname_required' => 'Name required',
                'surname_regex' => 'Name can only contain letters, space and character -',
                'name_required' => 'First name required',
                'name_regex' => 'First name can only contain letters, space and character -',
                'phone_required' => 'Phone number required',
                'phone_numeric' => 'Phone number can only contain digits',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Email address is invalid',
                'county_required' => 'County required',
                'city_required' => 'City required',
                'school_name_required' => 'School name required',
                'school_name_string' => 'School name can only contain letters, space and character -',
                'description_string' => 'Description must be string',
            ],
        ],

        'profile-static-data' => [
            'name' => 'Profile Static Data',
            'description' => 'Allows to extract profile static data',

            'property' => [
                'schools_title' => 'Schools',
                'schools_description' => 'Extract the already registered schools'
            ],
        ],

        'register' => [
            'validation' => [
                'slug_required' => 'School name required',
                'slug_unique' => 'This school is already registered. Please sign in.'
            ],
        ],

        'login' => [
            'message' => [
                'user_archived' => 'Sorry, the user is marked as archived.',
            ],
        ],
    ],

    'reportwidgets' => [
        'total_specialists' => [
            'label' => 'Total specialists',
            'description' => 'Total number of specialists',
        ],

        'total_schools' => [
            'label' => 'Total schools',
            'description' => 'Total number of schools',
        ],
    ],

    'backendForm' => [
        'user' => [
            'profile_type' => [
                'label' => 'Profile type',
                'comment' => 'Display user type'
            ],

            'profile_id' => [
                'label' => 'Profile id',
                'comment' => 'Display user id'
            ]
        ]
    ]
];
