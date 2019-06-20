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

// Documents
Route::get('/documents', 'DocumentController@index')
    ->middleware('old.session')
    ->name('document.index');

Route::get('/documents/{student}', 'DocumentController@index')
    ->middleware('old.session')
    ->where('student', '[0-9]+')
    ->name('document.index');

Route::get('/documents/add', 'DocumentController@add')
    ->middleware('old.session')
    ->name('document.add');

Route::get('/documents/edit', 'DocumentController@edit')
    ->middleware('old.session')
    ->middleware('admin')
    ->name('document.edit');

Route::put('/documents', 'DocumentController@store')
    ->middleware('old.session')
    ->name('document.store');

Route::post('/documents', 'DocumentController@update')
    ->middleware('old.session')
    ->name('document.update');

Route::delete('/documents', 'DocumentController@destroy')
    ->where('id', '[0-9]+')
    ->middleware('old.session')
    ->name('document.destroy');

Route::get('/show/{id}', 'DocumentController@show')
    ->middleware('old.session')
    ->name('document.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// EXPORT Files : Decrypt and export files for given semester in storage/app/export/
Route::get('/export/{semester}', 'DocumentController@export_all')
    ->middleware('old.session')
    ->name('document.export');

// EXPORT Files and delete originals : Decrypt, export files for given semester in storage/app/export/ and delete originals
Route::get('/export/{semester}/{delete}', 'DocumentController@export_all')
    ->middleware('old.session')
    ->name('document.export_delete');
