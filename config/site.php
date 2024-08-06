<?php

return [
    'status' => [
        [
            'name' => 'Active',
            'id' => '1'
        ], [
            'name' => 'Not Active',
            'id' => '0'
        ]
    ],
    'roles' => ['Admin', 'User'],
    'permissions' => [
        [
            'name_key' => 'profile_view',
            'name' => 'View Profile',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'profile_update',
            'name' => 'Update Profile',
            'roles' => ['Admin', 'User']
        ], [
            'name_key' => 'profile_active_deactive',
            'name' => 'Activate/DeActivate Profile',
            'roles' => ['User']
        ], [
            'name_key' => 'profile_delete',
            'name' => 'Delete Profile',
            'roles' => ['User']
        ],

        [
            'name_key' => 'user_dashboard',
            'name' => 'User Dashboard',
            'roles' => ['User']
        ],

        [
            'name_key' => 'admin_dashboard',
            'name' => 'Admin Dashboard',
            'roles' => ['Admin']
        ],

        [
            'name_key' => 'user_list',
            'name' => 'All User',
            'roles' => ['Admin']
        ], [
            'name_key' => 'user_create',
            'name' => 'Create User',
            'roles' => ['Admin']
        ], [
            'name_key' => 'user_view',
            'name' => 'View User',
            'roles' => ['Admin']
        ], [
            'name_key' => 'user_edit',
            'name' => 'Edit User',
            'roles' => ['Admin']
        ], [
            'name_key' => 'user_delete',
            'name' => 'Delete User',
            'roles' => ['Admin']
        ],

        [
            'name_key' => 'role_list',
            'name' => 'All Roles',
            'roles' => ['Admin']
        ], [
            'name_key' => 'role_create',
            'name' => 'Create Role',
            'roles' => ['Admin']
        ], [
            'name_key' => 'role_view',
            'name' => 'View Role',
            'roles' => ['Admin']
        ], [
            'name_key' => 'role_edit',
            'name' => 'Edit Role',
            'roles' => ['Admin']
        ], [
            'name_key' => 'role_delete',
            'name' => 'Delete Role',
            'roles' => ['Admin']
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
            'roles' => ['Admin']
        ], [
            'name_key' => 'cms_delete',
            'name' => 'Delete CMS',
            'roles' => ['Admin']
        ],
    ],
];
