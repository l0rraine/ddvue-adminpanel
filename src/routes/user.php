<?php
/*****************用户管理*****************/
Route::group(['prefix' => 'user'], function () {
    $controller = config('ddvue.adminpanel.page_settings.user.controller');
    Route::get('/', $controller . '@getIndex')->name('Ddvue.AdminPanel.user.index');
    Route::get('indexJson', $controller . '@indexJson')->name('Ddvue.AdminPanel.user.indexJson');
    Route::get('add', $controller . '@getAdd')->name('Ddvue.AdminPanel.user.add');
    Route::post('add', $controller . '@postAdd')->name('Ddvue.AdminPanel.user.add.post');
    Route::get('edit/{id}', $controller . '@getEdit')->name('Ddvue.AdminPanel.user.edit');
    Route::post('edit', $controller . '@postEdit')->name('Ddvue.AdminPanel.user.edit.post');
    Route::post('sort/save', $controller . '@doSaveSortId')->name('Ddvue.AdminPanel.user.saveSort');
    Route::post('del', $controller . '@del')->name('Ddvue.AdminPanel.user.del');
    Route::get('changepassword/{id}', $controller . '@changePassword')->name('Ddvue.AdminPanel.user.changepassword');
    Route::post('changepassword', $controller . '@doChange')->name('Ddvue.AdminPanel.user.changepassword');
});