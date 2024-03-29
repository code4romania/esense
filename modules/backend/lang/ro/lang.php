<?php

return [
    'auth' => [
        'title' => 'Zona de administrare',
        'invalid_login' => 'Detaliile pe care le-ați introdus nu se potrivesc cu înregistrările noastre. Vă rugăm să verificați din nou și să încercați din nou. ',
    ],
    'field' => [
        'invalid_type' => 'Tipul campului folosit este invalid - :type.',
        'options_method_invalid_model' => "Atributul ':field' nu este conectat la un model valid. Încercați să specificați metoda opțiunilor pentru clasa modelului :model explicit.",
        'options_method_not_exists' => 'Clasa model :model trebuie sa defineasca o metoda :method() returnand optiuni pentru campul ":field".',
        'colors_method_not_exists' => "Clasa modelului :model trebuie să definească o metodă :method() care returnează codurile HEX color html pentru câmpul formularului ':field'.",
    ],
    'widget' => [
        'not_registered' => "Un nume de clasa de widget ':name' nu a fost inregistrat",
        'not_bound' => "Un widget cu numele de clasa ':name' nu a fost mapat la controller",
    ],
    'page' => [
        'untitled' => "Fara titlu",
        '404' => [
            'label' => 'Pagina nu a fost găsită',
            'help' => "Am căutat mult, dar adresa URL solicitată nu a putut fi găsită. Poate căutați altceva?",
            'back_link' => 'Reveniți la pagina anterioară',
        ],
        'access_denied' => [
            'label' => "Acces restrictionat",
            'help' => "Nu aveti permisiuni pentru a vizualiza aceasta pagina.",
            'cms_link' => "Inapoi in panoul de administrare",
        ],
        'no_database' => [
            'label' => 'Baza de date lipsește',
            'help' => "Este necesară o bază de date pentru a accesa back-end-ul. Verificați baza de date configurată și migrată înainte de a încerca din nou.",
            'cms_link' => 'Reveniți la pagina principală',
        ],
    ],
    'partial' => [
        'not_found_name' => "Partialul ':name' nu a fost gasit.",
        'invalid_name' => 'Nume parțial nevalid: :name.',
    ],
    'ajax_handler' => [
        'invalid_name' => 'Nume handler AJAX invalid: :name.',
        'not_found' => "AJAX handler ':name' nu a fost găsit.",
    ],
    'account' => [
        'impersonate' => 'Utilizați identitatea utilizatorului',
        'impersonate_confirm' => 'Sigur doriți să identificați acest utilizator? Puteți reveni la starea inițială deconectându-vă.',
        'impersonate_success' => 'Acum identificați acest utilizator',
        'impersonate_working' => 'Imitarea ...',
        'impersonating' => 'Imitarea :full_name',
        'stop_impersonating' => 'Opriți imitarea',
        'unsuspend' => 'revocă suspendarea',
        'unsuspend_confirm' => 'Sigur doriți să anulați suspendarea acestui utilizator?',
        'unsuspend_success' => 'Utilizatorul a fost suspendat.',
        'unsuspend_working' => 'Nesuspendat ...',
        'signed_in_as' => 'Conectat ca :full_name',
        'sign_out' => 'Deconectare',
        'login' => 'Autentificare',
        'reset' => 'Resetare',
        'restore' => 'Restaurare',
        'login_placeholder' => 'autentificare',
        'password_placeholder' => 'parolă',
        'remember_me' => 'Rămâneți conectat',
        'forgot_password' => "Ati uitat parola?",
        'enter_email' => "Introduceti email",
        'enter_login' => "Introduceti login",
        'email_placeholder' => "email",
        'enter_new_password' => "Introduceti o noua parola",
        'password_reset' => "Resetare parola",
        'restore_success' => "Un mesaj a fost trimis catre adresa de email cu instructiuni pentru resetarea parolei.",
        'restore_error' => "Utilizatorul ':login' nu a fost gasit in sistem.",
        'reset_success' => "Parola a fost resetata cu succes. Va puteti conecta.",
        'reset_error' => "Date invalide pentru resetarea parolei. Va rugam incercati din nou!",
        'reset_fail' => "Eroare la resetarea parolei!",
        'apply' => 'Aplicare',
        'cancel' => 'Anulare',
        'delete' => 'Stergere',
        'ok' => 'OK',
    ],
    'dashboard' => [
        'menu_label' => 'Dashboard',
        'widget_label' => 'Widget',
        'widget_width' => 'Latime',
        'full_width' => 'Lățime completă',
        'manage_widgets' => 'Gestionați widgeturile',
        'add_widget' => 'Adauga widget',
        'widget_inspector_title' => 'Configurare widget',
        'widget_inspector_description' => 'Configurare raport widget',
        'widget_columns_label' => 'Latime :columns',
        'widget_columns_description' => 'Latime widget, un numar intre 1 si 10.',
        'widget_columns_error' => 'Va rugam sa introduceti latimea widget-ului ca un numar intre 1 si 10.',
        'columns' => '{1} coloana|[2,Inf] coloane',
        'widget_new_row_label' => 'Forteaza rand nou',
        'widget_new_row_description' => 'Amplasare widget pe un rand nou.',
        'widget_title_label' => 'Titlu widget',
        'widget_title_error' => 'Titlul widget-ului este necesar.',
        'reset_layout' => 'Resetați aspectul',
        'reset_layout_confirm' => 'Resetați aspectul înapoi la valorile implicite?',
        'reset_layout_success' => 'Aspectul a fost resetat',
        'make_default' => 'Setați implicit',
        'make_default_confirm' => 'Setați aspectul curent ca implicit?',
        'make_default_success' => 'Aspectul curent este acum implicit',
        'collapse_all' => 'Restrângeți tot',
        'expand_all' => 'Extindeți toate',
        'status' => [
            'widget_title_default' => 'Status sistem',
            'update_available' => '{0} actualizari disponibile!|{1} actualizare disponibila!|[2,Inf] actualizari disponibile!',
            'updates_pending' => 'Actualizări software în așteptare',
            'updates_nil' => 'Software-ul este actualizat',
            'updates_link' => 'Actualizați',
            'warnings_pending' => 'Unele probleme necesită atenție',
            'warnings_nil' => 'Fără avertismente de afișat',
            'warnings_link' => 'Vizualizare',
            'core_build' => 'Construire sistem',
            'event_log' => 'Jurnal de evenimente',
            'request_log' => 'Jurnal de solicitări',
            'app_birthday' => 'Online din',
        ],
        'welcome' => [
            'widget_title_default' => 'Bun venit',
            'welcome_back_name' => 'Bun venit înapoi la :app, :name.',
            'welcome_to_name' => 'Bun venit la :app, :name.',
            'first_sign_in' => 'Aceasta este prima dată când v-ați conectat.',
            'last_sign_in' => 'Ultima dvs. conectare a fost',
            'view_access_logs' => 'Vizualizați jurnalele de acces',
            'nice_message' => 'O zi bună!',
        ],
    ],
    'user' => [
        'name' => 'Administrator',
        'menu_label' => 'Administratori',
        'menu_description' => 'Gestionare administratori, grupuri si permisiuni.',
        'list_title' => 'Gestionare Administratori',
        'new' => 'Administrator nou',
        'login' => "Login",
        'first_name' => "Prenume",
        'last_name' => "Nume",
        'full_name' => "Nume complet",
        'email' => "Email",
        'role_field' => 'Rol',
        'role_comment' => 'Rolurile definesc permisiunile utilizatorilor, care pot fi anulate la nivelul utilizatorului, în fila Permisiuni.',
        'groups' => "Grupuri",
        'groups_comment' => "Specificati grupurile aferente acestei persoane.",
        'avatar' => "Avatar",
        'password' => "Parola",
        'password_confirmation' => "Confirmare Parola",
        'permissions' => 'Permisiuni',
        'account' => 'Cont',
        'superuser' => "Super Utilizator",
        'superuser_comment' => "Bifati aceasta bifa pentru a permite acestei persoane sa aiba acces deplin.",
        'send_invite' => 'Trimitere invitatie prin email',
        'send_invite_comment' => 'Folositi aceasta bifa pentru a trimite o invitatie prin email catre utilizator',
        'delete_confirm' => 'Sunteti sigur(a) ca vreti sa stergeti acest administrator?',
        'return' => 'Intoarcere la lista de administratori',
        'allow' => 'Permite',
        'inherit' => 'Moștenește',
        'deny' => 'Respinge',
        'activated' => 'Activat',
        'last_login' => 'Ultima autentificare',
        'created_at' => 'Creat la',
        'updated_at' => 'Actualizat la',
        'deleted_at' => 'Șters la',
        'show_deleted' => 'Afișare ștearsă',
        'group' => [
            'name' => 'Grup',
            'name_field' => 'Nume',
            'name_comment' => 'Numele este afișat în lista de grupuri din formularul Administrator.',
            'description_field' => 'Descriere',
            'is_new_user_default_field_label' => 'Grup implicit',
            'is_new_user_default_field_comment' => 'Adăugați noi administratori în acest grup în mod implicit',
            'code_field' => 'Cod',
            'code_comment' => 'Introduceți un cod unic dacă doriți să accesați obiectul grup cu API-ul.',
            'menu_label' => 'Gestionare Grupuri',
            'list_title' => 'Gestionare Grupuri',
            'new' => 'Grup Nou de Administratori',
            'delete_confirm' => 'Sunteti sigur(a) ca vreti sa stergeti acest grup de administratori?',
            'return' => 'Intoarcere la lista de grupuri',
            'users_count' => 'Utilizatori',
        ],
        'rol' => [
            'name' => 'Rol',
            'name_field' => 'Nume',
            'name_comment' => 'Numele este afișat în lista de roluri din formularul Administrator.',
            'description_field' => 'Descriere',
            'code_field' => 'Cod',
            'code_comment' => 'Introduceți un cod unic dacă doriți să accesați obiectul rol cu API.',
            'menu_label' => 'Gestionați rolurile',
            'list_title' => 'Gestionați rolurile',
            'new' => 'Rol nou',
            'delete_confirm' => 'Ștergeți acest rol de administrator?',
            'return' => 'Reveniți la lista de roluri',
            'users_count' => 'Utilizatori',
        ],
        'preferences' => [
            'not_authenticated' => 'Nu exista niciun utilizator autentificat pentru care sa se incarce sau salveze preferinte.'
        ],
        'trashed_hint_title' => 'Acest cont a fost șters',
        'trashed_hint_desc' => 'Acest cont a fost șters și nu va putea fi conectat. Pentru a-l restabili, faceți clic pe pictograma de restaurare a utilizatorului din dreapta jos ',
    ],
    'list' => [
        'default_title' => 'Listă',
        'search_prompt' => 'Căutare ...',
        'no_records' => 'Nu există înregistrări în această vizualizare.',
        'missing_model' => 'Lista comportamentului utilizat în ":class" nu are un model definit.',
        'missing_column' => 'Nu există definiții de coloane pentru :columns.',
        'missing_columns' => 'Lista utilizată în :class nu are definite coloane de listă.',
        'missing_definition' => "Comportamentul listei nu conține o coloană pentru ':field'.",
        'missing_parent_definition' => "Comportamentul listei nu conține o definiție pentru ':definition'.",
        'behavior_not_ready' => 'Comportamentul listei nu a fost inițializat, verificați dacă ați apelat makeLists() în controler.',
        'invalid_column_datetime' => "Valoarea coloanei ':column' nu este un obiect DateTime, vă lipsește o referință \$dates în Model?",
        'pagination' => 'Înregistrări afișate: :from-:to din :total',
        'first_page' => 'Prima pagină',
        'last_page' => 'Ultima pagină',
        'prev_page' => 'Pagina anterioară',
        'next_page' => 'Pagina următoare',
        'refresh' => 'Reîmprospătare',
        'updating' => 'Se actualizează ...',
        'loading' => 'Se încarcă ...',
        'setup_title' => 'Configurare listă',
        'setup_help' => 'Utilizați casetele de selectare pentru a selecta coloanele pe care doriți să le vedeți în listă. Puteți schimba poziția coloanelor trăgându-le în sus sau în jos.',
        'records_per_page' => 'Înregistrări pe pagină',
        'records_per_page_help' => 'Selectați numărul de înregistrări pe pagină de afișat. Vă rugăm să rețineți că un număr mare de înregistrări pe o singură pagină poate reduce performanța.',
        'check' => 'Verificați',
        'delete_selected' => 'Ștergeți selectat',
        'delete_selected_empty' => 'Nu există înregistrări selectate de șters.',
        'delete_selected_confirm' => 'Ștergeți înregistrările selectate?',
        'delete_selected_success' => 'Înregistrările selectate au fost șterse.',
        'column_switch_true' => 'Da',
        'column_switch_false' => 'Nu',
    ],
    'fileupload' => [
        'attachment' => 'Fișier anexat',
        'help' => 'Adăugați un titlu și o descriere pentru acest fișier anexat.',
        'title_label' => 'Titlu',
        'description_label' => 'Descriere',
        'default_prompt' => 'Faceți clic pe %s sau trageți un fișier aici pentru încărcare',
        'attachment_url' => 'Adresa URL a fișierului anexat',
        'upload_file' => 'Încărcare fișier',
        'upload_error' => 'Eroare la încărcare',
        'remove_confirm' => 'Sunteți sigur?',
        'remove_file' => 'Ștergeți fișierul',
    ],
    'repeater' => [
        'add_new_item' => 'Adăugați un element nou',
        'min_items_failed' => ': numele necesită minimum: min elemente, numai: au fost furnizate elemente',
        'max_items_failed' => ': numele permite doar până la: maximum de articole,: au fost furnizate articole',
    ],
    'form' => [
        'create_title' => 'Nou :name',
        'update_title' => 'Editare :name',
        'preview_title' => 'Previzualizare :name',
        'create_success' => ':name a fost creat',
        'update_success' => ':name actualizat',
        'delete_success' => ':name șters',
        'restore_success' => ':name a fost restaurat',
        'reset_success' => 'Resetare finalizată',
        'missing_id' => 'ID-ul înregistrării formularului nu a fost specificat.',
        'missing_model' => 'Comportamentul formularului utilizat în :class nu are un model definit.',
        'missing_definition' => "Comportamentul formularului nu conține un câmp pentru ':field'.",
        'not_found' => 'Înregistrarea formularului cu ID :id nu a putut fi găsit.',
        'action_confirm' => 'Sunteți sigur?',
        'create' => 'Creați',
        'create_and_close' => 'Creați și închideți',
        'creating' => 'Se creează ...',
        'creating_name' => 'Se creează: nume ...',
        'save' => 'Salvare',
        'save_and_close' => 'Salvare și închidere',
        'saving' => 'Salvare ...',
        'saving_name' => 'Salvare: nume ...',
        'delete' => 'Șterge',
        'deleting' => 'Ștergerea ...',
        'confirm_delete' => 'Ștergeți înregistrarea?',
        'confirm_delete_multiple' => 'Ștergeți înregistrările selectate?',
        'deleting_name' => 'Ștergere :name ...',
        'restore' => 'Restore',
        'restoring' => 'Se restabilește ...',
        'confirm_restore' => 'Sigur doriți să restaurați această înregistrare?',
        'reset_default' => 'Resetați la valorile implicite',
        'resetting' => 'Resetare',
        'resetting_name' => 'Resetare :name',
        'undefined_tab' => 'Diverse',
        'field_off' => 'Dezactivat',
        'field_on' => 'Activat',
        'add' => 'Adăugați',
        'apply' => 'Apply',
        'cancel' => 'Anulare',
        'close' => 'Închidere',
        'confirm' => 'Confirmare',
        'reload' => 'Reîncarcă',
        'complete' => 'Completat',
        'ok' => 'OK',
        'or' => 'sau',
        'confirm_tab_close' => 'Închide fila? Modificările nesalvate se vor pierde.',
        'behavior_not_ready' => 'Comportamentul formularului nu a fost inițializat, verificați dacă ați apelat initForm() în controler.',
        'preview_no_files_message' => 'Nu există fișiere încărcate.',
        'preview_no_media_message' => 'Nu există media selectată.',
        'preview_no_record_message' => 'Nu există nicio înregistrare selectată.',
        'select' => 'Selectați',
        'select_all' => 'Selectează tot',
        'select_none' => 'Nu selectați niciunul',
        'select_placeholder' => 'vă rugăm să selectați',
        'insert_row' => 'Introduceți rândul',
        'insert_row_below' => 'Introduceți rândul de mai jos',
        'delete_row' => 'Șterge rândul',
        'concurrency_file_changed_title' => 'Fișierul a fost schimbat',
        'concurrency_file_changed_description' => "Fișierul pe care îl editați a fost schimbat pe disc de către un alt utilizator. Puteți fie să reîncărcați fișierul și să-l pierdeți, fie să îl suprascrieți pe disc.",
        'return_to_list' => 'Reveniți la listă',
    ],
    'recordfinder' => [
        'find_record' => 'Găsiți înregistrarea',
        'invalid_model_class' => 'Clasa modelului ":modelClass" furnizată pentru căutarea înregistrărilor nu este validă',
        'cancel' => 'Anulare',
    ],
    'pagelist' => [
        'page_link' => 'Legătură pagină',
        'select_page' => 'Selectați o pagină ...',
    ],
    'relation' => [
        'missing_config' => 'Comportament relațional nu are nici o configurare pentru ":config".',
        'missing_definition' => "Comportamentul relațional nu conține o definiție pentru ':field'.",
        'missing_model' => 'Comportamentul relațional utilizat în :class nu are un model definit.',
        'invalid_action_single' => 'Această acțiune nu poate fi efectuată pe o relație singulară.',
        'invalid_action_multi' => 'Această acțiune nu poate fi efectuată într-o relație multiplă.',
        'help' => 'Faceți clic pe un element pentru a adăuga',
        'related_data' => 'Date în legătură cu :name',
        'add' => 'Adăugați',
        'add_selected' => 'Adaugă selectat',
        'add_a_new' => 'Adăugați un :name nou:',
        'link_selected' => 'Legătură selectată',
        'link_a_new' => 'Conectați un nou :name',
        'cancel' => 'Anulare',
        'close' => 'Închidere',
        'add_name' => 'Adăugați :name',
        'create' => 'Creați',
        'create_name' => 'Creați :name',
        'update' => 'Actualizare',
        'update_name' => 'Actualizare :name',
        'preview' => 'Previzualizare',
        'preview_name' => 'Previzualizare :name',
        'remove' => 'Îndepărtează',
        'remove_name' => 'Îndepărtează :name',
        'delete' => 'Șterge',
        'delete_name' => 'Șterge :name',
        'delete_confirm' => 'Sunteți sigur?',
        'link' => 'Legătură',
        'link_name' => 'Legătură :name',
        'unlink' => 'Deconectați',
        'unlink_name' => 'Deconectați :name',
        'unlink_confirm' => 'Sunteți sigur?',
    ],
    'reorder' => [
        'default_title' => 'Reordonează înregistrările',
        'no_records' => 'Nu există înregistrări disponibile pentru sortare.',
    ],
    'model' => [
        'name' => "Model",
        'not_found' => "Modelul ':class' cu ID-ul :id nu a putut fi gasit",
        'missing_id' => "Nu exista niciun ID specificat pentru care sa se realizeze cautarea inregistrarii modelului.",
        'missing_relation' => "Modelul ':class' nu contine o definitie pentru relatia ':relation'.",
        'missing_method' => "Modelul ':class' nu conține o metodă ':method'.",
        'invalid_class' => "Modelul :model folosit in clasa :class nu este valid, trebuie sa mosteneasca clasa \Model.",
        'mass_assignment_failed' => "Atribuirea in masa a esuat pentru atributul modelului ':attribute'.",
    ],
    'warnings' => [
        'tips' => 'Sfaturi de configurare a sistemului',
        'tips_description' => 'Există probleme la care trebuie să fiți atenți pentru a configura sistemul corect.',
        'permissions' => 'Dosar :name sau subdosarele sale nu se pot scrie pentru PHP. Vă rugăm să setați permisiunile corespunzătoare pentru serverul web din acest dosar.',
        'extension' => 'Extensia PHP :name nu este instalată. Vă rugăm să instalați această bibliotecă și să activați extensia.',
        'plugin_missing' => 'Pluginul :name este o dependență, dar nu este instalat. Vă rugăm să instalați acest plugin.',
        'debug' => 'Modul de depanare este activat. Acest lucru nu este recomandat pentru instalările de producție.',
        'decompileBackendAssets' => 'Fișierele utilitare din Backend sunt în prezent decompilate. Acest lucru nu este recomandat pentru instalările de producție.',
    ],
    'editor' => [
        'menu_label' => 'Preferinte Editor Cod',
        'menu_description' => 'Personalizati preferintele editorului de cod, preferinte precum dimensiunea fontului si culorile folosite.',
        'font_size' => 'Dimensiune font',
        'tab_size' => 'Lungime tab',
        'use_hard_tabs' => 'Indentare folosind tab-uri',
        'code_folding' => 'Aranjare cod',
        'code_folding_begin' => 'Marcați începutul',
        'code_folding_begin_end' => 'Marcați începutul și sfârșitul',
        'autocompletion' => 'Completare automată',
        'word_wrap' => 'Întrerupere rând',
        'highlight_active_line' => 'Evidentiere linie activa',
        'auto_closing' => 'Inchide automat tag-uri si caractere speciale',
        'show_invisibles' => 'Arata caractere invizibile',
        'show_gutter' => 'Afiseaza panou',
        'basic_autocompletion' => 'Completare automată de bază (Ctrl + Spațiu)',
        'live_autocompletion' => 'Completare automată live',
        'enable_snippets' => 'Activați fragmentele de cod (Tab)',
        'display_indent_guides' => 'Afișați ghidurile de indentare',
        'show_print_margin' => 'Afișați marja de imprimare',
        'mode_off' => 'Dezactivat',
        'mode_fluid' => 'Fluid',
        '40_characters' => '40 caractere ',
        '80_characters' => '80 caractere',
        'theme' => 'Schema de culori',
        'markup_styles' => 'Stiluri de codare',
        'custom_styles' => 'Foaie de stil personalizată',
        'custom styles_comment' => 'Stiluri personalizate de inclus în editorul HTML.',
        'markup_classes' => 'Clase de marcare',
        'paragraph' => 'Paragraf',
        'link' => 'Legătură',
        'table' => 'Tabel',
        'table_cell' => 'Celula tabelului',
        'image' => 'Imagine',
        'label' => 'Etichetă',
        'class_name' => 'Numele clasei',
        'markup_tags' => 'Etichete de marcare',
        'markup_tag' => 'Etichetă de marcare',
        'allowed_empty_tags' => 'Etichete goale permise',
        'allowed_empty_tags_comment' => 'Lista etichetelor care nu sunt eliminate când nu au conținut în interior.',
        'allowed_tags' => 'tag-uri permise',
        'allowed_tags_comment' => 'Lista etichetelor permise.',
        'no_wrap' => 'Do nu înfășurați tag-uri',
        'no_wrap_comment' => 'Lista etichetelor care nu ar trebui să fie înfășurate în etichetele bloc.',
        'remove_tags' => 'Ștergeți etichetele',
        'remove_tags_comment' => 'Lista etichetelor care sunt eliminate împreună cu conținutul lor.',
        'line_breaker_tags' => 'Etichete de întrerupere a liniei',
        'line_breaker_tags_comment' => 'Lista etichetelor care sunt folosite pentru a plasa un element de întrerupere a liniei între.',
        'toolbar_options' => 'Opțiuni bară de instrumente',
        'toolbar_buttons' => 'Butoane pentru bara de instrumente',
        'toolbar_buttons_comment' => 'Butoanele barei de instrumente care vor fi afișate implicit în editorul bogat.',
        'toolbar_buttons_preset' => 'Inserați o configurație a butonului presetat al barei de instrumente:',
        'toolbar_buttons_presets' => [
            'default' => 'Implicit',
            'minimal' => 'Minimal',
            'full' => 'Complet',
        ],
        'paragraph_formats' => 'Formate de paragraf',
        'paragraph_formats_comment' => 'Opțiunile care vor apărea în meniul derulant Format Paragraf.',
    ],
    'tooltips' => [
        'preview_website' => 'Previzualizare site'
    ],
    'mysettings' => [
        'menu_label' => 'Setarile mele',
        'menu_description' => 'Setarile in legatura cu contul de administrare',
    ],
    'myaccount' => [
        'menu_label' => 'Contul meu',
        'menu_description' => 'Actualizati datele contului, precum nume, adresa de email si parola.',
        'menu_keywords' => 'securitate login'
    ],
    'branding' => [
        'menu_label' => 'Personalizați back-end-ul',
        'menu_description' => 'Personalizați zona de administrare, cum ar fi numele, culorile și sigla.',
        'brand' => 'Brand',
        'logo' => 'Logo',
        'logo_description' => 'Încărcați o siglă personalizată pentru a o utiliza în back-end.',
        'favicon' => 'Favicon',
        'favicon_description' => 'Încărcați un favicon personalizat pentru a fi utilizat în back-end',
        'app_name' => 'Nume aplicație',
        'app_name_description' => 'Acest nume este afișat în zona de titlu a back-end-ului.',
        'app_tagline' => 'Sloganul aplicației',
        'app_tagline_description' => 'Acest nume este afișat pe ecranul de conectare pentru back-end.',
        'colors' => 'Culori',
        'primary_color' => 'Culoare primară',
        'secondary_color' => 'Culoare secundară',
        'accent_color' => 'Culoarea accentului',
        'styles' => 'Stiluri',
        'custom_stylesheet' => 'Foaie de stil personalizată',
        'navigation' => 'Navigare',
        'menu_mode' => 'Stilul meniului',
        'menu_mode_inline' => 'În linie',
        'menu_mode_inline_no_icons' => 'În linie (fără pictograme)',
        'menu_mode_tile' => 'Placi',
        'menu_mode_collapsed' => 'Restrâns',
    ],
    'backend_preferences' => [
        'menu_label' => 'Preferinte administrare',
        'menu_description' => 'Gestionati preferinte limba si setari aspect panou de administrare.',
        'region' => 'Regiune',
        'code_editor' => 'Editor de cod',
        'timezone' => 'Fus orar',
        'timezone_comment' => 'Ajustați datele afișate la acest fus orar.',
        'locale' => 'Limba',
        'locale_comment' => 'Selectati limba dorita.',
    ],
    'access_log' => [
        'hint' => 'Acest jurnal afiseaza o lista de conectari reusite, realizate de catre administratori. Inregistrarile sunt pastrate pentru un numar total de :days zile.',
        'menu_label' => 'Jurnal acces',
        'menu_description' => 'Vizualizati o lista de conectari reusite, realizate de catre administratori.',
        'id' => 'ID',
        'created_at' => 'Data & Ora',
        'type' => 'Tip',
        'login' => 'Autentificare',
        'ip_address' => 'Adresa IP',
        'first_name' => 'Prenume',
        'last_name' => 'Nume',
        'email' => 'Email',
    ],
    'filter' => [
        'all' => 'toate',
        'options_method_not_exists' => "Clasa modelului :model trebuie să definească o metodă :method() care returnează opțiunile pentru filtrul ':filter'.",
        'date_all' => 'toate perioadele',
        'number_all' => 'toate numerele',
    ],
    'import_export' => [
        'upload_csv_file' => '1. Încărcați un fișier CSV ',
        'import_file' => 'Importați fișierul',
        'row' => 'Rând :row',
        'first_row_contains_titles' => 'Primul rând conține titluri de coloane',
        'first_row_contains_titles_desc' => 'Lăsați această opțiune bifată dacă primul rând din CSV este folosit ca titluri de coloană.',
        'match_columns' => '2. Potriviți coloanele fișierului cu câmpurile bazei de date ',
        'file_columns' => 'Coloane de fișiere',
        'database_fields' => 'Câmpurile bazei de date',
        'set_import_options' => '3. Setați opțiunile de import ',
        'export_output_format' => '1. Exportați formatul de ieșire ',
        'file_format' => 'Format fișier',
        'standard_format' => 'Format standard',
        'custom_format' => 'Format personalizat',
        'delimiter_char' => 'Caracter delimitator',
        'enclosure_char' => 'Simbol de încorporare',
        'escape_char' => 'Exclude simbolul',
        'select_columns' => '2. Selectați coloanele de exportat ',
        'column' => 'Coloană',
        'columns' => 'Coloane',
        'set_export_options' => '3. Setați opțiunile de export ',
        'show_ignored_columns' => 'Afișează coloanele ignorate',
        'auto_match_columns' => 'Coloane de potrivire automată',
        'created' => 'Creat',
        'updated' => 'Actualizat',
        'skipped' => 'Omis',
        'warnings' => 'Avertismente',
        'errors' => 'Erori',
        'skipped_rows' => 'Rânduri omise',
        'import_progress' => 'Progresul importului',
        'processing' => 'Procesare',
        'import_error' => 'Eroare la import',
        'upload_valid_csv' => 'Vă rugăm să încărcați un fișier CSV valid.',
        'drop_column_here' => 'Aruncați coloana aici ...',
        'ignore_this_column' => 'Ignorați această coloană',
        'processing_successful_line1' => 'Procesul de exportare a fișierelor s-a finalizat!',
        'processing_successful_line2' => 'Browserul va redirecționa acum către descărcarea fișierului.',
        'export_progress' => 'Progresul exportului',
        'export_error' => 'Eroare la export',
        'column_preview' => 'Previzualizare coloană',
        'file_not_found_error' => 'Fișierul nu a fost găsit',
        'empty_error' => 'Nu au fost furnizate date pentru export',
        'empty_import_columns_error' => 'Vă rugăm să specificați câteva coloane de importat.',
        'match_some_column_error' => 'Vă rugăm să potriviți mai întâi câteva coloane.',
        'required_match_column_error' => 'Vă rugăm să specificați o potrivire pentru câmpul obligatoriu: etichetă.',
        'empty_export_columns_error' => 'Vă rugăm să specificați câteva coloane de exportat.',
        'behavior_missing_uselist_error' => 'Trebuie să implementați comportamentul controlerului ListController cu opțiunea de export "useList" activată.',
        'missing_model_class_error' => 'Vă rugăm să specificați proprietatea modelClass pentru :type',
        'missing_column_id_error' => 'Lipsește identificatorul coloanei',
        'unknown_column_error' => 'Coloana necunoscută',
        'encoding_not_supported_error' => 'Codificarea fișierului sursă nu este recunoscută. Vă rugăm să selectați opțiunea de formatare a fișierului personalizat cu codificarea adecvată pentru a importa fișierul. ',
        'encoding_format' => 'Codificare fișier',
        'encodings' => [
            'utf_8' => 'UTF-8',
            'us_ascii' => 'US-ASCII',
            'iso_8859_1' => 'ISO-8859-1 (Latin-1, Western European)',
            'iso_8859_2' => 'ISO-8859-2 (Latin-2, Central European)',
            'iso_8859_3' => 'ISO-8859-3 (Latin-3, South European)',
            'iso_8859_4' => 'ISO-8859-4 (Latin-4, North European)',
            'iso_8859_5' => 'ISO-8859-5 (Latin, Cyrillic)',
            'iso_8859_6' => 'ISO-8859-6 (Latin, Arabic)',
            'iso_8859_7' => 'ISO-8859-7 (Latin, Greek)',
            'iso_8859_8' => 'ISO-8859-8 (Latin, Hebrew)',
            'iso_8859_0' => 'ISO-8859-9 (Latin-5, Turkish)',
            'iso_8859_10' => 'ISO-8859-10 (Latin-6, Nordic)',
            'iso_8859_11' => 'ISO-8859-11 (Latin, Thai)',
            'iso_8859_13' => 'ISO-8859-13 (Latin-7, Baltic Rim)',
            'iso_8859_14' => 'ISO-8859-14 (Latin-8, Celtic)',
            'iso_8859_15' => 'ISO-8859-15 (Latin-9, Western European revision with euro sign)',
            'windows_1250' => 'Windows-1250 (CP1250, Central and Eastern European)',
            'windows_1251' => 'Windows-1251 (CP1251)',
            'windows_1252' => 'Windows-1252 (CP1252)',
        ],
    ],
    'permissions' => [
        'manage_media' => 'Încărcați și gestionați conținut media - imagini, videoclipuri, sunete, documente',
        'allow_unsafe_markdown' => 'Utilizați Markdown nesigur (poate include Javascript)',
    ],
    'mediafinder' => [
        'label' => 'Căutător Media',
        'default_prompt' => 'Faceți clic pe butonul %s pentru a găsi un element media',
        'no_image' => 'Imaginea nu a putut fi găsită',
    ],
    'media' => [
        'menu_label' => 'Media',
        'upload' => 'Încărcare',
        'move' => 'Mutare',
        'delete' => 'Șterge',
        'add_folder' => 'Adăugați dosarul',
        'search' => 'Căutare',
        'display' => 'Afișare',
        'filter_everything' => 'Totul',
        'filter_images' => 'Imagini',
        'filter_video' => 'Video',
        'filter_audio' => 'Audio',
        'filter_documents' => 'Documente',
        'library' => 'Bibliotecă',
        'size' => 'Dimensiune',
        'title' => 'Titlu',
        'last_modified' => 'Ultima modificare',
        'public_url' => 'URL',
        'click_here' => 'Faceți clic aici',
        'thumbnail_error' => 'Eroare la generarea miniaturii.',
        'return_to_parent' => 'Reveniți la dosarul părinte',
        'return_to_parent_label' => 'Sus ..',
        'nothing_selected' => 'Nimic nu este selectat.',
        'multiple_selected' => 'Mai multe elemente selectate.',
        'uploading_file_num' => 'Încărcare :number fișier(e) ...',
        'uploading_complete' => 'Încărcare finalizată',
        'uploading_error' => 'Încărcare eșuată',
        'type_blocked' => 'Tipul de fișier utilizat este blocat din motive de securitate.',
        'order_by' => 'Ordonează după',
        'direction' => 'Direcție',
        'direction_asc' => 'Crescător',
        'direction_desc' => 'Descrescător',
        'folder' => 'Dosar',
        'no_files_found' => 'Niciun fișier găsit de cererea dvs.',
        'delete_empty' => 'Vă rugăm să selectați elementele de șters.',
        'delete_confirm' => 'Ștergeți elementele selectate?',
        'error_renaming_file' => 'Eroare la redenumirea articolului.',
        'new_folder_title' => 'Dosar nou',
        'folder_name' => 'Numele dosarului',
        'error_creating_folder' => 'Eroare la crearea dosarului',
        'folder_or_file_exist' => 'Există deja un dosar sau un fișier cu numele specificat.',
        'move_empty' => 'Vă rugăm să selectați elementele de mutat.',
        'move_popup_title' => 'Mutați fișiere sau dosare',
        'move_destination' => 'Dosar destinație',
        'please_select_move_dest' => 'Vă rugăm să selectați un dosar de destinație.',
        'move_dest_src_match' => 'Vă rugăm să selectați un alt dosar de destinație.',
        'empty_library' => 'Aici este puțin cam gol. Încărcați fișiere sau creați foldere pentru a începe. ',
        'insert' => 'Inserare',
        'crop_and_insert' => 'Decupare și inserare',
        'select_single_image' => 'Vă rugăm să selectați o singură imagine.',
        'selection_not_image' => 'Elementul selectat nu este o imagine.',
        'restore' => 'Anulați toate modificările',
        'resize' => 'Redimensionare ...',
        'selection_mode_normal' => 'Normal',
        'selection_mode_fixed_ratio' => 'Raport fix',
        'selection_mode_fixed_size' => 'Dimensiune fixă',
        'height' => 'Înălțime',
        'width' => 'Latime',
        'selection_mode' => 'Mod de selecție',
        'resize_image' => 'Redimensionare imagine',
        'image_size' => 'Dimensiunea imaginii:',
        'selected_size' => 'Selectat:',
    ],
];
