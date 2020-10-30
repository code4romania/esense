<?php return [
    'plugin' => [
        'name' => 'ESense',
        'description' => 'Built 100% custom for ESense project, connects all other plugins.'
    ],

    'components' => [
        'studentAccess' => [
            'name' => 'Student Access',
            'description' => 'Allows to create, accept and decline student access requests.',

            'message' => [
                'success_creation' => 'Cererea de acces a fost creată cu success.',
                'success_approval' => 'Cererea de acces a fost aprobată cu success.',
                'failed_approval' => 'Cererea de acces nu a putut fi aprobată.',
                'success_decline' => 'Cererea de acces a fost respinsă cu success.',
                'failed_decline' => 'Cererea de acces nu a putut fi refuzată.',
            ],
        ]
    ],
];
