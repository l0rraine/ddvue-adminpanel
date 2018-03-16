<?php
/*****************角色管理*****************/
Route::group(['prefix' => 'role'], function () {
    $controller = config('ddvue.adminpanel.page_settings.role.controller');
    Route::get('/', $controller . '@getIndex')->name('Ddvue.AdminPanel.role.index');
    Route::get('indexJson', $controller . '@indexJson')->name('Ddvue.AdminPanel.role.indexJson');
    Route::post('query', $controller . '@query')->name('Ddvue.AdminPanel.role.query');
    Route::get('add', $controller . '@getAdd')->name('Ddvue.AdminPanel.role.add');
    Route::post('add', $controller . '@postAdd')->name('Ddvue.AdminPanel.role.add.post');
    Route::get('edit/{id}', $controller . '@getEdit')->name('Ddvue.AdminPanel.role.edit');
    Route::post('edit', $controller . '@postEdit')->name('Ddvue.AdminPanel.role.edit.post');
    Route::post('sort/save', $controller . '@doSaveSortId')->name('Ddvue.AdminPanel.role.saveSort');
    Route::post('del', $controller . '@del')->name('Ddvue.AdminPanel.role.del');
});