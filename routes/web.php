<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/locale/{locale}', 'LanguageController@setLocale')->name('setLocale');

/*
|--------------------------------------------------------------------------
| Folders Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the archive 
|
*/
Route::resource('folder', 'FolderController');
Route::get('folders/trash', 'FolderController@trash')->name('folder.trash');


/*
|--------------------------------------------------------------------------
| Organizations Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the Organization 
|
*/
Route::resource('organization', 'OrganizationController', ['except' => [
     'edit'
]]);
Route::get('organizations', 'OrganizationController@getAllApi');


/*
|--------------------------------------------------------------------------
| Files Routes (Resource)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the File 
|
*/
Route::resource('file', 'FileController');

/*
|--------------------------------------------------------------------------
| Media Manager Routes (Resource)
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the File 
|
*/
Route::resource('document', 'DocumentController', ['except' => [
     'edit'
]]);
Route::get('documents/trash', 'DocumentController@trash')->name('document.trash');
Route::get('documents', 'DocumentController@getApi');
Route::post('document/{document}/email', 'DocumentController@email');

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the User 
|
*/
Route::resource('user', 'UserController', ['only' => [
    'index', 'store','update', 'destroy'
]]);
Route::get('user/auth', 'UserController@getAuthUser');
Route::get('users', 'UserController@getAllApi');
Route::get('logout', 'UserController@logout');
Route::get('user/{id}/documents', 'UserController@index');

/*
|--------------------------------------------------------------------------
| Trash Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the User 
|
*/
Route::get('trash/document/{id}/restore', 'TrashController@restoreDocument');


