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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/locale/{locale}', 'LanguageController@setLocale')->name('setLocale');

/*
|--------------------------------------------------------------------------
| Archives Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the archive 
|
*/
Route::resource('archive', 'ArchiveController');

/*
|--------------------------------------------------------------------------
| Organizations Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the Organization 
|
*/
Route::resource('organization', 'OrganizationController');

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
Route::resource('media', 'MediaController');