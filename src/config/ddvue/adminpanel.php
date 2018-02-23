<?php

return [
    'dashboard_name' => '请输入后台标题',
    'title' => 'Title',
    'footer_copyright' => 'copyright',
    'url_prefix' => 'admin',
    'use_in_iframe' => true,
    'iframe_id' => 'iframe',
    'left_side_bar_include_file' => 'adminpanel::layouts.left_sidebar',

    'auth' => [
        'admin_auth_middleware' => 'admin.auth:ddvue_ldap,ddvue_db',//['admin.auth:admin'],
        'user_model'=> \App\Models\User::class,
        'type'=> 'mix', //ldap, db or mix
    ]
];
