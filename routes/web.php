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

// Admin home
Route::get('/admin2', 'AdminController@index')
    ->middleware('old.session')
    ->middleware('old.admin')
    ->middleware('old.access')
    ->middleware('admin')
    ->name('admin.index');
// TODO Rename to admin when migration completed

// Set the semester
Route::post('/admin/semester', 'AdminController@semester')
    ->middleware('old.session')
    ->middleware('old.admin')
    ->middleware('old.access')
    ->middleware('admin')
    ->name('admin.semester');

// Admin Student list
Route::get('/admin/students', 'StudentController@admin_index')
    ->middleware('old.session')
    ->middleware('old.admin')
    ->middleware('old.access')
    ->middleware('admin')
    ->name('student.index');

// Admin Student Delete
Route::post('/admin/students/delete', 'StudentController@destroy')
    ->middleware('old.session')
    ->middleware('old.admin')
    ->middleware('old.access')
    ->middleware('admin')
    ->name('student.destroy');

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

// Housing
Route::get('/admin/housing', 'HousingController@index')
    ->middleware('old.session')
    ->name('housing.index');

Route::get('/admin/hosts', 'HostController@index')
    ->middleware('old.session')
    ->name('hosts.index');

// Lock RH Courses forms
Route::post('/admin/RHCourses/lock', 'CoursesRHController@lock')
    ->middleware('old.session')
    ->name('RHCourses.lock');

// Unlock RH Courses forms
Route::post('/admin/RHCourses/unlock', 'CoursesRHController@unlock')
    ->middleware('old.session')
    ->name('RHCourses.unlock');

// Show RH Courses affectations
Route::post('/admin/RHCourses/show', 'CoursesRH2Controller@lock')
    ->middleware('old.session')
    ->name('RHCourses.show');

// Hide RH Courses
Route::post('/admin/RHCourses/hide', 'CoursesRH2Controller@unlock')
    ->middleware('old.session')
    ->name('RHCourses.hide');

// Show Univ. Reg.
Route::post('/admin/UnivReg/show', 'UnivRegShowController@lock')
    ->middleware('old.session')
    ->name('UnivReg.show');

// Hide Univ. Reg.
Route::post('/admin/UnivReg/hide', 'UnivRegShowController@unlock')
    ->middleware('old.session')
    ->name('UnivReg.hide');

// Lock housing forms
Route::post('/admin/housing/lock', 'HousingClosedController@lock')
    ->middleware('old.session')
    ->name('housing.lock');

// Unlock housing forms
Route::post('/admin/housing/unlock', 'HousingClosedController@unlock')
    ->middleware('old.session')
    ->name('housing.unlock');

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
