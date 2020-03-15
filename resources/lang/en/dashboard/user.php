<?php

return [
    'column' => [
        'id'             => 'No.',
        'name'           => 'Name',
        'type'           => 'Type',
        'lang'           => 'Language',
        'stage'          => 'Stage',
        'email'          => 'E-mail',
        'phone'          => 'Phone',
        'password'       => 'Password',
        'gender'         => 'Gender',
        'country'        => 'Country',
        'birth_date'     => 'Birth Date',
        'address'        => 'Address',
        'certificate'    => 'Certificate',
        'created_at'     => 'Created At',
        'last_login'     => 'Last Login',
        'state'          => 'State',
        'remember_token' => 'Token',

        're_password'     => 'Re-Password',
        'last_login_null' => 'Not Login'
    ],

    'placeholder' => [
        'name'        => 'Full Name and Surname',
        'stage'       => 'Select Stage',
        'email'       => 'E-mail',
        'phone'       => 'Phone',
        'gender'      => 'Select Gender',
        'country'     => 'Select Country',
        'certificate' => 'Select Certificate'
    ],

    'components' => [
        'datatable' => [
            'title-1'   => 'Students Enrolled In The Institute',
            'title-2'   => 'Listeners Enrolled In The Institute',
            'btn-add-1' => 'Add Student',
            'btn-add-2' => 'Add Listener'
        ],

        'modal-info' => [
            'header-1'      => 'Student Account Information',
            'header-2'      => 'Listener Account Information',
            'btn-info'      => 'Show File',
            'btn-dismiss'   => 'No, Thanks',
            'error-message' => 'User Not Found'
        ]
    ],

    'index' => [
        'title-1'   => 'Students',
        'title-2'   => 'Listeners'
    ],

    'create' => [
        'title-1'  => 'Add Student',
        'title-2'  => 'Add Listener',
        'btn-send' => 'Send'
    ],

    'store' => [
        'success' => 'Account successfully created.',
        'failed'  => 'The account was not created, try again.'
    ],

    'show' => [
        'tab' => [
            'profile'       => 'Profile',
            'documents'     => 'Documents',
            'account-state' => 'Account State'
        ],

        'profile-tab' => [
            'btn-edit' => 'Edit Account'
        ],

        'account-state-tab' => [
            'header-info'      => 'Fill out all account information.',
            'header-auth'      => 'Authenticating the account by (mail or phone).',
            'header-documents' => 'Accept all required documents.',
        ]
    ],

    'edit' => [
        'change-info'     => 'Change Account Information',
        'change-password' => 'Change Account Password',
        'btn-save'        => 'Save'
    ],

    'update' => [
        'success' => 'The account was successfully updated.',
        'failed'  => 'The account has not been updated.'
    ]
];
