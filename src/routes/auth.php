<?php
/*****************登录相关路由*****************/
Route::get('/ldaplogin', 'Auth\LdapLoginController@showLoginForm')->name('Ddvue.AdminPanel.ldaplogin');
Route::post('/ldaplogin', 'Auth\LdapLoginController@login')->name('Ddvue.AdminPanel.ldaplogin');

Route::get('/namelogin', 'Auth\NameLoginController@showLoginForm')->name('Ddvue.AdminPanel.namelogin');
Route::post('/namelogin', 'Auth\NameLoginController@login')->name('Ddvue.AdminPanel.namelogin');

Route::post('/logout','AdminPanelController@logout')->name('Ddvue.AdminPanel.logout');
