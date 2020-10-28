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
                'profile_update_successful' => 'Profilul a fost actualizat cu success',
            ],

            'validation' => [
                'surname_required' => 'Nume este obligatoriu',
                'surname_regex' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_regex' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'phone_required' => 'Numărul de telefon este obligatoriu',
                'phone_numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'county_required' => 'Județul este obligatoriu',
                'city_required' => 'Localitatea este obligatorie',
                'description_string' => 'Descrierea trebuie să fie de tip string',
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
                'profile_update_successful' => 'Profilul a fost actualizat cu success',
                'user_invite_successful' => 'Invitație trimisă cu succes',
            ],

            'validation' => [
                'surname_required' => 'Nume este obligatoriu',
                'surname_regex' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_regex' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'phone_required' => 'Numărul de telefon este obligatoriu',
                'phone_numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'county_required' => 'Județul este obligatoriu',
                'city_required' => 'Localitatea este obligatorie',
                'school_name_required' => 'Numele școlii este obligatoriu',
                'school_name_string' => 'Numele școlii poate conține doar litere, spațiu și caracterul -',
                'description_string' => 'Descrierea trebuie să fie de tip string',
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
            'title_validation' => '',

            'frontend' => [
                'label_specialists' => 'Total number of specialists'
            ]
        ],

        'total_schools' => [
            'label' => 'Total schools',
            'title' =>  'Total number of schools',
            'title_default' => 'Total schools',
            'title_validation' => '',

            'frontend' => [
                'label_schools' => 'Total number of schools'
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
