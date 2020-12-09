<?php return [
    'plugin' => [
        'name' => 'Studenți',
        'description' => 'Conține structura și datele de conectare pentru studenți și persoane de contact.',
        'backend-menu' => 'Studenți'
    ],

    'permissions' => 'Acces la studenți',

    'student' => [
        'form-labels' => [
            'name' => 'Name',
            'surname' => 'Prenume',
            'description' => 'Descriere',
            'hearing_impairment' => 'Deficiență auditivă',
            'visual_impairment' => 'Deficiență vizuală',
            'birthdate' => 'Data nașterii',
            'gender' => 'Gen',
            'contact_person_1' => 'Persoana de contact 1',
            'contact_person_2' => 'Persoana de contact 2',
            'contact_person_3' => 'Persoana de contact 3',
            'contact_person_4' => 'Persoana de contact 4',
            'contact_person_5' => 'Persoana de contact 5'
        ],

        'backend-menu' => 'Studenți'
    ],

    'contact-person' => [
        'form-labels' => [
            'name' => 'Name',
            'surname' => 'Prenume',
            'email' => 'Email',
            'phone' => 'Telefon',
            'description' => 'Descriere',
            'student' => 'Student'
        ],

        'backend-menu' => 'Persoane de contact'
    ],

    'components' => [
        'students' => [
            'name' => 'Studenți',
            'description' => 'Tratează operațiunile CRUD pentru studenți.',

            'validation' => [
                'surname_required' => 'Nume este obligatoriu',
                'surname_string' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'name_required' => 'Prenumele este obligatoriu',
                'name_string' => 'Prenumele poate conține doar litere, spațiu și caracterul -',
                'description_required' => 'Descrierea este obligatorie',
                'description_string' => 'Descrierea trebuie să fie de tip șir de caractere',
                'birthdate_required' => 'Data de naștere este obligatorie',
                'birthdate_date' => 'Data de naștere trebuie să fie validă',
                'birthdate_date_format' => 'Data de naștere trebuie să aibă următorul format: zz/ll/aaaa',
                'hearing_impairment_boolean' => 'Valoarea câmpului de deficiență auz poate să fie doar "Da" sau "Nu"',
                'visual_impairment_boolean' => 'Valoarea câmpului de deficiență văz poate să fie doar "Da" sau "Nu"',
                'gender_required' => 'Genul este obligatoriu',
                'gender_in' => 'Genul poate să fie doar "Masculin" sau "Feminin"',
                'phone.required' => 'Numărul de telefon este obligatoriu',
                'phone.numeric' => 'Numărul de telefon poate să conțină doar cifre',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
            ],

            'message' => [
                'student_archive_successful' => 'Arhivare cu succes',
                'student_archive_failed' => 'Arhivarea a eșuat',
                'student_unzip_successful' => 'Dezarhivare cu succes',
                'student_unzip_failed' => 'Dezarhivarea a eșuat',
                'student_delete_successful' => 'Ștergere cu succes',
                'student_delete_failed' => 'Ștergerea a eșuat',
                'success_creation' => 'Elevul a fost adăugat cu succes',
                'success_update' => 'Elevul a fost actualizat cu succes',
            ],
        ]
    ]
];
