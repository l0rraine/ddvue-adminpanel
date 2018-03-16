<?php
/*****************角色管理*****************/
Route::group(['prefix' => 'permission'], function () {
    $controller = config('ddvue.adminpanel.page_settings.permission.controller');
    Route::get('/', $controller . '@getIndex')->name('Ddvue.AdminPanel.permission.index');
    Route::get('indexJson', $controller . '@indexJson')->name('Ddvue.AdminPanel.permission.indexJson');
    Route::post('query', $controller . '@query')->name('Ddvue.AdminPanel.permission.query');
    Route::get('add', $controller . '@getAdd')->name('Ddvue.AdminPanel.permission.add');
    Route::post('add', $controller . '@postAdd')->name('Ddvue.AdminPanel.permission.add.post');
    Route::get('edit/{id}', $controller . '@getEdit')->name('Ddvue.AdminPanel.permission.edit');
    Route::post('edit', $controller . '@postEdit')->name('Ddvue.AdminPanel.permission.edit.post');
    Route::post('sort/save', $controller . '@doSaveSortId')->name('Ddvue.AdminPanel.permission.saveSort');
    Route::post('del', $controller . '@del')->name('Ddvue.AdminPanel.permission.del');
});