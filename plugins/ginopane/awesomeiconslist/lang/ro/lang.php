<?php

return [
    'plugin' => [
        'name' => 'Lista iconițelor FontAwesome',
        'description' => 'Cea mai recentă listă de iconițe de la Font Awesome ca widget pentru panoul de administrare'
    ],
    'components' => [
        'fontawesomecsslink' => [
            'name' => 'Legătură CSS către Font Awesome',
            'description' => 'Cea mai recentă legătură CSS de la Font Awesome'
        ]
    ],
    'formwidgets' => [
        'awesomeiconslist' => [
            'empty_label' => 'Nimic selectat',
            'empty_option' => 'Selectează iconița...'
        ]
    ],
    'settings' => [
        'name' => 'Legături pentru iconițele FontAwesome',
        'description' => 'Setează informații despre legătura pentru Font Awesome 5',
        'fontawesome_link' => 'Legătură către Font Awesome',
        'fontawesome_link_placeholder' => 'Introdu legătura corespunzătoare pentru Font Awesome',
        'fontawesome_link_attributes' => 'Atributele legăturii',
        'fontawesome_link_attributes_prompt' => 'Adaugă un nou atribut al legăturii',
        'fontawesome_link_attributes_attribute' => 'Atribut',
        'fontawesome_link_attributes_attribute_placeholder' => 'Introdu numele atributului',
        'fontawesome_link_attributes_value' => 'Valoare',
        'fontawesome_link_attributes_value_placeholder' => 'Introdu valoarea atributului',
    ]
];
