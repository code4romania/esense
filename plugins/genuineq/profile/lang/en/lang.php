<?php return [
    'plugin' => [
        'name' => 'Profile',
        'description' => 'Extends the user plugin and creates profile for it.',
        'backend-menu' => 'Profiles'
    ],

    'school' => [
        'form-labels' => [
            'contact_name' => 'Contact Name',
            'contact_email' => 'Contact Email',
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
                'specialist_archive_successful' => 'Arhivare cu succes',
                'specialist_archive_failed' => 'Arhivarea a esuat',
                'specialist_unzip_successful' => 'Dezarhivare cu succes',
                'specialist_unzip_failed' => 'Dezarhivarea a esuat',
                'specialist_delete_successful' => 'Ștergere cu succes',
                'specialist_delete_failed' => 'Ștergere a esuat',
            ],

            'validation' => [
                'surname_required' => 'Nume este obligatoriu',
                'surname_string' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_string' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'phone.required' => 'Numărul de telefon este obligatoriu',
                'phone.numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'profile_update_successful' => 'Profilul a fost actualizat cu success',
            ],
        ],

        'profile-static-data' => [
            'name' => 'Profile Static Data',
            'description' => 'Allows to extract profile static data',

            'property' => [
                'schools_title' => 'Schools',
                'schools_description' => 'Extract the already registered schools'
            ]
        ],

        'register' => [
            'validation' => [
                'slug_required' => 'Numele școlii este obligatoriu',
                'slug_unique' => 'Aceasta școală este deja înregistrată. Vă rugăm să vă autentificați.'
            ]
        ]
    ],

    'reportwidgets' => [
        'total_specialists' => [
            'label' => 'Total specialists',
            'title' =>  'Total number of specialists',
            'title_default' => 'Total specialists',

            'frontend' => [
                'label_specialists' => 'Total number of specialists'
            ]
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
