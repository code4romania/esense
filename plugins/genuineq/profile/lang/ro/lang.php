<?php return [
    'plugin' => [
        'name' => 'Profil',
        'description' => 'Extinde pluginul utilizator și creează profilul pentru acesta.',
        'backend-menu' => 'Profiluri'
    ],

    'school' => [
        'form-labels' => [
            'contact_name' => 'Nume contact',
            'contact_email' => 'E-mail de contact',
            'name' => 'Nume',
            'phone' => 'Telefon',
            'description' => 'Descriere',
            'county' => 'Județ',
            'city' => 'Oraș'
        ],

        'backend-menu' => 'Școli'
    ],

    'specialist' => [
        'form-labels' => [
            'user' => 'Utilizator',
            'name' => 'Nume',
            'email' => 'Email',
            'phone' => 'Telefon',
            'county' => 'Județ',
            'city' => 'Oraș',
            'school' => 'Școală',
            'description' => 'Descriere'
        ],

        'backend-menu' => 'Specialiști'
    ],

    'components' => [
        'specialist' => [
            'name' => 'Specialist',
            'description' => 'Permite actualizarea, ștergerea, arhivarea și dezarhivarea specialiștilor.',

            'message' => [
                'profile_update_successful' => 'Profilul a fost actualizat cu success',
            ],

            'validation' => [
                'surname_required' => 'Numele este obligatoriu',
                'surname_regex' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_regex' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'phone_required' => 'Numărul de telefon este obligatoriu',
                'phone_numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'county_required' => 'Județul este obligatoriu',
                'city_required' => 'Localitatea este obligatorie',
                'description_string' => 'Descrierea trebuie să fie de tip șir de caractere',
            ],
        ],

        'school' => [
            'name' => 'Școală',
            'description' => 'Permite actualizarea școlilor',

            'backend' => [
                'reset_page' => 'Pagina de resetare a parolei',
                'reset_page_desc' => 'Pagina pentru resetarea parolei'
            ],

            'message' => [
                'archive_successful' => 'Arhivare cu succes',
                'archive_failed' => 'Arhivarea a esuat',
                'unzip_successful' => 'Dezarhivare cu succes',
                'unzip_failed' => 'Dezarhivarea a esuat',
                'delete_successful' => 'Ștergere cu succes',
                'delete_failed' => 'Ștergerea a eșuat',
                'update_successful' => 'Specialistul a fost actualizat cu success',
                'profile_update_successful' => 'Profilul a fost actualizat cu success',
                'user_invite_successful' => 'Invitație trimisă cu succes către specialistul ',
                'user_invite_failed' => 'Invitație eșuată pentru specialistul ',
                'user_already_affiliated_1' => 'Specialistul ',
                'user_already_affiliated_2' => ' este deja afiliat',
                'user_is_school_1' => 'Specialistul ',
                'user_is_school_2' => ' este deja înscris ca școală',
                'specialist_create_error' => 'A apărut o problemă. Vă rugăm să încercați din nou'
            ],

            'validation' => [
                'surname_required' => 'Numele este obligatoriu',
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
                'description_string' => 'Descrierea trebuie să fie de tip șir de caractere',
            ],
        ],

        'profile-static-data' => [
            'name' => 'Date statice ale profilului',
            'description' => 'Permite extragerea datelor statice ale profilului',

            'property' => [
                'schools_title' => 'Școli',
                'schools_description' => 'Extrageți școlile deja înregistrate'
            ],
        ],

        'register' => [
            'validation' => [
                'slug_required' => 'Numele școlii este obligatoriu',
                'slug_unique' => 'Aceasta școală este deja înregistrată. Vă rugăm să vă autentificați.'
            ],
        ],

        'login' => [
            'message' => [
                'user_archived' => 'Ne pare rău, utilizatorul este marcat ca arhivat.',
            ],
        ],
    ],

    'reportwidgets' => [
        'total_specialists' => [
            'label' => 'Total specialiști',
            'description' => 'Numărul total de specialiști',
        ],

        'total_schools' => [
            'label' => 'Total școli',
            'description' => 'Numărul total de școli',
        ],
    ],

    'backendForm' => [
        'user' => [
            'profile_type' => [
                'label' => 'Tipul de profil',
                'comment' => 'Afișează tipul de utilizator'
            ],

            'profile_id' => [
                'label' => 'ID profil',
                'comment' => 'Afișează ID-ul utilizatorului'
            ],
        ],
    ],
];
