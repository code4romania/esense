<?php
return [
    'strings' => [
        'plugin_name' => 'Consimțământ Cookie',
        'plugin_desc' => 'Utilizați soluția JavaScript Cookie Consent în platforma OctoberCMS pentru a va adapta pagina web la legile UE privind cookie-urile.',
    ],
    'message' => [
        'title' => 'Mesaj',
        'type' => 'string',
        'default' => 'Acest website folosește cookie-uri pentru a-ți asigura cea mai bună experiență.',
        'placeholder' => 'Acest website folosește cookie-uri pentru a-ți asigura cea mai bună experiență.',
        'validationMessage' => 'Câmpul Mesaj este obligatoriu.'
    ],
    'dismiss' => [
        'title' => 'Button închidere',
        'type' => 'string',
        'default' => 'Am înțeles!',
        'validationMessage' => 'Butonul de închidere este obligatoriu.'
    ],
    'learnMore' => [
        'title' => 'Text pentru linkul Află mai multe',
        'type' => 'string',
        'default' => 'Politică de confidențialitate.',
        'validationMessage' => 'Textul pentru linkul Află mai multe este obligatoriu.'
    ],
    'link' => [
        'title' => 'Link pentru mai multe detalii',
        'type' => 'string',
        'default' => '#',
        'validationMessage' => 'Textul pentru Link detalii este obligatoriu.'
    ],
    'theme' => [
        'title' => 'Theme',
        'type' => 'dropdown',
        'default' => 'light-bottom',
        'placeholder' => 'Select units',
        'options' => [
            'light-bottom' => 'light-bottom',
            'dark-bottom' => 'dark-bottom',
            'light-top' => 'light-top',
            'dark-top' => 'dark-top'
        ],
    ],

];
