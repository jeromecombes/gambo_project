<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesRHController;
use App\Http\Controllers\CoursesRH2Controller;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\HousingClosedController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnivRegController;
use App\Http\Controllers\UnivRegShowController;
use Illuminate\Support\Facades\Route;

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
Route::get('/admin2', [AdminController::class, 'index'])
    ->middleware('admin')
    ->name('admin.index');
// TODO Rename to admin when migration completed

// Set the semester
Route::post('/admin/semester', [AdminController::class, 'semester'])
    ->middleware('admin')
    ->name('admin.semester');

// Student General Info
Route::get('/student', [StudentController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->name('student.student_form');

Route::get('/student/{student}', [StudentController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->name('student.student_form_id');

Route::get('/student/{student}/{edit}', [StudentController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->where('edit', 'edit')
    ->name('student.student_form.edit');

Route::post('/student', [StudentController::class, 'student_form_update'])
    ->name('student.student_form.update');

// Student Housing
Route::get('/housing', [HousingController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('role:2')
    ->name('housing.student_form');

Route::get('/housing/{student}', [HousingController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:2')
    ->name('housing.student_form_id');

Route::get('/housing/{student}/{edit}', [HousingController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:7')
    ->where('edit', 'edit')
    ->name('housing.student_form.edit');

Route::post('/housing', [HousingController::class, 'student_form_update'])
    ->middleware('role:7')
    ->name('housing.student_form.update');

Route::post('/housing_assignment', [HousingController::class, 'student_assignment'])
    ->middleware('admin')
    ->middleware('role:7')
    ->name('housing.student_assignment');

// Student Univ registration
Route::get('/univ_reg', [UnivRegController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('role:17')
    ->name('univ_reg.student_form');

Route::get('/univ_reg/{student}', [UnivRegController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:17')
    ->name('univ_reg.student_form_id');

Route::get('/univ_reg/{student}/{edit}', [UnivRegController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:17')
    ->where('edit', 'edit')
    ->name('univ_reg.student_form.edit');

Route::post('/univ_reg', [UnivRegController::class, 'univ_reg_update'])
    ->middleware('role:17')
    ->name('univ_reg.univ_reg.update');

Route::post('/univ_reg3', [UnivRegController::class, 'univ_reg3_update'])
    ->middleware('role:17')
    ->name('univ_reg.univ_reg3.update');

// Courses
Route::get('/admin/courses', [CourseController::class, 'student_form'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('admin')
    ->middleware('role:23')
    ->name('admin.courses.student_form');

Route::post('/admin/courses/reidhall/assignment', [CourseController::class, 'reidhall_assignment'])
    ->middleware('role:23')
    ->name('admin.courses.reidhall.assignment');

// Admin Student list
Route::get('/students', [StudentController::class, 'admin_index'])
    ->middleware('admin')
    ->middleware('semester')
    ->name('student.index');

// Admin Student Delete
Route::post('/students/delete', [StudentController::class, 'destroy'])
    ->middleware('admin')
    ->name('student.destroy');

// Documents
Route::get('/documents', [DocumentController::class, 'index'])
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->name('document.index');

Route::get('/documents/{student}', [DocumentController::class, 'index'])
    ->middleware('admin')
    ->where('student', '[0-9]+')
    ->name('document.index');

Route::get('/documents/add', [DocumentController::class, 'add'])
    ->middleware('old.session')
    ->name('document.add');

Route::get('/documents/edit', [DocumentController::class, 'edit'])
    ->middleware('admin')
    ->name('document.edit');

Route::put('/documents', [DocumentController::class, 'store'])
    ->middleware('old.session')
    ->name('document.store');

Route::post('/documents', [DocumentController::class, 'update'])
    ->middleware('old.session')
    ->name('document.update');

Route::delete('/documents', [DocumentController::class, 'destroy'])
    ->where('id', '[0-9]+')
    ->middleware('old.session')
    ->name('document.destroy');

Route::get('/show/{id}', [DocumentController::class, 'show'])
    ->middleware('old.session')
    ->name('document.show');

// Housing
Route::get('/admin/housing', [HousingController::class, 'index'])
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('housing.index');

Route::get('/admin/housing/requests', [HousingController::class, 'requests'])
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('housing.requests');

Route::get('/admin/hosts', [HostController::class, 'index'])
    ->middleware('admin')
    ->middleware('semester')
    ->middleware('role:2')
    ->name('hosts.index');

// Lock RH Courses forms
Route::post('/admin/RHCourses/lock', [CoursesRHController::class, 'lock'])
    ->middleware('admin')
    ->name('RHCourses.lock');

// Unlock RH Courses forms
Route::post('/admin/RHCourses/unlock', [CoursesRHController::class, 'unlock'])
    ->middleware('admin')
    ->name('RHCourses.unlock');

// Show RH Courses affectations
Route::post('/admin/RHCourses/show', [CoursesRH2Controller::class, 'lock'])
    ->middleware('admin')
    ->name('RHCourses.show');

// Hide RH Courses
Route::post('/admin/RHCourses/hide', [CoursesRH2Controller::class, 'unlock'])
    ->middleware('admin')
    ->name('RHCourses.hide');

// Show Univ. Reg.
Route::post('/admin/UnivReg/show', [UnivRegShowController::class, 'lock'])
    ->middleware('admin')
    ->name('UnivReg.show');

// Hide Univ. Reg.
Route::post('/admin/UnivReg/hide', [UnivRegShowController::class, 'unlock'])
    ->middleware('admin')
    ->name('UnivReg.hide');

// Lock housing forms
Route::post('/admin/housing/lock', [HousingClosedController::class, 'lock'])
    ->middleware('admin')
    ->name('housing.lock');

// Unlock housing forms
Route::post('/admin/housing/unlock', [HousingClosedController::class, 'unlock'])
    ->middleware('admin')
    ->name('housing.unlock');

Route::get('/logout', [MyAuthController::class, 'logout'])->name('mylogout');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// EXPORT Files : Decrypt and export files for given semester in storage/app/export/
Route::get('/export/{semester}', [DocumentController::class, 'export_all'])
    ->middleware('admin')
    ->name('document.export');

// EXPORT Files and delete originals : Decrypt, export files for given semester in storage/app/export/ and delete originals
Route::get('/export/{semester}/{delete}', [DocumentController::class, 'export_all'])
    ->middleware('admin')
    ->name('document.export_delete');
