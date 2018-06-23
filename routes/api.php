<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('data/master/search', 'MasterController@master');

Route::post('users/search', 'UserController@search');
Route::post('user/create', 'UserController@create');
Route::post('user/update', 'UserController@update');
Route::post('user/delete', 'UserController@delete');
Route::post('user/recover', 'UserController@recover');

Route::post('role/create', 'RoleController@create');
Route::post('role/update', 'RoleController@update');
Route::post('role/delete', 'RoleController@delete');

//

Route::post('auth/refresh', 'AuthController@refresh');
Route::post('auth/check', 'AuthController@handleCheck');

Route::post('store/datasource', 'StoreController@getDataSource');

Route::post('form/select/options', 'FormController@getSelectOptions');

Route::post('data/view/search', 'DataController@search');

Route::post('data/validate', 'ValidationController@validation');

Route::post('data/export', 'DataController@export');
Route::post('data/upload', 'DataController@upload');

Route::post('data/search', 'DataController@search');
Route::post('data/create', 'DataController@create');
Route::post('data/update', 'DataController@update');
Route::post('data/batch/update', 'DataController@batchUpdate');

Route::post('data/records/search', 'DataController@records');

Route::post('operation/confirm', 'OperationController@confirm');
Route::post('records/search', 'RecordController@search');

Route::post('schema/run', 'SchemaController@run');

Route::post('/test', 'TestController@test');
