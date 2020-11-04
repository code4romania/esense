<?php return [
    'plugin' => [
        'name' => 'ESense',
        'description' => 'Built 100% custom for ESense project, connects all other plugins.'
    ],

    'components' => [
        'studentActions' => [
            'name' => 'Student Access',
            'description' => 'Allows to create, accept and decline student access requests.',

            'message' => [
                'access_request_success_creation' => 'Cererea de acces a fost creată cu success.',
                // 'access_request_failed_creation' => 'Cererea de acces nu a putut fi a fost creată.',
                'access_request_success_approval' => 'Cererea de acces a fost aprobată cu success.',
                'access_request_failed_approval' => 'Cererea de acces nu a putut fi aprobată.',
                'access_request_success_decline' => 'Cererea de acces a fost respinsă cu success.',
                'access_request_failed_decline' => 'Cererea de acces nu a putut fi refuzată.',

                'transfer_request_success_creation' => 'Cererea de transfer a fost creată cu success.',
                'transfer_request_failed_creation' => 'Cererea de transfer nu a putut fi a fost creată.',
                'transfer_request_success_approval' => 'Cererea de transfer a fost aprobată cu success.',
                'transfer_request_failed_approval' => 'Cererea de transfer nu a putut fi aprobată.',
                'transfer_request_success_decline' => 'Cererea de transfer a fost respinsă cu success.',
                'transfer_request_failed_decline' => 'Cererea de transfer nu a putut fi refuzată.',
            ],
        ],

        'lessonsActions' => [
            'name' => 'Lessons Access',
            'description' => 'Allows to extract, edit and view lessons',

            'message' => [
                'no_access' => 'Nu aveți acces la elevul specificat.',
                'save_successful' => 'Sesiunea de joc a fost salvată cu succes.'
            ]
        ]
    ],
];
