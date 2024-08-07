<?php

return [
    'status' => [
        [
            'name' => 'Active',
            'value' => '1'
        ], [
            'name' => 'Not Active',
            'value' => '0'
        ]
    ],
    'roles' => ['Admin', 'Member', 'User'],
    'membership_type' => ['Corporate', 'Sectoral Corporate'],
    'permissions' => [
        [
            'name_key' => 'profile_view',
            'name' => 'View Profile',
            'roles' => ['Admin', 'Member', 'User']
        ], [
            'name_key' => 'profile_update',
            'name' => 'Update Profile',
            'roles' => ['Admin', 'Member', 'User']
        ], [
            'name_key' => 'profile_active_deactive',
            'name' => 'Activate/DeActivate Profile',
            'roles' => ['Member', 'User']
        ], [
            'name_key' => 'profile_delete',
            'name' => 'Delete Profile',
            'roles' => ['Member', 'User']
        ],

        [
            'name_key' => 'member_dashboard',
            'name' => 'Member Dashboard',
            'roles' => ['Member']
        ],

        [
            'name_key' => 'admin_dashboard',
            'name' => 'Admin Dashboard',
            'roles' => ['Admin', 'User']
        ],

        [
            'name_key' => 'user_list',
            'name' => 'All User',
            'roles' => ['Admin', 'User']
        ],[
            'name_key' => 'user_export',
            'name' => 'Export User',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'user_create',
            'name' => 'Create User',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'user_view',
            'name' => 'View User',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'user_edit',
            'name' => 'Edit User',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'user_delete',
            'name' => 'Delete User',
            'roles' => ['Admin', 'User']
        ],[
            'name_key' => 'user_status_edit',
            'name' => 'Edit User Status',
            'roles' => ['Admin', 'User']
        ],

        [
            'name_key' => 'member_list',
            'name' => 'All Member',
            'roles' => ['Admin', 'User']
        ],[
            'name_key' => 'member_export',
            'name' => 'Export Member',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'member_create',
            'name' => 'Create Member',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'member_view',
            'name' => 'View Member',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'member_edit',
            'name' => 'Edit Member',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'member_delete',
            'name' => 'Delete Member',
            'roles' => ['Admin', 'User']
        ],[
            'name_key' => 'member_status_edit',
            'name' => 'Edit Member Status',
            'roles' => ['Admin', 'User']
        ],

        [
            'name_key' => 'role_list',
            'name' => 'All Roles',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'role_create',
            'name' => 'Create Role',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'role_view',
            'name' => 'View Role',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'role_edit',
            'name' => 'Edit Role',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'role_delete',
            'name' => 'Delete Role',
            'roles' => ['Admin', 'User']
        ],

        // [
        //     'name_key' => 'cms',
        //     'name' => 'CMS',
        //     'roles' => ['Admin']
        // ], 
        // [
        //     'name_key' => 'cms_create',
        //     'name' => 'Create CMS',
        //     'roles' => ['Admin']
        // ], [
        //     'name_key' => 'cms_view',
        //     'name' => 'View CMS',
        //     'roles' => ['Admin']
        // ], 
        [
            'name_key' => 'cms_edit',
            'name' => 'Edit CMS',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'cms_delete',
            'name' => 'Delete CMS',
            'roles' => ['Admin', 'User']
        ],
    ],
];
