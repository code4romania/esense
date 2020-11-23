<?php return [
    'plugin' => [
        'name' => 'Formular de contact',
        'description' => 'Un plugin manager pentru formularul de contact',
    ],
    'message' => [
        'form-labels' => [
            'first_name' => 'Prenume',
            'last_name' => 'Nume',
            'email' => 'Email',
            'message' => 'Mesaj Primit',
            'reply_message' => 'Mesaj de răspuns',
        ],
    ],

    'component' => [
        'contactform' => [
            'name' => 'Formular de contact',
            'description' => 'Controler frontend pentru formularul de contact'
        ],
    ],

    'reportwidgets' => [
        'total_messages' => [
            'label' => 'Total mesaje',
            'title' =>  'Numărul total de mesaje',
        ],
    ],

    'backend' => [
        'name' => 'Mesaje',
        'send_message' => 'Trimite mesaj',
        'create_message' => 'Creează mesaj',
        'preview_message' => 'Previzualizează mesajul',
        'delete_message' => 'Șterge mesaj',
        'reply_to_message' => 'Răspunde la mesaj',
        'reply_to_all_messages' => 'Răspunde la toate mesajele selectate',

        'preview' => [
            'record_not_found' => 'Mesajul nu a fost găsit',
        ],

        'reply' => [
            'reply_button' => 'Răspunde',
            'reply_and_close' => 'Răspunde și închide',
            'exit_reply' => 'Anulează răspunsul',
        ],

        'email' => [
            'subject' => 'Răspuns la mesajul dvs. pentru e-Sense',
        ],

        'flash' => [
            'send_message' => [
                'success' => 'Mesaj trimis cu succes',
                'fail' => 'Mesajul nu a fost trimis',
            ],
            'invalid_email' => 'Adresă de e-mail nevalidă. Vă rugăm să verificați dacă numele domeniului (@ example.com) este corect.'
        ],

        'columns' => [
            'first_name' => 'prenume',
            'last_name' => 'nume',
            'email' => 'e-mail',
            'message' => 'mesaj',
            'replied_at' => 'răspuns la',
            'created_at' => 'creat la',
            'updated_at' => 'actualizat la',
            'deleted_at' => 'șters la',
        ],
    ],
];
