<?php

return [
    'status' => [
        [
            'name' => 'Active',
            'value' => '1'
        ], [
            'name' => 'In Active',
            'value' => '0'
        ]
    ],
    'gender' => [
        [
            'name' => 'Male',
            'value' => 'male'
        ], [
            'name' => 'Female',
            'value' => 'female'
        ]
    ],
    'membership_type' => ['Corporate', 'Sectoral Corporate'],
    'settings' => [
        [
            'name' => 'app_name',
            'value' => 'PSCGY Admin',
            'type' => 'general',
        ],[
            'name' => 'admin_mail',
            'value' => 'admin@yopmail.com',
            'type' => 'general',
        ],
    ],
    'roles' => [
        [
            'name' => 'Admin',
            'type' => 'default',
        ],[
            'name' => 'Member',
            'type' => 'default',
        ]
    ],
    'permissions' => [
        [
            'name_key' => 'profile_view',
            'name' => 'View Profile',
            'roles' => ['Admin', 'Member'],
            'module' => 'Profile',
        ], [
            'name_key' => 'profile_update',
            'name' => 'Update Profile',
            'roles' => ['Admin', 'Member'],
            'module' => 'Profile',
        ], [
            'name_key' => 'profile_active_deactive',
            'name' => 'Activate / DeActivate Profile',
            'roles' => ['Member'],
            'module' => 'Profile',
        ], [
            'name_key' => 'profile_delete',
            'name' => 'Delete Profile',
            'roles' => ['Member'],
            'module' => 'Profile',
        ],

        [
            'name_key' => 'member_dashboard',
            'name' => 'Member Dashboard',
            'roles' => ['Member'],
            'module' => 'Dashboard',
        ],

        [
            'name_key' => 'admin_dashboard',
            'name' => 'Admin Dashboard',
            'roles' => ['Admin'],
            'module' => 'Dashboard',
        ],

        [
            'name_key' => 'user_list',
            'name' => 'All User',
            'roles' => ['Admin'],
            'module' => 'User',
        ],[
            'name_key' => 'user_export',
            'name' => 'Export User',
            'roles' => ['Admin'],
            'module' => 'User',
        ], [
            'name_key' => 'user_create',
            'name' => 'Create User',
            'roles' => ['Admin'],
            'module' => 'User',
        ], [
            'name_key' => 'user_view',
            'name' => 'View User',
            'roles' => ['Admin'],
            'module' => 'User',
        ], [
            'name_key' => 'user_edit',
            'name' => 'Edit User',
            'roles' => ['Admin'],
            'module' => 'User',
        ], [
            'name_key' => 'user_delete',
            'name' => 'Delete User',
            'roles' => ['Admin'],
            'module' => 'User',
        ],[
            'name_key' => 'user_status_edit',
            'name' => 'Edit User Status',
            'roles' => ['Admin'],
            'module' => 'User',
        ],

        [
            'name_key' => 'member_list',
            'name' => 'All Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ],[
            'name_key' => 'member_import',
            'name' => 'Import Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ],[
            'name_key' => 'member_export',
            'name' => 'Export Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ], [
            'name_key' => 'member_create',
            'name' => 'Create Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ], [
            'name_key' => 'member_view',
            'name' => 'View Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ], [
            'name_key' => 'member_edit',
            'name' => 'Edit Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ], [
            'name_key' => 'member_delete',
            'name' => 'Delete Member',
            'roles' => ['Admin'],
            'module' => 'Member',
        ],[
            'name_key' => 'member_status_edit',
            'name' => 'Edit Member Status',
            'roles' => ['Admin'],
            'module' => 'Member',
        ],[
            'name_key' => 'member_doc_delete',
            'name' => 'Delete Member Document',
            'roles' => ['Admin'],
            'module' => 'Member',
        ],

        [
            'name_key' => 'data',
            'name' => 'Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ],[
            'name_key' => 'data_export',
            'name' => 'Export Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ], [
            'name_key' => 'data_create',
            'name' => 'Create Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ], [
            'name_key' => 'data_view',
            'name' => 'View Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ], [
            'name_key' => 'data_edit',
            'name' => 'Edit Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ], [
            'name_key' => 'data_delete',
            'name' => 'Delete Data',
            'roles' => ['Admin'],
            'module' => 'Data',
        ],[
            'name_key' => 'data_status_edit',
            'name' => 'Edit Data Status',
            'roles' => ['Admin'],
            'module' => 'Data',
        ],

        [
            'name_key' => 'resource',
            'name' => 'Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ],[
            'name_key' => 'resource_export',
            'name' => 'Export Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ], [
            'name_key' => 'resource_create',
            'name' => 'Create Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ], [
            'name_key' => 'resource_view',
            'name' => 'View Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ], [
            'name_key' => 'resource_edit',
            'name' => 'Edit Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ], [
            'name_key' => 'resource_delete',
            'name' => 'Delete Resource',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ],[
            'name_key' => 'resource_status_edit',
            'name' => 'Edit Resource Status',
            'roles' => ['Admin'],
            'module' => 'Resource',
        ],

        [
            'name_key' => 'media',
            'name' => 'Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ],[
            'name_key' => 'media_export',
            'name' => 'Export Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ], [
            'name_key' => 'media_create',
            'name' => 'Create Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ], [
            'name_key' => 'media_view',
            'name' => 'View Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ], [
            'name_key' => 'media_edit',
            'name' => 'Edit Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ], [
            'name_key' => 'media_delete',
            'name' => 'Delete Media',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ],[
            'name_key' => 'media_status_edit',
            'name' => 'Edit Media Status',
            'roles' => ['Admin'],
            'module' => 'Media Center',
        ],

        [
            'name_key' => 'membership',
            'name' => 'Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ],[
            'name_key' => 'membership_export',
            'name' => 'Export Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ], [
            'name_key' => 'membership_create',
            'name' => 'Create Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ], [
            'name_key' => 'membership_view',
            'name' => 'View Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ], [
            'name_key' => 'membership_edit',
            'name' => 'Edit Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ], [
            'name_key' => 'membership_delete',
            'name' => 'Delete Membership',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ],[
            'name_key' => 'membership_status_edit',
            'name' => 'Edit Membership Status',
            'roles' => ['Admin'],
            'module' => 'Membership',
        ],

        [
            'name_key' => 'about_us',
            'name' => 'About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ],[
            'name_key' => 'about_us_export',
            'name' => 'Export About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ], [
            'name_key' => 'about_us_create',
            'name' => 'Create About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ], [
            'name_key' => 'about_us_view',
            'name' => 'View About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ], [
            'name_key' => 'about_us_edit',
            'name' => 'Edit About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ], [
            'name_key' => 'about_us_delete',
            'name' => 'Delete About Us',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ],[
            'name_key' => 'about_us_status_edit',
            'name' => 'Edit About Us Status',
            'roles' => ['Admin'],
            'module' => 'About Us',
        ],

        [
            'name_key' => 'cms',
            'name' => 'CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ],[
            'name_key' => 'cms_export',
            'name' => 'Export CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ], [
            'name_key' => 'cms_create',
            'name' => 'Create CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ], [
            'name_key' => 'cms_view',
            'name' => 'View CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ], [
            'name_key' => 'cms_edit',
            'name' => 'Edit CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ], [
            'name_key' => 'cms_delete',
            'name' => 'Delete CMS',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ],[
            'name_key' => 'cms_status_edit',
            'name' => 'Edit CMS Status',
            'roles' => ['Admin'],
            'module' => 'CMS',
        ],

        [
            'name_key' => 'query',
            'name' => 'Query',
            'roles' => ['Admin'],
            'module' => 'Query',
        ],[
            'name_key' => 'query_export',
            'name' => 'Export Query',
            'roles' => ['Admin'],
            'module' => 'Query',
        ], [
            'name_key' => 'query_view',
            'name' => 'View Query',
            'roles' => ['Admin'],
            'module' => 'Query',
        ], [
            'name_key' => 'query_delete',
            'name' => 'Delete Query',
            'roles' => ['Admin'],
            'module' => 'Query',
        ],

        [
            'name_key' => 'role_list',
            'name' => 'All Roles',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ],[
            'name_key' => 'role_export',
            'name' => 'Export Role',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ], [
            'name_key' => 'role_create',
            'name' => 'Create Role',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ], [
            'name_key' => 'role_edit',
            'name' => 'Edit Role',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ], [
            'name_key' => 'role_delete',
            'name' => 'Delete Role',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ],[
            'name_key' => 'permission_list',
            'name' => 'Permission List',
            'roles' => ['Admin'],
            'module' => 'Authorization',
        ],

        [
            'name_key' => 'general_settings_edit',
            'name' => 'Edit General Settings',
            'roles' => ['Admin'],
            'module' => 'Settings',
        ],[
            'name_key' => 'email_settings_edit',
            'name' => 'Edit Email Settings',
            'roles' => ['Admin'],
            'module' => 'Settings',
        ],[
            'name_key' => 'contact_us_settings_edit',
            'name' => 'Edit Contact Us Settings',
            'roles' => ['Admin'],
            'module' => 'Settings',
        ],

        [
            'name_key' => 'notification',
            'name' => 'All Notifications',
            'roles' => ['Admin'],
            'module' => 'Notification',
        ], [
            'name_key' => 'notification_delete',
            'name' => 'Delete Notification',
            'roles' => ['Admin'],
            'module' => 'Notification',
        ],[
            'name_key' => 'notification_status_edit',
            'name' => 'Mark read',
            'roles' => ['Admin'],
            'module' => 'Notification',
        ]

    ],
];
