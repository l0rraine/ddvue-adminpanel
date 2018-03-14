<?php
/*****************后台菜单管理*****************/
Route::group(['prefix' => 'menu','namespace'  => '\DDVue\AdminPanel\app\Http\Controllers'], function () {
    Route::get('/', 'AdminMenuController@getIndex')->name('Ddvue.AdminPanel.menu.index');
    Route::get('indexJson', 'AdminMenuController@indexJson')->name('Ddvue.AdminPanel.menu.indexJson');
    Route::get('add', 'AdminMenuController@getAdd')->name('Ddvue.AdminPanel.menu.add');
    Route::post('add', 'AdminMenuController@postAdd')->name('Ddvue.AdminPanel.menu.add.post');
    Route::get('edit/{id}', 'AdminMenuController@getEdit')->name('Ddvue.AdminPanel.menu.edit');
    Route::post('edit', 'AdminMenuController@postEdit')->name('Ddvue.AdminPanel.menu.edit.post');
    Route::post('sort/save', 'AdminMenuController@doSaveSortId')->name('Ddvue.AdminPanel.menu.saveSort');
    Route::post('del', 'AdminMenuController@del')->name('Ddvue.AdminPanel.menu.del');
    Route::post('assignPermission', 'AdminMenuController@assignPermission')->name('Ddvue.AdminPanel.menu.assignPermission');
});