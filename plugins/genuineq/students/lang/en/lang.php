<?php return [
    'plugin' => [
        'name' => 'Students',
        'description' => 'Contains the structure and login for students and contact persons.',
        'backend-menu' => 'Students'
    ],

    'permissions' => 'Students access',

    'student' => [
        'form-labels' => [
            'name' => 'Name',
            'surname' => 'Surname',
            'description' => 'Description',
            'hearing_impairment' => 'Hearing impairment',
            'visual_impairment' => 'Visual impairment',
            'birthdate' => 'Birthdate',
            'gender' => 'Gender',
            'contact_persons' => 'Contact persons',
        ],

        'backend-menu' => 'Students'
    ],

    'contact-person' => [
        'form-labels' => [
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            'student' => 'Student'
        ],

        'backend-menu' => 'Contact Persons'
    ],

    'components' => [
        'students' => [
            'name' => 'Students',
            'description' => 'Handles the CRUD operations for students.',

            'validation' => [
                'surname_required' => 'Name required',
                'surname_string' => 'Name can only contain letters, space and character -',
                'name_required' => 'First name required',
                'name_string' => 'First name can only contain letters, space and character -',
                'description_required' => 'Description required',
                'description_string' => 'Description must be string',
                'birthdate_required' => 'Date of birth required',
                'birthdate_date' => 'Date of birth must be valid',
                'birthdate_date_format' => 'Date of birth must be in the following format: dd / mm / yyyy',
                'hearing_impairment_boolean' => 'The value of the hearing impairment field can only be "Yes" or "No"',
                'visual_impairment_boolean' => 'The value of the visual impairment field can only be "Yes" or "No"',
                'gender_required' => 'Gender required',
                'gender_in' => 'Gender can only be "Male" or "Female"',
                'phone_required' => 'Phone number required',
                'phone_numeric' => 'Phone number can only contain digits',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Email address is invalid',
            ],

            'message' => [
                'student_archive_successful' => 'Archiving Successfully',
                'student_unzip_successful' => 'Unzip successfully',
                'student_delete_successful' => 'Delete successfully',
                'success_creation' => 'Student successfully added',
                'success_update' => 'Student successfully updated',
            ],
        ]
    ]
];
