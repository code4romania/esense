<?php

return [
    'plugin' => [
        'name' => 'Legături situri socializare',
        'description' => 'O listă de iconițe ale siturilor de socializare (sau orice alte iconițe de marcă) asociate site-ului dvs. web'
    ],
    'settings' => [
        'name' => 'Legături situri socializare',
        'description' => 'Adaugă, elimină elementul, rearanjează lista de iconițe',

        'list_item' => 'Articol din Listă',
        'list_item_prompt' => 'Adaugă un Articol Nou în Listă ',

        'list_item_icon' => 'Iconiță',
        'list_item_icon_placeholder' => 'Te rugăm să selectezi o iconiță',

        'list_item_name' => 'Nume',
        'list_item_name_placeholder' => 'Numele articolului din listă',

        'list_item_url' => 'Legătură',
        'list_item_url_placeholder' => 'Legătura articolului din listă'
    ],
    'components' => [
        'link_list' => [
            'name' => 'Lista de iconițe',
            'description' => 'Lista de iconițe disponibile',
            'link_settings_group' => 'Setări legătură',
            'link_target_title' => 'Ținta legăturii',
            'link_target_description' => 'Atributul țintă implicit pentru legăturile tale'
        ]
    ],
    'validation' => [
        'name_required' => 'Te rugăm să te asiguri că denumești fiecare articol din listă',
        'url_required' => 'Te rugăm să te asiguri că setezi o adresă URL pentru fiecare articol din listă',
        'url_must_be_valid' => 'Valoarea legăturii trebuie sa fie un URL valid'
    ]
];
