<?php
return [
    'strings' => [
        'plugin_name' => 'Cookie Consent',
        'plugin_desc' => 'Use the Cookie Consent JavaScript based solution in your OctoberCMS to adapt your web page with the EU cookie laws.',
    ],
    'message' => [
        'title' => 'Message',
        'type' => 'string',
        'default' => 'This website uses cookies to ensure you get the best experience on our website.',
        'placeholder' => 'This website uses cookies to ensure you get the best experience on our website.',
        'validationMessage' => 'The Message field is required.'
    ],
    'dismiss' => [
        'title' => 'Dismiss button',
        'type' => 'string',
        'default' => 'Got it!',
        'validationMessage' => 'The Dismiss button text is required.'
    ],
    'learnMore' => [
        'title' => 'Learn more text link',
        'type' => 'string',
        'default' => 'More info',
        'validationMessage' => 'The Learn More link text is required.'
    ],
    'link' => [
        'title' => 'Link for more details',
        'type' => 'string',
        'default' => '#',
        'validationMessage' => 'The Learn More link text is required.'
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
