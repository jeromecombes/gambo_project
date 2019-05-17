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

Route::post('/documents', 'DocumentController@store')
    ->middleware('old.session')
    ->name('document.store');

Route::get('/show/{id}', 'DocumentController@show')
    ->middleware('old.session')
    ->name('document.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// TEST
Route::get('/convert', 'DocumentController@convert')->name('document.convert');

