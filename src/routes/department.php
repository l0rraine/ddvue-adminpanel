<?php
/*****************单位管理*****************/
Route::group(['prefix' => 'department'], function () {
    $controller = config('ddvue.adminpanel.page_settings.department.controller');
    Route::get('/', $controller . '@getIndex')->name('Ddvue.AdminPanel.department.index');
    Route::get('indexJson', $controller . '@indexJson')->name('Ddvue.AdminPanel.department.indexJson');
    Route::get('add', $controller . '@getAdd')->name('Ddvue.AdminPanel.department.add');
    Route::post('add', $controller . '@postAdd')->name('Ddvue.AdminPanel.department.add.post');
    Route::get('edit/{id}', $controller . '@getEdit')->name('Ddvue.AdminPanel.department.edit');
    Route::post('edit', $controller . '@postEdit')->name('Ddvue.AdminPanel.department.edit.post');
    Route::post('sort/save', $controller . '@doSaveSortId')->name('Ddvue.AdminPanel.department.saveSort');
    Route::post('del', $controller . '@del')->name('Ddvue.AdminPanel.department.del');
});