<?php
/*****************登录相关路由*****************/
Route::get('/ldaplogin', 'Auth\LdapLoginController@showLoginForm')->name('DDVue.AdminPanel.ldaplogin');
Route::post('/ldaplogin', 'Auth\LdapLoginController@login')->name('DDVue.AdminPanel.ldaplogin');

Route::get('/namelogin', 'Auth\NameLoginController@showLoginForm')->name('DDVue.AdminPanel.namelogin');
Route::post('/namelogin', 'Auth\NameLoginController@login')->name('DDVue.AdminPanel.namelogin');

Route::post('/logout','AdminPanelController@logout')->name('DDVue.AdminPanel.logout');