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
    ->middleware('admin')
    ->name('admin.index');
// TODO Rename to admin when migration completed

// Set the semester
Route::post('/admin/semester', 'AdminController@semester')
    ->middleware('admin')
    ->name('admin.semester');

// Admin Student General Info
Route::get('/student', 'StudentController@general')
    ->middleware('admin')
    ->middleware('semester')
    ->name('student.general');

Route::get('/student/{student}', 'StudentController@general')
    ->middleware('admin')
    ->middleware('semester')
    ->name('student.general');

Route::get('/student/{student}/{edit}', 'StudentController@general')
    ->middleware('admin')
    ->middleware('semester')
    ->where('edit', 'edit')
    ->name('student.general.edit');

Route::post('/student', 'StudentController@general_update')
    ->name('student.general.update');

// Admin Student list
Route::get('/admin/students', 'StudentController@admin_index')
    ->middleware('admin')
    ->middleware('semester')
    ->name('student.index');

// Admin Student Delete
Route::post('/admin/students/delete', 'StudentController@destroy')
    ->middleware('admin')
    ->name('student.destroy');

// Documents
Route::get('/documents', 'DocumentController@index')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->name('document.index');

Route::get('/documents/{student}', 'DocumentController@index')
    ->middleware('admin')
    ->where('student', '[0-9]+')
    ->name('document.index');

Route::get('/documents/add', 'DocumentController@add')
    ->middleware('old.session')
    ->name('document.add');

Route::get('/documents/edit', 'DocumentController@edit')
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
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('housing.index');

Route::get('/admin/housing/requests', 'HousingController@requests')
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('housing.requests');

Route::get('/admin/hosts', 'HostController@index')
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('hosts.index');

// Lock RH Courses forms
Route::post('/admin/RHCourses/lock', 'CoursesRHController@lock')
    ->middleware('admin')
    ->name('RHCourses.lock');

// Unlock RH Courses forms
Route::post('/admin/RHCourses/unlock', 'CoursesRHController@unlock')
    ->middleware('admin')
    ->name('RHCourses.unlock');

// Show RH Courses affectations
Route::post('/admin/RHCourses/show', 'CoursesRH2Controller@lock')
    ->middleware('admin')
    ->name('RHCourses.show');

// Hide RH Courses
Route::post('/admin/RHCourses/hide', 'CoursesRH2Controller@unlock')
    ->middleware('admin')
    ->name('RHCourses.hide');

// Show Univ. Reg.
Route::post('/admin/UnivReg/show', 'UnivRegShowController@lock')
    ->middleware('admin')
    ->name('UnivReg.show');

// Hide Univ. Reg.
Route::post('/admin/UnivReg/hide', 'UnivRegShowController@unlock')
    ->middleware('admin')
    ->name('UnivReg.hide');

// Lock housing forms
Route::post('/admin/housing/lock', 'HousingClosedController@lock')
    ->middleware('admin')
    ->name('housing.lock');

// Unlock housing forms
Route::post('/admin/housing/unlock', 'HousingClosedController@unlock')
    ->middleware('admin')
    ->name('housing.unlock');

Route::get('/logout', 'MyAuthController@logout')->name('mylogout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// EXPORT Files : Decrypt and export files for given semester in storage/app/export/
Route::get('/export/{semester}', 'DocumentController@export_all')
    ->middleware('admin')
    ->name('document.export');

// EXPORT Files and delete originals : Decrypt, export files for given semester in storage/app/export/ and delete originals
Route::get('/export/{semester}/{delete}', 'DocumentController@export_all')
    ->middleware('admin')
    ->name('document.export_delete');
