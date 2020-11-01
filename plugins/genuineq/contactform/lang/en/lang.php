<?php return [
    'plugin' => [
        'name' => 'ContactForm',
        'description' => 'A contact form plugin manager',
    ],
    'message' => [
        'form-labels' => [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'message' => 'Message',
        ],
    ],

    'component' => [
        'contactform' => [
            'name' => 'contactform',
            'description' => 'Contact Form frontend controller'
        ],
    ],

    'backend' => [
        'name' => 'Messages',
        'send_message' => 'Send Message',
        'create_message' => 'Create Message',
        'update_message' => 'Update Message',
        'delete_message' => 'Delete Message',
        'preview_message' => 'Preview Message',

        'flash' => [
            'send_message' => [
                'success' => 'Message sent',
                'fail' => 'Message not sent',
            ],
            'update_message' => [
                'success' => 'Message updated',
                'fail' => 'Message not updated'
            ],
        ],
    ],
];
