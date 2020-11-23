<?php return [
    'plugin' => [
        'name' => 'Orar',
        'description' => 'Orar pentru planificarea sesiunilor',
    ],

    'lessons' => [
        'title' => 'Lecții',
        'manage_lessons' => 'Administrare lecții',
        'name' => 'Lecții',
    ],

    'lesson' => [
        'day' => 'Ziua',
        'start_hour' => 'Ora începerii',
        'end_hour' => 'Ora finalizării',
        'duration' => 'Durată',
        'title' => 'Titlu',
        'description' => 'Descriere',
        'feedback' => 'Caracterizare',
        'created_at' => 'Creat în',
        'updated_at' => 'Actualizat în',
        'deleted_at' => 'Șters în',
        'create' => 'Adaugă lecție',
        'update' => 'Editează lecție',
        'delete' => 'Șterge lecție',
    ],

    'flash' => [
        'create' => 'Lecție creată cu succes.',
        'update' => 'Lecție actualizată cu succes.',
        'delete' => 'Lecție ștearsă cu succes.',
    ],
    'component' => [
        'timetable' => [
            'name' => 'Orar',
            'description' => 'Un controler simplu pentru afișarea orarului',

            'validation' => [
                'day_required' => 'Data este obligatorie.',
                'day_date' => 'Formatul acestei rubrici trebuie să fie o dată calendaristică.',
                'start_hour_required' => 'Ora de început este obligatorie.',
                'start_hour_time' => 'Ora de început trebuie să aibă un format valid.',
                'end_hour_required' => 'Ora finalizării este obligatorie.',
                'end_hour_time' => 'Ora finalizării trebuie să aibă un format valid.',
                'title_required' => 'Titlul este obligatoriu.',
                'title_string' => 'Titlul trebuie să fie de tip șir de caractere.',
                'description_text' => '',
                'feedback_text' => '',
            ],

            'messages' => [
                'lesson_created_successfully' => 'Lecția a fost creată cu succes.',
                'lesson_updated_successfully' => 'Lecția a fost actualizată cu succes.',
                'lesson_deleted_successfully' => 'Lecția a fost ștearsă cu succes.',
                'no_lessons' => 'Nu au fost găsite lecții.'
            ],
        ],
    ],

    'backend' => [
        'timetable' => [
            'fields' => [
                'lessons' => 'Lecții',
                'day' => 'Ziua',
                'day_comment' => 'Selectați data.',
                'start_hour' => 'Ora începerii',
                'start_hour_comment' => 'Selectați ora începerii.',
                'end_hour' => 'Ora finalizării',
                'end_hour_comment' => 'Selectați ora finalizării.',
                'duration' => 'Durată',
                'duration_comment' => 'Durata totală în secunde',
                'title' => 'Titlu',
                'title_comment' => 'Introduceți un titlu descriptiv.',
                'description' => 'Descriere',
                'description_comment' => 'Adăugați o scurtă descriere.',
                'feedback' => 'Caracterizare',
                'feedback_comment' => 'Adăugați o caracterizare.',
            ],

            'columns' => [
                'id' => 'id',
                'day' => 'Ziua',
                'start_hour' => 'Ora începerii',
                'end_hour' => 'Ora finalizării',
                'duration' => 'Durată',
                'title' => 'Titlu',
                'description' => 'Descriere',
                'feedback' => 'Caracterizare',
                'created_at' => 'Creat în',
                'updated_at' => 'Actualizat în',
                'deleted_at' => 'Șters în',
            ],

            'form' => [
                'create' => 'Adaugă lecție',
                'update' => 'Editează lecție',
                'delete' => 'Șterge lecție',
            ],

            'list' => [
                'delete_selected_confirm' => 'Sunteți sigur(ă) că doriți să ștergeți lecțiile selectate?'
            ],
        ],
    ],
];
