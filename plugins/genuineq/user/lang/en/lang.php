<?php

return [
    'plugin' => [
        'name' => 'User',
        'description' => 'Front-end user management',
        'tab' => 'Users',
        'access_users' => 'Manage Users',
        'access_groups' => 'Manage User Groups',
        'access_settings' => 'Manage User Settings',
        'impersonate_user' => 'Impersonate Users'
    ],

    'users' => [
        'menu_label' => 'Users',
        'all_users' => 'All Users',
        'new_user' => 'New User',
        'list_title' => 'Manage Users',
        'trashed_hint_title' => 'User has deactivated their account',
        'trashed_hint_desc' => 'This user has deactivated their account and no longer wants to appear on the site. They can restore their account at any time by signing back in',
        'banned_hint_title' => 'User has been banned',
        'banned_hint_desc' => 'This user has been banned by an administrator and will be unable to sign in',
        'guest_hint_title' => 'This is a guest user',
        'guest_hint_desc' => 'This user is stored for reference purposes only and needs to register before signing in',
        'activate_warning_title' => 'User not activated!',
        'activate_warning_desc' => 'This user has not been activated and may be unable to sign in',
        'activate_confirm' => 'Do you really want to activate this user?',
        'activated_success' => 'User has been activated',
        'activate_manually' => 'Activate this user manually',
        'convert_guest_confirm' => 'Convert this guest to a user?',
        'convert_guest_manually' => 'Convert to registered user',
        'convert_guest_success' => 'User has been converted to a registered account',
        'impersonate_user' => 'Impersonate user',
        'impersonate_confirm' => 'Impersonate this user? You can revert to your original state by logging out',
        'impersonate_success' => 'You are now impersonating this user',
        'delete_confirm' => 'Do you really want to delete this user?',
        'unban_user' => 'Unban this user',
        'unban_confirm' => 'Do you really want to unban this user?',
        'unbanned_success' => 'User has been unbanned',
        'return_to_list' => 'Return to users list',
        'update_details' => 'Update details',
        'bulk_actions' => 'Bulk actions',
        'delete_selected' => 'Delete selected',
        'delete_selected_confirm' => 'Delete the selected users?',
        'delete_selected_empty' => 'There are no selected users to delete',
        'delete_selected_success' => 'Successfully deleted the selected users',
        'activate_selected' => 'Activate selected',
        'activate_selected_confirm' => 'Activate the selected users?',
        'activate_selected_empty' => 'There are no selected users to activate',
        'activate_selected_success' => 'Successfully activated the selected users',
        'deactivate_selected' => 'Deactivate selected',
        'deactivate_selected_confirm' => 'Deactivate the selected users?',
        'deactivate_selected_empty' => 'There are no selected users to deactivate',
        'deactivate_selected_success' => 'Successfully deactivated the selected users',
        'restore_selected' => 'Restore selected',
        'restore_selected_confirm' => 'Restore the selected users?',
        'restore_selected_empty' => 'There are no selected users to restore',
        'restore_selected_success' => 'Successfully restored the selected users',
        'ban_selected' => 'Ban selected',
        'ban_selected_confirm' => 'Ban the selected users?',
        'ban_selected_empty' => 'There are no selected users to ban',
        'ban_selected_success' => 'Successfully banned the selected users',
        'unban_selected' => 'Unban selected',
        'unban_selected_confirm' => 'Unban the selected users?',
        'unban_selected_empty' => 'There are no selected users to unban',
        'unban_selected_success' => 'Successfully unbanned the selected users',
        'unsuspend' => 'Unsuspend',
        'unsuspend_success' => 'User has been unsuspended',
        'unsuspend_confirm' => 'Unsuspend this user?',
        'created_at' => 'Created at',
        'status_activated' => 'Activated',
        'return_to_users' => 'Back to users list',
    ],

    'settings' => [
        'users' => 'Users',
        'menu_label' => 'User settings',
        'menu_description' => 'Manage user based settings',
        'activation_tab' => 'Activation',
        'signin_tab' => 'Sign in',
        'registration_tab' => 'Registration',
        'profile_tab' => 'Profile',
        'notifications_tab' => 'Notifications',
        'allow_registration' => 'Allow user registration',
        'allow_registration_comment' => 'If this is disabled users can only be created by administrators',
        'activate_mode' => 'Activation mode',
        'activate_mode_comment' => 'Select how a user account should be activated',
        'activate_mode_auto' => 'Automatic',
        'activate_mode_auto_comment' => 'Activated automatically upon registration',
        'activate_mode_user' => 'User',
        'activate_mode_user_comment' => 'The user activates their own account using mail',
        'activate_mode_admin' => 'Administrator',
        'activate_mode_admin_comment' => 'Only an Administrator can activate a user',
        'require_activation' => 'Sign in requires activation',
        'require_activation_comment' => 'Users must have an activated account to sign in',
        'use_throttle' => 'Throttle attempts',
        'use_throttle_comment' => 'Repeat failed sign in attempts will temporarily suspend the user',
        'use_register_throttle' => 'Throttle registration',
        'use_register_throttle_comment' => 'Prevent multiple registrations from the same IP in short succession',
        'block_persistence' => 'Prevent concurrent sessions',
        'block_persistence_comment' => 'When enabled users cannot sign in to multiple devices at the same time',
        'remember_login' => 'Remember login mode',
        'remember_login_comment' => 'Select if the user session should be persistent',
        'remember_always' => 'Always',
        'remember_never' => 'Never',
        'remember_ask' => 'Ask the user on login',
    ],

    'group' => [
        'label' => 'Group',
        'id' => 'ID',
        'name' => 'Name',
        'description_field' => 'Description',
        'code' => 'Code',
        'code_comment' => 'Enter a unique code used to identify this group',
        'created_at' => 'Created',
        'users_count' => 'Users'
    ],

    'groups' => [
        'menu_label' => 'Groups',
        'all_groups' => 'User Groups',
        'new_group' => 'New Group',
        'delete_selected_confirm' => 'Do you really want to delete selected groups?',
        'list_title' => 'Manage Groups',
        'delete_confirm' => 'Do you really want to delete this group?',
        'delete_selected_success' => 'Successfully deleted the selected groups',
        'delete_selected_empty' => 'There are no selected groups to delete',
        'return_to_list' => 'Back to groups list',
        'create_title' => 'Create User Group',
        'update_title' => 'Edit User Group',
        'preview_title' => 'Preview User Group'
    ],

    'helper' => [
        'access_denied' => 'Nu aveti acces la locatia respectiva',
        'login_required' => 'Trebuie sa fiti autentificat',
    ],

    'backend' => [
        'user' => [
            'label' => 'User',

            'fields' => [
                'name' => 'Name',
                'name_comment' => 'The full name of the user',

                'email' => 'Email',
                'email_comment' => 'The email of the user',

                'identifier' => 'Identifier',
                'identifier_comment' => 'The unique identifier of the user',

                'type' => 'Type',
                'type_comment' => 'The type of the user',

                'create_password' => 'Create Password',
                'create_password_comment' => 'Enter a new password used for the user',

                'reset_password' => 'Reset Password',
                'reset_password_comment' => 'To reset this users password, enter a new password here',

                'confirm_password' => 'Password Confirmation',
                'confirm_password_comment' => 'Enter the password again to confirm it',

                'send_invite' => 'Send invitation by email',
                'send_invite_comment' => 'Sends a welcome message containing login and password information',

                'block_mail' => 'Block mails',
                'block_mail_comment' => 'Block all outgoing mail sent to this user',

                'created_ip_address' => 'Created IP Address',
                'created_ip_address_comment' => 'The IP address from which the user was created',

                'last_ip_address' => 'Last IP Address',
                'last_ip_address_comment' => 'The last IP address from which the user was used',

                'is_activated' => 'User activated',
                'is_activated_comment' => 'Is the user already activated or the activation flow must be executed?',

                'email_notifications' => 'Email notifications',
                'email_notifications_comment' => 'Will the user receive notifications via email?',

                'groups' => 'Group',
                'groups_comment' => 'The ONE group the user is past of, select based on the user type',
                'groups_empty' => 'There are no user groups available',

                'avatar' => 'Avatar',
                'avatar_comment' => 'The avatar of the user',
            ],

            'columns' => [
                'id' => '#',
                'name' => 'Name',
                'email' => 'Email',
                'identifier' => 'Identifier',
                'type' => 'Type',
                'is_activated' => 'User activated',
                'last_login' => 'Last login',
                'last_ip_address' => 'Last IP Address',
            ],

            'scoreboard' => [
                'name' => 'Name',
                'joined' => 'Joined',
                'last_seen' => 'Last seen',

                'status_guest' => 'Guest',
                'status_activated' => 'Activated',
                'status_registered' => 'Registered',

                'is_guest' => 'Guest',
                'is_online' => 'Online now',
                'is_offline' => 'Currently offline',
            ],

            'id' => 'ID',
            'username' => 'Username',
            'surname' => 'Surname',
            'created_at' => 'Registered',
            'account' => 'Account',
        ],
    ],

    'component' => [
        'session' => [
            'name' => 'Session',
            'description' => 'Adds the user session to a page and can restrict page access',
            'backend' => [
                'force_secure' => 'Force secure protocol',
                'force_secure_desc' => 'Always redirect the URL with the HTTPS schema',
                'code_param' => 'Activation Code Param',
                'code_param_desc' => 'The page URL parameter used for the registration activation code',
                'security_title' => 'Allow only',
                'security_desc' => 'Who is allowed to access this page',
                'all' => 'All',
                'users' => 'Users',
                'guests' => 'Guests',
                'allowed_groups_title' => 'Allow groups',
                'allowed_groups_description' => 'Choose allowed groups or none to allow all groups',
                'allowed_types_title' => 'Allow types',
                'allowed_types_description' => 'Choose allowed types or none to allow all types',
                'redirect_title' => 'Redirect to',
                'redirect_desc' => 'Page name to redirect if access is denied',
            ],
            'message' => [
                'access_denied' => 'Nu aveti acces la locatia respectiva',
                'logout' => 'Deconectare cu succes',
                'stop_impersonate_success' => 'Impersonare incheiata',
            ],
        ],

        'login' => [
            'name' => 'Login',
            'description' => 'Allows users to login',
            'backend' => [
                'redirect_to' => 'Redirect to',
                'redirect_to_desc' => 'Page name to redirect to after login',
                'force_secure' => 'Force secure protocol',
                'force_secure_desc' => 'Always redirect the URL with the HTTPS schema',
            ],
            'validation' => [
                'email_required' => 'Adresa de email este obligatorie',
                'email_between' => 'Adresa de email trebuie să aibă între 6 si 255 de caractere',
                'email_email' => 'Adresa de email nu este validă',
                'password_required' => 'Parola este obligatorie',
                'password_between_1' => 'Parola trebuie să aibă între ',
                'password_between_2' => ' și ',
                'password_between_3' => ' caractere',
            ],
            'message' => [
                'banned' => 'Ne pare rău, acest utilizator este blocat. Va rugăm să ne contactați pentru alte detalii',
                'not_active_email_sent' => 'Ne pare rău, acest utilizator nu este activ. Va rugăm să verificați email-ul de activare',
                'not_active' => 'Ne pare rău, acest utilizator nu este activat.',
                'wrong_credentials' => 'Credențialele introduse nu sunt valide',
                'could_not_create_token' => 'Ne pare rău, a apărut o eroare la autentificare. Dacă procesul persistă vă rugăm să ne contactați',
            ],
        ],

        'register' => [
            'name' => 'Register',
            'description' => 'Allows users to register',
            'backend' => [
                'force_secure' => 'Force secure protocol',
                'force_secure_desc' => 'Always redirect the URL with the HTTPS schema',
                'code_param' => 'Activation Code Param',
                'code_param_desc' => 'The page URL parameter used for the registration activation code',
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
                'password_confirmed' => 'Parolele nu se potrivesc',
                'password_confirmation_required' => 'Confirmarea parolei este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea parolei este obligatorie',
                'consent_required' => 'Acceptarea Termenilor și Condițiilor și a Politicii de Confidențialitate este obligatorie',
                'consent_accepted' => 'Acceptarea Termenilor și Condițiilor și a Politicii de Confidențialitate este obligatorie',
            ],
            'message' => [
                'registration_disabled' => 'Înregistrările sunt momentan dezactivate',
                'registration_throttled' => 'Prea multe încercări de înregistrare nereușite. Va rugăm să încercați mai târziu',
                'activation_email_sent' => 'Un email de activare a fost trimis către adresa de email specificată',
                'registration_successful' => 'Mulțumim pentru înregistrare. Te rugăm să verifici email-ul, contul tău este în proces de validare',
                'registration_skiped' => 'Școala de care aparții este deja înrolată în platformă și administratorul școlii poate să îți activeze un cont în platformă. Am notificat școala. Între timp poți lua legătura cu școala pentru a-ți activa contul cât mai rapid posibil',
                'invalid_activation_code' => 'Codul de activare furnizat nu este valid',
                'success_activation' => 'Contul a fost activat cu succes',
                'already_activated' => 'Contul este deja activat. Va rugăm să va autentificați',
            ],
        ],

        'account' => [
            'name' => 'Account',
            'description' => 'Allows users to manage their profiles',
            'backend' => [
                'force_secure' => 'Force secure protocol',
                'force_secure_desc' => 'Always redirect the URL with the HTTPS schema',
            ],
            'validation' => [
                'account_mail_required' => 'Adresa de email este obligatorie',
                'account_mail_between' => 'Adresa de email trebuie sa aiba intre 6 si 255 de caractere',
                'account_mail_email' => 'Adresa de email nu este valida',
                'account_mail_unique' => 'Adresa de email este deja folosita',
                'current_password_required' => 'Parola actuala este obligatorie',
                'current_password_wrong' => 'Parola actuala nu este corecta',
                'password_required' => 'Noua parola este obligatorie',
                'password_between_1' => 'Noua parola trebuie sa aiba intre ',
                'password_between_2' => ' si ',
                'password_between_3' => ' de caractere',
                'password_confirmed' => 'Parolele nu se potrivesc',
                'password_confirmation_required' => 'Confirmarea noii parole este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea noii parole este obligatorie',
            ],
            'message' => [
                'avatar_update_successful' => 'Poza de profil a fost actualizata cu succes',
                'avatar_update_failed' => 'Actualizarea pozei de profil a esuat',
                'email_update_successful' => 'Adresa de email a fost actualizata cu succes',
                'password_update_successful' => 'Parola a fost actualizata cu succes',
                'email_notifications_update_successful' => 'Notificarile au fost actualizate cu succes',
                'account_update_successful' => 'Profilul a fost actualizat cu succes',
                'user_invite_successful' => 'Cont creat cu succes',
            ],
        ],

        'password-reset' => [
            'name' => ' Password Reset',
            'description' => 'Allows users to reset their password',
            'backend' => [
                'reset_page' => 'Password reset page',
                'reset_page_desc' => 'The page for password reset'
            ],
            'validation' => [
                'email_required' => 'Adresa de email este obligatorie',
                'email_between' => 'Adresa de email trebuie sa aiba intre 6 si 255 de caractere',
                'email_email' => 'Adresa de email nu este valida',
                'password_required' => 'Parola este obligatorie',
                'password_between_1' => 'Parola trebuie sa aiba intre ',
                'password_between_2' => ' si ',
                'password_between_3' => ' de caractere',
                'password_confirmed' => 'Parolele nu se potrivesc',
                'password_confirmation_required' => 'Confirmarea parolei este obligatorie',
                'password_confirmation_required_with' => 'Confirmarea parolei este obligatorie',
            ],
            'message' => [
                'restore_successful' => 'Am trimis instructiunile pe adresa de email specificata',
                'reset_successful' => 'Parola a fost schimbată cu succes',
                'invalid_reset_code' => 'Codul de resetare a parolei nu este valid',
            ],
        ],

        'notifications' => [
            'name' => 'Notifications',
            'description' => 'Displays user notifications',
        ],
    ],

    'reportwidgets' => [
        'total_registration_requests' => [
            'label' => 'Total registration requests',
            'title' =>  'Total number of registration requests',
            'title_default' => 'Total registration requests',
            'title_validation' => '',

            'frontend' => [
                'label_registration_requests' => 'Total number of registration requests'
            ],
        ],

        'reg_requests_table' => [
            'label' => 'Registration requests table',
            'title' =>  'Registration requests',
            'title_default' => 'Registration requests table',
            'title_validation' => '',

            'frontend' => [
                'activate_button' => 'Activate account',
                'label_registration_requests' => 'Registration requests table',
                'preview' => 'Preview request details',
            ],

            'flash' => [
                'success' => 'Account was successfully activated',
                'fail' => 'Failed to activate that account',
            ],
        ],
    ],

];
