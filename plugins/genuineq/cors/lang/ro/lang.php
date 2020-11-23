<?php

return [
    'plugin' => [
        'name' => 'CORS',
        'description' => 'Partajarea resurselor între origini.',
    ],
    'permissions' => [
        'settings' => 'Gestionați CORS',
    ],
    'settings' => [
        'menu_label' => 'CORS',
        'menu_description' => 'Configurare CORS',
        'fields' => [
            'supportsCredentials' => [
                'label' => 'acreditări de asistență',
                'comment' => "Activați-l pentru a accepta acreditări între domenii."
            ],
            'allowedOrigins' => [
                'label' => 'Origini permise',
                'comment' => 'Domeniile care fac cereri către site-ul dvs. (utilizați * pentru toate domeniile).'
            ],
            'allowedHeaders' => [
                'label' => 'Anteturi permise',
                'comment' => 'Anteturile acceptate.'
            ],
            'allowedMethods' => [
                'label' => 'Metode permise',
                'comment' => 'Metodele HTTP care pot fi solicitate (utilizați * pentru toate metodele).'
            ],
            'exposedHeaders' => [
                'label' => 'Anteturi expuse',
                'comment' => 'Anteturile care pot fi expuse.'
            ],
            'maxAge' => [
                'label' => 'Vârstă maximă',
                'comment' => 'Setați Controlul-Accesului-Pe-Baza-Vârstei-Maxime la această valoare.'
            ]
        ]
    ]
];
