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
        'access_denied' => 'You do not have access to that location',
        'login_required' => 'You must be logged in',
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
                'access_denied' => 'You do not have access to that location',
                'logout' => 'Logout successfully',
                'stop_impersonate_success' => 'Impersonate completed',
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
                'email_required' => 'Email address required',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Invalid email address',
                'password_required' => 'Password required',
                'password_between_1' => 'Password must be between ',
                'password_between_2' => ' and ',
                'password_between_3' => ' characters',
            ],
            'message' => [
                'banned' => 'Sorry, this user is blocked. You will need to contact us for further details',
                'not_active_email_sent' => 'Sorry, this user is not active. We\'ll need to check your activation email',
                'not_active' => 'Sorry, this user is not active.',
                'wrong_credentials' => 'The credentials entered are invalid',
                'could_not_create_token' => 'Sorry, an authentication error occurred. If the process persists please contact us',
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
                'name_required' => 'Name required',
                'name_regex' => 'Name can only contain letters, space and character -',
                'email_required' => 'Email address required',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Email address is invalid',
                'email_unique' => 'Email address is already in use.',
                'password_required' => 'Password required',
                'password_between_1' => 'Password must be between ',
                'password_between_2' => ' and ',
                'password_between_3' => ' characters',
                'password_confirmed' => 'Passwords do not match',
                'password_confirmation_required' => 'Password confirmation required',
                'password_confirmation_required_with' => 'Password confirmation required',
                'consent_required' => 'Acceptance of the Terms and Conditions and the Privacy Policy is mandatory',
                'consent_accepted' => 'Acceptance of the Terms and Conditions and the Privacy Policy is mandatory',
            ],
            'message' => [
                'registration_disabled' => 'Registrations are currently disabled',
                'registration_throttled' => 'Too many failed registration attempts. Please try again later',
                'activation_email_sent' => 'An activation email has been sent to the specified email address',
                'registration_successful' => 'Thanks for registering. Please check your email. Your account is in the process of being validated',
                'registration_skiped' => 'The school you belong to is already enrolled in the platform and the school administrator can activate an account for you on the platform. I notified the school. In the meantime, you can contact the school to activate your account as soon as possible',
                'invalid_activation_code' => 'The provided activation code is invalid',
                'success_activation' => 'Account successfully activated',
                'already_activated' => 'The account is already activated. Please sign in',
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
                'account_mail_required' => 'Email address required',
                'account_mail_between' => 'Email address must be between 6 and 255 characters',
                'account_mail_email' => 'Email address is invalid',
                'account_mail_unique' => 'Email address already used',
                'current_password_required' => 'Current password required',
                'current_password_wrong' => 'The current password is incorrect',
                'password_required' => 'New password required',
                'password_between_1' => 'New password must be between ',
                'password_between_2' => ' and ',
                'password_between_3' => ' characters',
                'password_confirmed' => 'Passwords are not the same',
                'password_confirmation_required' => 'New password confirmation required',
                'password_confirmation_required_with' => 'Confirm new password required',
            ],
            'message' => [
                'avatar_update_successful' => 'Profile picture updated successfully',
                'avatar_update_failed' => 'Profile picture update failed',
                'email_update_successful' => 'Email address successfully updated',
                'password_update_successful' => 'Password updated successfully',
                'email_notifications_update_successful' => 'Notifications successfully updated',
                'account_update_successful' => 'Profile successfully updated',
                'user_invite_successful' => 'Successfully created account',
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
                'email_required' => 'Email address required',
                'email_between' => 'Email address must be between 6 and 255 characters',
                'email_email' => 'Email address is invalid',
                'password_required' => 'Password required',
                'password_between_1' => 'Password must be between',
                'password_between_2' => 'and',
                'password_between_3' => 'characters',
                'password_confirmed' => 'Passwords are not the same',
                'password_confirmation_required' => 'Password confirmation required',
                'password_confirmation_required_with' => 'Password confirmation required',
            ],
            'message' => [
                'restore_successful' => 'Instructions was sended to the specified email address',
                'reset_successful' => 'Password changed successfully',
                'invalid_reset_code' => 'Invalid password reset code',
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
            'title' => 'Total number of registration requests',
            'title_default' => 'Total registration requests',
            'title_validation' => '',

            'frontend' => [
                'label_registration_requests' => 'Total number of registration requests'
            ],
        ],

        'reg_requests_table' => [
            'label' => 'Registration requests',
            'title' => 'Registration requests',
            'title_default' => 'Registration requests table',
            'title_validation' => '',

            'frontend' => [
                'activate_button' => 'Activate account(s)',
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
