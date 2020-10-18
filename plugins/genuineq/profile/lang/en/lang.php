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
        'profile' => [
            'name' => 'Profile',
            'description' => 'Profile detailes',

            'validation' => [
                /** Required fields. */
                'name_required' => 'Numele companiei este obligatoriu',
                'name_string' => 'Numele companiei trebuie sa fie de tip string',
                'registration_number_required' => 'Numărul de înregistrare al companiei este obligatoriu',
                'registration_number_max' => 'Numărul de înregistrare al companiei trebuie sa aiba maxim 15 caractere',
                'registration_number_unique' => 'Numărul de înregistrare al companiei a mai fost folosit. Va rugam sa va autentificati sau sa luati legatura cu persoaca care a creat contul pentru a va invita',
                /** Optional fields. */
                'description_string' => 'Descrierea companiei trebuie sa fie de tip string',
                'domain_id_integer' => 'Domeniul companiei trebuie sa fie de tip numeric',
                'video_string' => 'URL-ul catre videoclipul de prezentare al companiei trebuie sa fie de tip string',
                'company_size_id_integer' => 'Dimensiunea companiei trebuie sa fie de tip intreg',
                'email_email' => 'Adresa de email a companiei trebuie sa fie valida',
                'website_string' => 'URl-ul catre site-ul de prezentare al companiei trebuie sa fie de tip string',
                /** Candidate validation */
                'domain_1_required' => 'Domeniul 1 este obligatoriu',
                'domain_1_hard_keywords_required' => 'Competentele tehnice pentru domeniul 1 sunt obligatorii',
                'domain_1_soft_keywords_required' => 'Competentele soft pentru domeniul 1 sunt obligatorii',
                'domain_1_experience_required' => 'Experienta pentru domeniul 1 este obligatorie',
                'education_level_required' => 'Nivelul de educatie este obligatoriu',
                'contract_types_required' => 'Tipul contractului este obligatoriu',
            ],

            'message' => [
                'profile_update_successful' => 'Profilul companiei a fost actualizat cu succes',
                'candidate_profile_update'  => 'Profilul a fost actualizat cu succes',
            ]
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
