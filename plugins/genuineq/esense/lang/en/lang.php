<?php return [
    'plugin' => [
        'name' => 'ESense',
        'description' => 'Built 100% custom for ESense project, connects all other plugins.'
    ],

    'components' => [
        'studentActions' => [
            'name' => 'Student Access',
            'description' => 'Allows to create, accept and decline student access requests.',

            'message' => [
                'access_request_success_creation' => 'Access request created successfully.',
                'access_request_failed_creation' => 'The access request could not be created.',
                'access_request_success_approval' => 'Access request successfully approved.',
                'access_request_failed_approval' => 'Access request could not be approved.',
                'access_request_success_decline' => 'The access request was successfully rejected.',
                'access_request_failed_decline' => 'Access request could not be denied.',
                'access_to_create_student' => 'You need to have an active teacher.',

                'transfer_request_success_creation' => 'The transfer request was created successfully.',
                'transfer_request_failed_creation' => 'The transfer request could not be created.',
                'transfer_request_success_approval' => 'The transfer request was approved successfully.',
                'transfer_request_failed_approval' => 'The transfer request could not be approved.',
                'transfer_request_success_decline' => 'The transfer request was successfully rejected.',
                'transfer_request_failed_decline' => 'The transfer request could not be denied.',
            ],
        ],

        'lessonsActions' => [
            'name' => 'Lessons Access',
            'description' => 'Allows to extract, edit and view lessons',

            'message' => [
                'no_access' => 'You do not have access to the specified student.',
                'save_successful' => 'The game session was saved successfully.',
                'lesson_updated_successfully' => 'Lesson updated successfully.',
                'invalid_date' => 'The date must be today and in format YYYY-MM-DD.',
                'invalid_hours' => 'The start hour must be smaller than the end hour.',
                'invalid_category' => 'The categoty must be among: ',
            ],

            'validation' => [
                'description_string' => 'The description has to be of type string',
                'feedback_string' => 'The feedback has to be of type string',
            ],
        ],

        'chartsActions' => [
            'name' => 'Charts Actions',
            'description' => 'Allows to extract new data for charts',
        ]
    ],

    'smallrecords_permissions' => [
        'tab' => 'Small Records access',
        'label' => 'Small Records access',
    ],
];
