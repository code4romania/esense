<?php

return [
    'plugin' => [
        'name' => 'Utilizator',
        'description' => 'Gestionarea front-end a utilizatorilor',
        'tab' => 'Utilizatori',
        'access_users' => 'Gestionați utilizatorii',
        'access_groups' => 'Gestionați grupurile de utilizatori',
        'access_settings' => 'Gestionați setările utilizatorului',
        'impersonate_user' => 'Utilizați identitatea utilizatorilor'
    ],

    'users' => [
        'menu_label' => 'Utilizatori',
        'all_users' => 'Toți utilizatorii',
        'new_user' => 'Utilizator nou',
        'list_title' => 'Gestionați utilizatorii',
        'trashed_hint_title' => 'Utilizatorul și-a dezactivat contul',
        'trashed_hint_desc' => 'Acest utilizator și-a dezactivat contul și nu mai dorește să apară pe site. Își pot restabili contul în orice moment, conectându-se din nou',
        'banned_hint_title' => 'Utilizatorul a fost interzis',
        'banned_hint_desc' => 'Acest utilizator a fost interzis de un administrator și nu va putea să se conecteze',
        'guest_hint_title' => 'Acesta este un utilizator vizitator',
        'guest_hint_desc' => 'Acest utilizator este stocat doar în scopuri de referință și trebuie să se înregistreze înainte de conectare',
        'activate_warning_title' => 'Utilizatorul nu este activat!',
        'activate_warning_desc' => 'Acest utilizator nu a fost activat și este posibil să nu se poată conecta',
        'activate_confirm' => 'Sigur doriți să activați acest utilizator?',
        'activated_success' => 'Utilizatorul a fost activat',
        'activate_manually' => 'Activați manual acest utilizator',
        'convert_guest_confirm' => 'Convertiți acest vizitator într-un utilizator?',
        'convert_guest_manually' => 'Convertiți în utilizator înregistrat',
        'convert_guest_success' => 'Utilizatorul a fost transformat într-un cont înregistrat',
        'impersonate_user' => 'Utilizați identitatea utilizatorului',
        'impersonate_confirm' => 'Imitați acest utilizator? Puteți reveni la starea inițială deconectându-vă',
        'impersonate_success' => 'Acum vă identificați cu acest utilizator',
        'delete_confirm' => 'Doriți cu adevărat să ștergeți acest utilizator?',
        'unban_user' => 'Anulați acest utilizator',
        'unban_confirm' => 'Doriți cu adevărat să anulați acest utilizator?',
        'unbanned_success' => 'Utilizatorul a fost anulat',
        'return_to_list' => 'Reveniți la lista de utilizatori',
        'update_details' => 'Detalii despre actualizare',
        'bulk_actions' => 'Acțiuni în bloc',
        'delete_selected' => 'Ștergeți selecția',
        'delete_selected_confirm' => 'Sigur doriți să ștergeți utilizatorii selectați?',
        'delete_selected_empty' => 'Nu există utilizatori selectați pentru ștergere',
        'delete_selected_success' => 'Utilizatorii selectați au fost șterși cu succes',
        'activate_selected' => 'Activați utilizatorii selectați',
        'activate_selected_confirm' => 'Activați utilizatorii selectați?',
        'activate_selected_empty' => 'Nu există utilizatori selectați de activat',
        'activate_selected_success' => 'Activarea cu succes a utilizatorilor selectați',
        'deactivate_selected' => 'Dezactivați utilizatorii selectați',
        'deactivate_selected_confirm' => 'Sigur doriți să dezactivați utilizatorii selectați?',
        'deactivate_selected_empty' => 'Nu există utilizatori selectați pentru dezactivare',
        'deactivate_selected_success' => 'Utilizatorii selectați au fost dezactivați cu succes',
        'restore_selected' => 'Reabilitați utilizatorii selectați',
        'restore_selected_confirm' => 'Reabilitați utilizatorii selectați?',
        'restore_selected_empty' => 'Nu există utilizatori selectați pentru reabilitare',
        'restore_selected_success' => 'Reabilitare cu succes a utilizatorilor selectați',
        'ban_selected' => 'Interziceți utilizatorii selectați',
        'ban_selected_confirm' => 'Sigur doriți să interziceți utilizatorii selectați?',
        'ban_selected_empty' => 'Nu există utilizatori selectați pentru interzis',
        'ban_selected_success' => 'Utilizatorii selectați au fost interziși',
        'unban_selected' => 'Anulați interdicția pentru utilizatorii selectați',
        'unban_selected_confirm' => 'Sigur anulați interdicția pentru utilizatorii selectați?',
        'unban_selected_empty' => 'Nu există utilizatori selectați pentru a anula interdicția',
        'unban_selected_success' => 'Anularea interdicției s-a efectuat cu succes pentru utilizatorii selectați',
        'unsuspend' => 'Anulați suspendarea',
        'unsuspend_success' => 'Anularea suspendării utilizatorului s-a efectuat cu succes',
        'unsuspend_confirm' => 'Anulați suspendarea acestui utilizator?',
        'created_at' => 'Creat',
        'status_activated' => 'Activat',
        'return_to_users' => 'Înapoi la lista de utilizatori',
    ],

    'settings' => [
        'users' => 'Utilizatori',
        'menu_label' => 'Setări utilizator',
        'menu_description' => 'Gestionați setările legate de utilizator',
        'activation_tab' => 'Activare',
        'signin_tab' => 'Conectați-vă',
        'registration_tab' => 'Înregistrare',
        'profile_tab' => 'Profil',
        'notifications_tab' => 'Notificări',
        'allow_registration' => 'Permite înregistrarea utilizatorului',
        'allow_registration_comment' => 'Dacă aceasta este dezactivată, utilizatorii pot fi creați numai de administratori',
        'activate_mode' => 'Mod de activare',
        'activate_mode_comment' => 'Selectați modul în care trebuie activat un cont de utilizator',
        'activate_mode_auto' => 'Automat',
        'activate_mode_auto_comment' => 'Activat automat la înregistrare',
        'activate_mode_user' => 'Utilizator',
        'activate_mode_user_comment' => 'Utilizatorul își activează propriul cont folosind e-mail',
        'activate_mode_admin' => 'Administrator',
        'activate_mode_admin_comment' => 'Numai un administrator poate activa un utilizator',
        'require_activation' => 'Conectarea necesită activare',
        'require_activation_comment' => 'Utilizatorii trebuie să aibă un cont activat pentru a se conecta',
        'use_throttle' => 'Încercări de conectare',
        'use_throttle_comment' => 'Repetarea încercărilor de conectare nereușite va suspenda temporar utilizatorul',
        'use_register_throttle' => 'Înregistrare încercări de conectare',
        'use_register_throttle_comment' => 'Prevenirea înregistrărilor multiple de la același IP într-o succesiune scurtă',
        'block_persistence' => 'Prevenirea sesiunilor concurente',
        'block_persistence_comment' => 'Când este activat utilizatorii nu se pot conecta la mai multe dispozitive în același timp',
        'remember_login' => 'Rețineți modul de conectare',
        'remember_login_comment' => 'Selectați dacă sesiunea de utilizator ar trebui să fie persistentă',
        'remember_always' => 'Întotdeauna',
        'remember_never' => 'Niciodată',
        'remember_ask' => 'Întrebați utilizatorul la conectare',
    ],

    'group' => [
        'label' => 'Grup',
        'id' => 'ID',
        'name' => 'Nume',
        'description_field' => 'Descriere',
        'code' => 'Cod',
        'code_comment' => 'Introduceți un cod unic utilizat pentru a identifica acest grup',
        'created_at' => 'Creat în',
        'users_count' => 'Utilizatori'
    ],

    'groups' => [
        'menu_label' => 'Grupuri',
        'all_groups' => 'Grupuri de utilizatori',
        'new_group' => 'Grup nou',
        'delete_selected_confirm' => 'Doriți cu adevărat să ștergeți grupurile selectate?',
        'list_title' => 'Gestionați grupurile',
        'delete_confirm' => 'Doriți cu adevărat să ștergeți acest grup?',
        'delete_selected_success' => 'Grupurile selectate au fost șterse cu succes',
        'delete_selected_empty' => 'Nu există grupuri selectate de șters',
        'return_to_list' => 'Înapoi la lista grupurilor',
        'create_title' => 'Creați un grup de utilizatori',
        'update_title' => 'Editați grupul de utilizatori',
        'preview_title' => 'Previzualizați grupul de utilizatori'
    ],

    'helper' => [
        'access_denied' => 'Nu aveți acces la locația respectivă',
        'login_required' => 'Trebuie să fiți autentificat',
    ],

    'backend' => [
        'user' => [
            'label' => 'Utilizator',

            'fields' => [
                'name' => 'Nume',
                'name_comment' => 'Numele complet al utilizatorului',

                'email' => 'Email',
                'email_comment' => 'Adresa de e-mail a utilizatorului',

                'identifier' => 'Identificator',
                'identifier_comment' => 'Identificatorul unic al utilizatorului',

                'type' => 'Tip',
                'type_comment' => 'Tipul utilizatorului',

                'create_password' => 'Creați o parolă',
                'create_password_comment' => 'Introduceți o parolă nouă pentru utilizator',

                'reset_password' => 'Resetați parola',
                'reset_password_comment' => 'Pentru a reseta această parolă de utilizator, introduceți o nouă parolă aici',

                'confirm_password' => 'Confirmare parolă',
                'confirm_password_comment' => 'Introduceți parola din nou pentru a o confirma',

                'send_invite' => 'Trimiteți invitația prin e-mail',
                'send_invite_comment' => 'Trimite un mesaj de bun venit care conține informații de autentificare și parolă',

                'block_mail' => 'Blocați e-mailurile',
                'block_mail_comment' => 'Blocați toate mesajele trimise către acest utilizator',

                'created_ip_address' => 'Adresă IP creare utilizator',
                'created_ip_address_comment' => 'Adresa IP de la care a fost creat utilizatorul',

                'last_ip_address' => 'Ultima adresă IP',
                'last_ip_address_comment' => 'Ultima adresă IP pe care a folosit-o utilizatorul',

                'is_activated' => 'Utilizator activat',
                'is_activated_comment' => 'Este utilizatorul deja activ sau fluxul de activare trebuie executat?',

                'email_notifications' => 'Notificări prin e-mail',
                'email_notifications_comment' => 'Va primi utilizatorul notificări prin e-mail?',

                'groups' => 'Grupuri',
                'groups_comment' => 'Acel grup către care a fost repartizat utilizatorul, selectat în funcție de tipul de utilizator',
                'groups_empty' => 'Nu există grupuri de utilizatori disponibile',

                'avatar' => 'Imagine de profil',
                'avatar_comment' => 'Imaginea de profil a utilizatorului',
            ],

            'columns' => [
                'id' => '#',
                'name' => 'Nume',
                'email' => 'Email',
                'identifier' => 'Identificator',
                'type' => 'Tip',
                'is_activated' => 'Utilizator activat',
                'last_login' => 'Ultima autentificare',
                'last_ip_address' => 'Ultima adresă IP',
            ],

            'scoreboard' => [
                'name' => 'Nume',
                'joined' => 'Afiliat',
                'last_seen' => 'Văzut ultima oară',

                'status_guest' => 'Vizitator',
                'status_activated' => 'Activat',
                'status_registered' => 'Înregistrat',

                'is_guest' => 'Vizitator',
                'is_online' => 'Online acum',
                'is_offline' => 'În prezent offline',
            ],

            'id' => 'ID',
            'username' => 'Nume utilizator',
            'surname' => 'Prenume',
            'created_at' => 'Înregistrat',
            'account' => 'Cont',
        ],
    ],

    'component' => [
        'session' => [
            'name' => 'Sesiune',
            'description' => 'Adaugă sesiunea de utilizator la o pagină și poate restricționa accesul la pagină',
            'backend' => [
                'force_secure' => 'Forțează protocolul securizat',
                'force_secure_desc' => 'Redirecționați întotdeauna adresa URL cu schema HTTPS',
                'code_param' => 'Parametru cod de activare',
                'code_param_desc' => 'Parametrul URL al paginii utilizat pentru codul de activare a înregistrării',
                'security_title' => 'Permite numai',
                'security_desc' => 'Cine are permisiunea de a accesa această pagină',
                'all' => 'Toți',
                'users' => 'Utilizatori',
                'guests' => 'Vizitatori',
                'allowed_groups_title' => 'Permite grupuri',
                'allowed_groups_description' => 'Alegeți grupurile permise sau niciunul pentru a permite toate grupurile',
                'allowed_types_title' => 'Permite tipuri',
                'allowed_types_description' => 'Alegeți tipurile permise sau none pentru a permite toate tipurile',
                'redirect_title' => 'Redirecționare către',
                'redirect_desc' => 'Numele paginii de redirecționare dacă accesul este refuzat',
            ],
            'message' => [
                'access_denied' => 'Nu aveți acces la locația respectivă',
                'logout' => 'Deconectare cu succes',
                'stop_impersonate_success' => 'Sesiunea de utilizare a identității a fost încheiată cu succes',
            ],
        ],

        'login' => [
            'name' => 'Conectare',
            'description' => 'Permite utilizatorilor să se conecteze',
            'backend' => [
                'redirect_to' => 'Redirecționare către',
                'redirect_to_desc' => 'Numele paginii spre care să vă redirecționați după autentificare',
                'force_secure' => 'Forțează protocolul securizat',
                'force_secure_desc' => 'Redirecționați întotdeauna adresa URL cu schema HTTPS',
            ],
            'validation' => [
                'email_required' => 'Adresa de e-mail este obligatorie',
                'email_between' => 'Adresa de e-mail trebuie să fie între 6 și 255 de caractere',
                'email_email' => 'Adresa de e-mail nu este validă',
                'password_required' => 'Parola este obligatorie',
                'password_between_1' => 'Parola trebuie să aibă între ',
                'password_between_2' => ' și ',
                'password_between_3' => ' caractere',
            ],
            'message' => [
                'banned' => 'Ne pare rău, acest utilizator este blocat. Va trebui să ne contactați pentru alte detalii',
                'not_active_email_sent' => 'Nu pare rău, acest utilizator nu este activ. Va trebui să verificăm e-mailul de activare',
                'not_active' => 'Nu pare rău, acest utilizator nu este activ.',
                'wrong_credentials' => 'Datele introduse nu sunt valide',
                'could_not_create_token' => 'Ne pare rău, a apărut o eroare la autentificare. Dacă procesul persistă vă rugăm să ne contactați',
            ],
        ],

        'register' => [
            'name' => 'Înregistrare',
            'description' => 'Permite utilizatorilor să se înregistreze',
            'backend' => [
                'force_secure' => 'Forțează protocolul securizat',
                'force_secure_desc' => 'Redirecționați întotdeauna adresa URL cu schema HTTPS',
                'code_param' => 'Parametru cod de activare',
                'code_param_desc' => 'Parametrul URL al paginii utilizat pentru codul de activare a înregistrării',
            ],
            'validation' => [
                'name_required' => 'Numele este obligatoriu',
                'name_regex' => 'Numele poate conține doar litere, spațiu și caracterul -',
                'email_required' => 'Adresa de email este obligatorie',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'email_unique' => 'Adresa de email este deja folosită.',
                'password_required' => 'Parola este obligatorie',
                'password_between_1' => 'Parola trebuie să aibă între ',
                'password_between_2' => ' și ',
                'password_between_3' => ' caractere',
                'password_confirmed' => 'Parolele nu sunt identice',
                'password_confirmation_required' => 'Confirmarea parolei este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea parolei este obligatorie',
                'consent_required' => 'Acceptarea Termenilor și Condițiilor și a Politicii de Confidențialitate este obligatorie',
                'consent_accepted' => 'Acceptarea Termenilor și Condițiilor și a Politicii de Confidențialitate este obligatorie',
            ],
            'message' => [
                'registration_disabled' => 'Înregistrările sunt momentan dezactivate',
                'registration_throttled' => 'Prea multe încercări de înregistrare nereușite. Va rugăm să încercați mai târziu',
                'activation_email_sent' => 'Un email de activare a fost trimis către adresa de email specificată',
                'registration_successful' => 'Mulțumim pentru înregistrare. Vă rugăm să verificați email-ul. Contul dvs. este în proces de validare',
                'registration_skiped' => 'Școala de care aparțineți este deja înregistrată în platformă și administratorul școlii poate să îți activeze un cont în platformă. Am notificat școala. Între timp poți lua legătura cu școala pentru a-ți activa contul cât mai rapid posibil',
                'invalid_activation_code' => 'Codul de activare furnizat nu este valid',
                'success_activation' => 'Contul a fost activat cu succes',
                'already_activated' => 'Contul este deja activat. Vă rugăm să vă autentificați',
            ],
        ],

        'account' => [
            'name' => 'Cont',
            'description' => 'Permite utilizatorilor să-și gestioneze profilurile',
            'backend' => [
                'force_secure' => 'Forțează protocolul securizat',
                'force_secure_desc' => 'Redirecționați întotdeauna adresa URL cu schema HTTPS',
            ],
            'validation' => [
                'account_mail_required' => 'Adresa de email este obligatorie',
                'account_mail_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'account_mail_email' => 'Adresa de email nu este validă',
                'account_mail_unique' => 'Adresa de email este deja folosită',
                'current_password_required' => 'Parola actuală este obligatorie',
                'current_password_wrong' => 'Parola actuală nu este corectă',
                'password_required' => 'Noua parolă este obligatorie',
                'password_between_1' => 'Noua parolă trebuie să aibă între ',
                'password_between_2' => ' și ',
                'password_between_3' => ' de caractere',
                'password_confirmed' => 'Parolele nu sunt identice',
                'password_confirmation_required' => 'Confirmarea noii parole este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea noii parole este obligatorie',
            ],
            'message' => [
                'avatar_update_successful' => 'Imaginea de profil a fost actualizată cu succes',
                'avatar_update_failed' => 'Actualizarea imaginii de profil a eșuat',
                'email_update_successful' => 'Adresa de email a fost actualizată cu succes',
                'password_update_successful' => 'Parola a fost actualizată cu succes',
                'email_notifications_update_successful' => 'Notificările au fost actualizate cu succes',
                'account_update_successful' => 'Profilul a fost actualizat cu succes',
                'user_invite_successful' => 'Cont creat cu succes',
            ],
        ],

        'password-reset' => [
            'name' => 'Resetare parolă',
            'description' => 'Permite utilizatorilor să-și reseteze parola',
            'backend' => [
                'reset_page' => 'Pagina de resetare a parolei',
                'reset_page_desc' => 'Pagina pentru resetarea parolei'
            ],
            'validation' => [
                'email_required' => 'Adresa de email este obligatorie',
                'email_between' => 'Adresa de email trebuie să aibă între 6 și 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'password_required' => 'Parola este obligatorie',
                'password_between_1' => 'Parola trebuie să aibă între ',
                'password_between_2' => ' și ',
                'password_between_3' => ' de caractere',
                'password_confirmed' => 'Parolele nu sunt identice',
                'password_confirmation_required' => 'Confirmarea parolei este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea parolei este obligatorie',
            ],
            'message' => [
                'restore_successful' => 'Am trimis instrucțiunile pe adresa de email specificată',
                'reset_successful' => 'Parola a fost schimbată cu succes',
                'invalid_reset_code' => 'Codul de resetare a parolei nu este valid',
            ],
        ],

        'notifications' => [
            'name' => 'Notificări',
            'description' => 'Afișează notificările utilizatorilor',
        ],
    ],

    'reportwidgets' => [
        'total_registration_requests' => [
            'label' => 'Total cereri de înregistrare',
            'title' => 'Numărul total de cereri de înregistrare',
            'title_default' => 'Total cereri de înregistrare',
            'title_validation' => '',

            'frontend' => [
                'label_registration_requests' => 'Numărul total de cereri de înregistrare'
            ],
        ],

        'reg_requests_table' => [
            'label' => 'Cereri de înregistrare',
            'title' => 'Cereri de înregistrare',
            'title_default' => 'Tabelul cererilor de înregistrare',
            'title_validation' => '',

            'frontend' => [
                'activate_button' => 'Activați cont(-uri)',
                'label_registration_requests' => 'Tabelul cererilor de înregistrare',
                'preview' => 'Detalii cerere înregistrare',
            ],

            'flash' => [
                'success' => 'Contul a fost activat cu succes',
                'fail' => 'Nu s-a activat contul respectiv',
            ],
        ],
    ],

];
