<?php
/*****************后台菜单管理*****************/
Route::group(['prefix' => 'excel','namespace'  => '\DDVue\AdminPanel\app\Http\Controllers'], function () {
    Route::get('/', 'ExcelController@getIndex')->name('Ddvue.AdminPanel.excel.index');
    Route::post('/upload', 'ExcelController@upload')->name('Ddvue.AdminPanel.excel.upload');
});