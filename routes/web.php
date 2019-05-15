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

Route::get('/documents', 'DocumentController@index')->middleware('old.session')->name('document.index');
Route::get('/documents/edit', 'DocumentController@edit')->middleware('old.session')->name('document.edit');
Route::post('/documents', 'DocumentController@store')->middleware('old.session')->name('document.store');
Route::get('/preview/{id}', 'DocumentController@preview')->middleware('old.session')->name('document.preview');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
