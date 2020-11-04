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

    'reportwidgets' => [
        'total_messages' => [
            'label' => 'Total messages',
            'title' =>  'Total number of messages',
            'title_default' => 'Total messages',
            'title_validation' => '',
        ],
    ],

    'backend' => [
        'name' => 'Messages',
        'send_message' => 'Send Message',
        'create_message' => 'Create Message',
        'preview_message' => 'Preview Message',
        'delete_message' => 'Delete Message',
        'reply_to_message' => 'Reply to message',
        'reply_to_all_messages' => 'Reply to all selected messages',

        'preview' => [
            'record_not_found' => 'Message not found',
        ],

        'reply' => [
            'reply_button' => 'Reply',
            'reply_and_close' => 'Reply and close',
            'exit_reply' => 'Cancel reply',
        ],

        'email' => [
            'subject' => 'Reply to your message',
        ],

        'flash' => [
            'send_message' => [
                'success' => 'Message successfully sent',
                'fail' => 'Message not sent',
            ],
            'invalid_email' => 'Invalid email address. Please check if domain name (@example.com) is correct.'
        ],
    ],
];
