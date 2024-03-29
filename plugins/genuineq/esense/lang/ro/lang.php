<?php return [
    'plugin' => [
        'name' => 'ESense',
        'description' => 'Construit 100% personalizat pentru proiectul ESense, conectând toate celelalte pluginuri.'
    ],

    'components' => [
        'studentActions' => [
            'name' => 'Acces student',
            'description' => 'Permite crearea, acceptul și refuzul crererilor de acces al elevilor.',

            'message' => [
                'access_request_success_creation' => 'Cererea de acces a fost creată cu success.',
                'access_request_failed_creation' => 'Cererea de acces nu a putut fi a fost creată.',
                'access_request_success_approval' => 'Cererea de acces a fost aprobată cu success.',
                'access_request_failed_approval' => 'Cererea de acces nu a putut fi aprobată.',
                'access_request_success_decline' => 'Cererea de acces a fost respinsă cu success.',
                'access_request_failed_decline' => 'Cererea de acces nu a putut fi refuzată.',
                'access_to_create_student' => 'Trebuie să ai un profesor activ.',

                'transfer_request_success_creation' => 'Cererea de transfer a fost creată cu success.',
                'transfer_request_failed_creation' => 'Cererea de transfer nu a putut fi a fost creată.',
                'transfer_request_success_approval' => 'Cererea de transfer a fost aprobată cu success.',
                'transfer_request_failed_approval' => 'Cererea de transfer nu a putut fi aprobată.',
                'transfer_request_success_decline' => 'Cererea de transfer a fost respinsă cu success.',
                'transfer_request_failed_decline' => 'Cererea de transfer nu a putut fi refuzată.',
            ],
        ],

        'lessonsActions' => [
            'name' => 'Acces lecții',
            'description' => 'Permite extragerea, editarea și vizualizarea lecțiilor',

            'message' => [
                'no_access' => 'Nu aveți acces la elevul specificat.',
                'save_successful' => 'Sesiunea de joc a fost salvată cu succes.',
                'lesson_updated_successfully' => 'Lecția a fost actualizată cu succes.',
                'invalid_date' => 'Data trebuie să fie astăzi și să aibă formatul YYYY-MM-DD.',
                'invalid_hours' => 'Ora de început trebuie să fie mai mică decât ora de încheiere.',
                'invalid_category' => 'Categoria trebuie să fie printre următoarele: ',
            ],

            'validation' => [
                'description_string' => 'Descrierea trebuie să fie de tip șir de caractere',
                'feedback_string' => 'Feedback-ul trebuie să fie de tip șir de caractere'
            ],
        ],
    ],

    'smallrecords_permissions' => [
        'tab' => 'Acces la Mini Înregistrări',
        'label' => 'Acces la Mini Înregistrări',
    ],
];
