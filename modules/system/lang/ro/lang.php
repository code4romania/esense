<?php

return [
    'app' => [
        'name' => 'October CMS',
        'tagline' => 'Intoarcerea la elementele de baza',
    ],
    'directory' => [
        'create_fail' => "Nu se poate crea directorul: :name",
    ],
    'file' => [
        'create_fail' => "Nu se poate crea fisierul: :name",
    ],
    'combiner' => [
        'not_found' => "Fisierul compus ':name' nu a fost gasit.",
    ],
    'system' => [
        'name' => 'Sistem',
        'menu_label' => 'Sistem',
        'categories' => [
            'cms' => 'CMS',
            'misc' => 'Altele',
            'logs' => 'Jurnal',
            'mail' => 'Mail',
            'shop' => 'Magazin',
            'team' => 'Echipa',
            'users' => 'Utilizatori',
            'system' => 'Sistem',
            'social' => 'Social',
            'events' => 'Evenimente',
            'customers' => 'Clienti',
            'my_settings' => 'Setarile mele',
        ],
    ],
    'plugin' => [
        'unnamed' => 'Plugin fara nume',
        'name' => [
            'label' => 'Nume Plugin',
            'help' => 'Denumiti plugin-ul dupa codul sau unic. De exemplu, RainLab.Blog',
        ],
    ],
    'plugins' => [
        'manage' => 'Gestionare plugin-uri',
        'enable_or_disable' => 'Activare sau dezactivare',
        'enable_or_disable_title' => 'Activare sau dezactivare plugin-uri',
        'remove' => 'Inlaturare',
        'refresh' => 'Reimprospatare',
        'disabled_label' => 'Dezactivat',
        'disabled_help' => 'Plugin-urile care sunt dezactivate sunt ignorate de catre aplicatie.',
        'selected_amount' => 'Plugin-uri selectate: :amount',
        'remove_success' => "Plugin-urile respective au fost inlaturate cu succes din sistem.",
        'refresh_success' => "Plugin-urile respective au fost actualizate cu succes.",
        'disable_success' => "Plugin-urile respective au fost dezactivate cu succes.",
        'enable_success' => "Plugin-urile respective au fost activate cu succes.",
        'unknown_plugin' => "Plugin-ul a fost inlaturat din sistemul de fisiere.",
    ],
    'project' => [
        'name' => 'Proiect',
        'owner_label' => 'Proprietar',
        'attach' => 'Atasare Proiect',
        'detach' => 'Detasare Proiect',
        'none' => 'Niciunul',
        'id' => [
            'label' => 'ID Proiect',
            'help' => 'Cum sa gasiti ID-ul Proiectului',
            'missing' => 'Va rugam sa specificati un ID de Proiect.',
        ],
        'detach_confirm' => 'Sunteti sigur(a) ca doriti sa detasati acest proiect?',
        'unbind_success' => 'Proiectul a fost detasat cu succes.',
    ],
    'settings' => [
        'menu_label' => 'Setari',
        'missing_model' => 'Paginii de setari ii lipseste o definitie de Model.',
        'update_success' => 'Setarile pentru :name au fost actualizate cu succes.',
        'return' => 'Intoarcere la setarile sistemului.',
        'search' => 'Cautare'
    ],
    'mail' => [
        'menu_label' => 'Configuratie Email',
        'menu_description' => 'Administrare configuratie email.',
        'general' => 'General',
        'method' => 'Metoda trimitere email',
        'sender_name' => 'Nume expeditor',
        'sender_email' => 'Email expeditor',
        'smtp' => 'SMTP',
        'smtp_address' => 'Adresa SMTP',
        'smtp_authorization' => 'Autorizatie SMTP necesara',
        'smtp_authorization_comment' => 'Utilizati aceasta bifa daca serverul SMTP necesita autorizatie.',
        'smtp_username' => 'Utilizator',
        'smtp_password' => 'Parola',
        'smtp_port' => 'Port SMTP',
        'smtp_ssl' => 'Conexiune SSL necesara',
        'sendmail' => 'Sendmail',
        'sendmail_path' => 'Cale catre Sendmail',
        'sendmail_path_comment' => 'Va rugam sa specificati calea catre programul sendmail.',
    ],
    'mail_templates' => [
        'menu_label' => 'Sabloane email',
        'menu_description' => 'Modificati sabloanele de email care sunt trimise catre utilizatori si administratori, administrati aspectul email-urilor.',
        'new_template' => 'Sablon nou',
        'new_layout' => 'Macheta noua',
        'template' => 'Sablon',
        'templates' => 'Sabloane',
        'menu_layouts_label' => 'Machete email',
        'layout' => 'Macheta',
        'layouts' => 'Machete',
        'name' => 'Nume',
        'name_comment' => 'Nume unic folosit ca referinta la acest sablon',
        'code' => 'Cod',
        'code_comment' => 'Cod unic folosit ca referinta la acest sablon',
        'subject' => 'Subiect',
        'subject_comment' => 'Subiect mesaj Email',
        'description' => 'Descriere',
        'content_html' => 'HTML',
        'content_css' => 'CSS',
        'content_text' => 'Text simplu',
        'test_send' => 'Trimitere mesaj de test',
        'test_success' => 'Mesajul de test a fost trimis cu succes.',
        'return' => 'Intoarcere la lista de sabloane'
    ],

    'mail_brand' => [
        'menu_label' => 'Personalizare e-mail',
        'menu_description' => 'Modificați culorile și aspectul șabloanelor de e-mail.',
        'page_title' => 'Personalizați aspectul e-mailului',
        'sample_template' => [
            'heading' => 'Heading',
            'paragraph' => 'Acesta este un paragraf umplut cu "Lorem Ipsum" și un link. Cumque dicta <a>doloremque eaque</a>, enim error laboriosam pariatur possimus tenetur veritatis voluptas.',
            'table' => [
                'item' => 'Element',
                'description' => 'Descriere',
                'price' => 'Preț',
                'centered' => 'Centrat',
                'right_aligned' => 'Aliniere la dreapta',
            ],
            'butoane' => [
                'primary' => 'Buton principal',
                'positive' => 'Buton pozitiv',
                'negative' => 'Buton negativ',
            ],
            'panel' => 'Cât de plăcut este acest panou?',
            'more' => 'Mai mult text',
            'promotion' => 'Cod cupon: OCTOBER',
            'subcopy' => 'Aceasta este sub-copia e-mailului',
            'thanks' => 'Mulțumesc',
        ],

        'fields' => [
            '_section_background' => 'Fundal',
            'body_bg' => 'Fundal pentru email',
            'content_bg' => 'Fundal pentru conținut',
            'content_inner_bg' => 'Fundal pentru conținutul din interior',
            '_section_buttons' => 'Butoane',
            'button_text_color' => 'Culoarea textului butoanelor',
            'button_primary_bg' => 'Fundal pentru buton primar',
            'button_positive_bg' => 'Fundal pentru buton pozitiv',
            'button_negative_bg' => 'Fundal pentru buton negativ',
            '_section_type' => 'Formatare text',
            'header_color' => 'Culoare antet',
            'heading_color' => 'Culoare subtitluri',
            'text_color' => 'Culoare text',
            'link_color' => 'Culoare legături',
            'footer_color' => 'Culoare subsol',
            '_section_borders' => 'Rame',
            'body_border_color' => 'Culoare ramă email',
            'subcopy_border_color' => 'Culoare ramă pentru sub-copie email',
            'table_border_color' => 'Culoare ramă tabel',
            '_section_components' => 'Componente',
            'panel_bg' => 'Fundal panel',
            'promotion_bg' => 'Fundal promoții',
            'promotion_border_color' => 'Culoare ramă promoții',
        ],
    ],

    'install' => [
        'project_label' => 'Atasare la Proiect',
        'plugin_label' => 'Instalare Plugin',
        'missing_plugin_name' => 'Va rugam sa specificati un nume de Plugin pentru instalare.',
        'install_completing' => 'Se finalizeaza procesul de instalare',
        'install_success' => 'Acest plugin a fost instalat cu succes.',
    ],
    'updates' => [
        'title' => 'Gestioneaza Actualizari',
        'name' => 'Actualizare Software',
        'menu_label' => 'Actualizari',
        'menu_description' => 'Actualizati sistemul, gestionati si instalati plugin-uri si teme.',
        'check_label' => 'Cauta actualizari disponibile',
        'retry_label' => 'Incercati din nou',
        'plugin_name' => 'Nume',
        'plugin_description' => 'Descriere',
        'plugin_version' => 'Versiune',
        'plugin_author' => 'Autor',
        'plugin_not_found' => 'Plugin not found',
        'core_current_build' => 'Versiune curenta',
        'core_build' => 'Versiune :build',
        'core_build_help' => 'Ultima versiune este disponibila.',
        'core_downloading' => 'Se descarca fisierele aplicatiei',
        'core_extracting' => 'Se dezarhiveaza fisierele aplicatiei',
        'plugin_downloading' => 'Se descarca plugin-ul: :name',
        'plugin_extracting' => 'Se dezarhiveaza plugin-ul: :name',
        'plugin_version_none' => 'Plugin nou',
        'theme_new_install' => 'Instalare tema noua.',
        'theme_downloading' => 'Se descarca tema: :name',
        'theme_extracting' => 'Se dezarhiveaza tema: :name',
        'update_label' => 'Actualizare software',
        'update_completing' => 'Se finalizeaza procesul de actualizare',
        'update_loading' => 'Se incarca actualizarile disponibile...',
        'update_success' => 'Procesul de actualizare a fost finalizat cu succes.',
        'update_failed_label' => 'Actualizarea a esuat',
        'force_label' => 'Forteaza actualizarea',
        'found' => [
            'label' => 'Au fost gasite noi actualizari!',
            'help' => 'Apasati pe "Actualizare software" pentru a incepe procesul de actualizare.',
        ],
        'none' => [
            'label' => 'Nu exista actualizari',
            'help' => 'Nu au fost gasite actualizari disponibile.',
        ],
    ],
    'server' => [
        'connect_error' => 'Eroare la conectarea la server.',
        'response_not_found' => 'Serverul de actualizari nu a putut fi contactat.',
        'response_invalid' => 'Raspuns invalid de la server.',
        'response_empty' => 'Raspuns gol de la server.',
        'file_error' => 'Serverul a esuat sa livreze pachetul software.',
        'file_corrupt' => 'Fisierul de pe server este corupt.',
    ],
    'behavior' => [
        'missing_property' => 'Clasa :class trebuie sa defineasca proprietatea $:property folosita pentru caracteristica :behavior.',
    ],
    'config' => [
        'not_found' => 'Nu a fost gasit fisierul de configurare :file definit pentru :location.',
        'required' => "Configuratia folosita in :location trebuie sa furnizeze o valoare ':property'.",
    ],
    'zip' => [
        'extract_failed' => "Nu s-a putut extrage fisierul de baza ':file'.",
    ],
    'event_log' => [
        'hint' => 'Acest jurnal afiseaza o lista de erori potentiale in aplicatie, cum ar fi exceptii sau informatie pentru depanare.',
        'menu_label' => 'Jurnal evenimente',
        'menu_description' => 'Vizualizati mesajele jurnalului de sistem cu inregistrarile de timp si detaliile aferente.',
        'empty_link' => 'Golire jurnal de evenimente',
        'empty_loading' => 'Se goleste jurnalul de evenimente...',
        'empty_success' => 'Jurnalul de evenimente a fost golit cu succes.',
        'return_link' => 'Intoarcere la jurnalul de evenimente',
        'id' => 'ID',
        'id_label' => 'ID eveniment',
        'created_at' => 'Data & Ora',
        'message' => 'Mesaj',
        'level' => 'Nivel',
    ],
    'request_log' => [
        'hint' => 'Acest jurnal afiseaza o lista de cereri efectuate de browser care pot sa necesite atentie. De exemplu, daca un vizitator deschide o pagina in CMS care nu poate fi gasita, o inregistrare va fi creata cu un cod de status 404.',
        'menu_label' => 'Jurnal cereri',
        'menu_description' => 'Vizualizare cereri esuate sau redirectate, precum Pagini care nu au fost gasite (404).',
        'empty_link' => 'Golire jurnal de cereri',
        'empty_loading' => 'Se goleste jurnalul de cereri...',
        'empty_success' => 'Jurnalul cu cereri a fost golit cu succes.',
        'return_link' => 'Intoarcere la jurnal de cereri',
        'id' => 'ID',
        'id_label' => 'ID Jurnal',
        'count' => 'Contor',
        'referer' => 'Refereri',
        'url' => 'URL',
        'status_code' => 'Status',
    ],
    'permissions' => [
        'manage_system_settings' => 'Gestioneaza setarile sistemului',
        'manage_software_updates' => 'Gestioneaza actualizarile software',
        'manage_mail_templates' => 'Gestioneaza sabloanele de email',
        'manage_other_administrators' => 'Gestioneaza alti administratori',
        'view_the_dashboard' => 'Vizualizare panou de control'
    ],

    'log' => [
        'menu_label' => 'Setări jurnal',
        'menu_description' => 'Specificați ce zone ar trebui să creeze jurnale.',
        'default_tab' => 'Jurnal',
        'log_events' => 'Jurnal al evenimentelor sistemului',
        'log_events_comment' => 'Stocați evenimentele de sistem în baza de date pe lângă jurnalul bazat pe fișiere.',
        'log_requests' => 'Jurnal pentru solicitările greșite',
        'log_requests_comment' => 'Solicitări de browser care pot necesita atenție, cum ar fi erori 404.',
        'log_theme' => 'Jurnal pentru modificări de temă',
        'log_theme_comment' => 'Când se face o modificare a temei utilizând back-end-ul.',
    ],

    'media' => [
        'invalid_path' => "Calea ':path'  specificată pentru fișier nu este validă.",
        'folder_size_items' => 'element(e)',
    ],
    'page' => [
        'custom_error' => [
            'label' => 'Eroare de pagină',
            'help' => 'Ne pare rău, dar ceva nu a mers bine și pagina nu poate fi afișată.',
        ],
        'invalid_token' => [
            'label' => 'Simbol de securitate nu este valid',
        ],
        'maintenance' => [
            'label' => "Vom reveni imediat!",
            'help' => "Momentan avem servicii de întreținere, reveniți puțin mai tîrziu!",
            'message' => 'Mesaj:',
            'available_at' => 'Încercați din nou după:',
        ],
    ],
    'pagination' => [
        'previous' => 'Precedent',
        'next' => 'Următor',
    ],


];
