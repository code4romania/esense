<?php

return [
    'plugin' => [
        'name' => 'Utilizare spațiu stocare',
        'description' => 'Gestionează numele și calea către spațiul de stocare',
    ],
    'reportwidgets' => [
        'label' => 'Utilizare spațiu stocare',
        'find_disk_error_1' => 'Imposibil de găsit discul, vă rugăm să <a href="',
        'find_disk_error_2' => '"> <u><strong>adăugați niște discuri</strong></u></a> apoi selectați un disc din opțiunile widgetului',
    ],
    'backend' => [
        'addnew' => 'Adăugați un disc nou',
        'disks' => 'Discuri',
        'form' => [
            'name' => [
                'label' => 'Numele discului',
                'comment' => 'Afișat ca titlu în widget',
            ],
            'path' => [
                'label' => 'Calea discului',
                'comment' => 'Calea completă către discul montat',
            ],
            'description' => [
                'label' => 'Descriere',
                'comment' => 'Pentru ce este folosit acest hard disk?',
            ],
        ],

    ],
];
