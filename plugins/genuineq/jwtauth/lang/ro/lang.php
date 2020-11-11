<?php return [
    'plugin' => [
        'name' => 'JWTAuth',
        'description' => 'Simbol de autentificare web JSON.',
    ],
    'permissions' => [
        'settings' => 'Gestionați JWTAuth',
    ],
    'settings' => [
        'menu_label' => 'JWTAuth',
        'menu_description' => 'Configurați JWTAuth',
        'tabs' => [
            'urls' => 'Setări URL',
            'extras' => 'Setări de autorizare'
        ],
        'fields' => [
            'secret' => [
                'label' => 'Secret JWT',
                'comment' => "Este folosit pentru a genera simbolul dvs. Se folosește numai pentru algoritmii HS256, HS384 și HS512."
            ],
            'keys_public' => [
                'label' => 'Cheie publică',
                'comment' => 'O cale sau o resursă către cheia dvs. publică.'
            ],
            'keys_private' => [
                'label' => 'Cheie privată',
                'comment' => 'O cale sau o resursă către cheia dvs. privată.'
            ],
            'keys_passphrase' => [
                'label' => 'Expresie de acces',
                'comment' => 'Expresia de acces pentru cheia dvs. privată.'
            ],
            'ttl' => [
                'label' => 'Durata',
                'comment' => 'Specificați durata (în minute) pentru care va fi valabil simbolul.'
            ],
            'refresh_ttl' => [
                'label' => 'Reînnoiește durata',
                'comment' => 'Specificați durata (în minute) în care simbolul poate fi reînnoit.'
            ],
            'algo' => [
                'label' => 'Algoritm de mixare',
                'comment' => 'Specificați algoritmul de mixare care va fi utilizat pentru semnarea simbolului.'
            ],
            'required_claims' => [
                'label' => 'Revendicări necesare',
                'comment' => 'Specificați revendicările necesare care trebuie să existe în orice simbol.'
            ],
            'persistent_claims' => [
                'label' => 'Revendicări persistente',
                'comment' => 'Specificați cheile de revendicare care vor persista la reînnoirea unui simbol.'
            ],
            'lock_subject' => [
                'label' => 'Blocați subiectul',
                'comment' => 'Aceasta va determina dacă o revendicare `prv` este adăugată automat la simbol.'
            ],
            'leeway' => [
                'label' => 'Libertate de mișcare',
                'comment' => 'Această proprietate oferă amprentei temporale a revendicărilor jwt o anumită "libertate de mișcare".'
            ],
            'blacklist_enabled' => [
                'label' => 'Activați lista neagră',
                'comment' => 'Pentru a invalida simbolurile, trebuie să aveți lista neagră activată.'
            ],
            'blacklist_grace_period' => [
                'label' => 'Perioada de grație a listei negre',
                'comment' => 'Setați perioada de grație (în secunde) pentru a preveni eșecul în cazul unei cereri paralele.'
            ],
            'decrypt_cookies' => [
                'label' => 'Criptați cookie-urile',
                'comment' => 'Opriți-l dacă doriți să decriptați cookie-urile.'
            ],
            'help_urls' => [
                'title' => 'CITEȘTE ÎNTÂI!',
                'content' => "
                    <p> Există două moduri de configurare a acestor adrese URL și va depinde de structura aplicației dvs. </p>

                    <p> <strong> Același domeniu </strong>: În acest caz, trebuie doar să informați URI-ul,
                    iar sistemul va lua în considerare că adresa URL de bază este aceeași cu cea a dvs.
                    Instalare OctoberCMS. <p>

                    <p> <strong> Domeniu extern </strong>: dacă OctoberCMS și aplicația dvs. front-end
                    sunt găzduite în domenii diferite, trebuie să specificați adresa URL completă. </p>

                    <p> De asemenea, este important să rețineți că ambele adrese URL trebuie să aibă parametrul
                    <i> {code} </i> care va fi înlocuit pentru <i> codul de activare </i> sau
                    <i> codul de resetare </i> automat. </p>
                "
            ],
            'activation_url' => [
                'label' => 'Activarea contului',
                'comment' => ''
            ],
            'reset_password_url' => [
                'label' => 'URL de resetare a parolei',
                'comment' => ''
            ],
            'reset_password_page' => [
                'label' => 'Pagina de resetare a parolei',
                'comment' => ''
            ],
        ],
    ],
];
