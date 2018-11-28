<?php

return [
    'dashboard_name' => '后台标题',
    'url_prefix'     => '/admin',
    'menu_model'     => \DDVue\AdminPanel\app\Models\DdvueMenu::class,

    'auth'          => [
        'admin_auth_middleware' => 'admin.auth:ddvue_ldap',//ddvue_ldap,ddvue_db//['admin.auth:admin'],
        'user_model'            => \DDVue\AdminPanel\app\Models\DdvLdapUser::class,
        'type'                  => 'ldap', //ldap, db or mix
    ],
    'page_settings' => [
        'user' => [
            'enabled'    => true,
            'controller' => \DDVue\AdminPanel\app\Http\Controllers\UserController::class,
            'model'      => \DDVue\AdminPanel\app\Models\DdvLdapUser::class,
            'view'       => 'ddvue.adminpanel::pages.user'
        ],
        'role' => [
            'enabled'    => true,
            'controller' => \DDVue\AdminPanel\app\Http\Controllers\RoleController::class,
            'model'      => \DDVue\AdminPanel\app\Models\DdvRole::class,
            'view'       => 'ddvue.adminpanel::pages.role'
        ],
        'permission' => [
            'enabled'    => true,
            'controller' => \DDVue\AdminPanel\app\Http\Controllers\PermissionController::class,
            'model'      => \DDVue\AdminPanel\app\Models\DdvPermission::class,
            'view'       => 'ddvue.adminpanel::pages.permission'
        ],
        'department' => [
            'enabled'    => true,
            'controller' => \DDVue\AdminPanel\app\Http\Controllers\DepartmentController::class,
            'model'      => \DDVue\AdminPanel\app\Models\DdvDepartment::class,
            'view'       => 'ddvue.adminpanel::pages.department'
        ]
    ]

];
