<?php return [
    'plugin' => [
        'name' => 'Students',
        'description' => 'Contains the structure and login for students and contact persons.',
        'backend-menu' => 'Students'
    ],

    'student' => [
        'form-labels' => [
            'name' => 'Name',
            'surname' => 'Surname',
            'description' => 'Description',
            'hearing_impairment' => 'Hearing impairement',
            'visual_impairment' => 'Visual impairement',
            'birthdate' => 'Birthdata',
            'gender' => 'Gender',
            'contact_person_1' => 'Contact Person 1',
            'contact_person_2' => 'Contact Person 2',
            'contact_person_3' => 'Contact Person 3',
            'contact_person_4' => 'Contact Person 4',
            'contact_person_5' => 'Contact Person 5'
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
            'description' => 'Handels the CRUD operations for students.',

            'message' => [
                'student_archive_successful' => 'Arhivare cu succes',
                'student_archive_failed' => 'Arhivarea a esuat',
                'student_unzip_successful' => 'Dezarhivare cu succes',
                'student_unzip_failed' => 'Dezarhivarea a esuat',
                'student_delete_successful' => 'Ștergere cu succes',
                'student_delete_failed' => 'Ștergerea a esuat',
            ],

            'validation' => [
                'surname_required' => 'Nume este obligatoriu',
                'surname_string' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_string' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'description_required' => 'Descrierea este obligatorie',
                'description_string' => 'Descrierea trebuie să fie de tip string',
                'birthdate_required' => 'Data de naștere este obligatorie',
                'birthdate_date' => 'Data de naștere trebuie să fie validă',
                'birthdate_date_format' => 'Data de naștere trebuie să aibă următorul format: zz/ll/aaaa',
                'hearing_impairment_boolean' => 'Valoarea câmpului de deficiențe auz poate să fie doar "Da" sau "Nu"',
                'visual_impairment_boolean' => 'Valoarea câmpului de deficiențe văz poate să fie doar "Da" sau "Nu"',
                'gender_required' => 'Genul este obligatoriu',
                'gender_in' => 'Genul poate să fie doar "Masculin" sau "Feminin"',
                'phone.required' => 'Numărul de telefon este obligatoriu',
                'phone.numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
            ],

            'message' => [
                'success_creation' => 'Elevul a fost adăugat cu succes',
                'success_update' => 'Elevul a fost actualizat cu succes',
            ],
        ]
    ]
];
