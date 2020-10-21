<?php return [
    'plugin' => [
        'name' => 'Orar',
        'description' => 'Orar pentru planificarea sesiunilor',
    ],
    'records' => [
        'title' => 'Înregistrări',
        'manage_records' => 'Administrare înregistrări',
        'name' => 'Înregistrări',
    ],
    'record' => [
        'day' => 'Ziua',
        'start_hour' => 'Ora începerii',
        'end_hour' => 'Ora finalizării',
        'title' => 'Titlu',
        'description' => 'Descriere',
        'feedback' => 'Caracterizare',
        'created_at' => 'Creat în',
        'updated_at' => 'Actualizat în',
        'deleted_at' => 'Șters în',
        'create' => 'Adaugă înregistrare',
        'update' => 'Editează înregistrare',
        'delete' => 'Șterge înregistrare',
    ],
    'flash' => [
        'create' => 'Înregistrare creată cu succes.',
        'update' => 'Înregistrare actualizată cu succes.',
        'delete' => 'Înregistrare ștearsă cu succes.',
    ],
    'component' => [
        'timetable' => [
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
                'record_created_successfully' => 'Înregistrarea a fost creată cu succes.',
                'record_updated_successfully' => 'Înregistrarea a fost actualizată cu succes.',
                'record_deleted_successfully' => 'Înregistrarea a fost ștearsă cu succes.',
                'no_records' => 'Nu au fost găsite înregistrări.'
            ],
        ],
    ],
    'backend' => [
        'timetable' => [
            'fields' => [
                'records' => 'Înregistrări',
                'day' => 'Ziua',
                'day_comment' => 'Selectați data.',
                'start_hour' => 'Ora începerii',
                'start_hour_comment' => 'Selectați ora începerii.',
                'end_hour' => 'Ora finalizării',
                'end_hour_comment' => 'Selectați ora finalizării.',
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
                'title' => 'Titlu',
                'description' => 'Descriere',
                'feedback' => 'Caracterizare',
                'created_at' => 'Creat în',
                'updated_at' => 'Actualizat în',
                'deleted_at' => 'Șters în',
            ],
            'form' => [
                'create' => 'Adaugă înregistrare',
                'update' => 'Editează înregistrare',
                'delete' => 'Șterge înregistrare',
            ],
            'list' => [
                'delete_selected_confirm' => 'Sunteți sigur(ă) că doriți să ștergeți înregistrările selectate?'
            ],
        ],
    ],
];
