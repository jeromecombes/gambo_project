<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesRHController;
use App\Http\Controllers\CoursesRH2Controller;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\HousingClosedController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\LockController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TutoringController;
use App\Http\Controllers\UnivRegController;
use App\Http\Controllers\UnivRegShowController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');


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
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->name('student.student_form');

Route::get('/student/{student}', [StudentController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->name('student.student_form_id');

Route::get('/student/{student}/{edit}', [StudentController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('this.student')
    ->where('edit', 'edit')
    ->name('student.student_form.edit');

Route::post('/student', [StudentController::class, 'student_form_update'])
    ->middleware('auth')
    ->name('student.student_form.update');

// Student Housing
Route::get('/housing', [HousingController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:2')
    ->name('housing.student_form');

Route::get('/housing/{student}', [HousingController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:2')
    ->name('housing.student_form_id');

Route::get('/housing/{student}/{edit}', [HousingController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:7')
    ->where('edit', 'edit')
    ->name('housing.student_form.edit');

Route::post('/housing', [HousingController::class, 'student_form_update'])
    ->middleware('auth')
    ->middleware('role:7')
    ->name('housing.student_form.update');

Route::post('/housing_assignment', [HousingController::class, 'student_assignment'])
    ->middleware('admin')
    ->middleware('role:7')
    ->name('housing.student_assignment');

// Student Univ registration
Route::get('/univ_reg', [UnivRegController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:17')
    ->name('univ_reg.student_form');

Route::get('/univ_reg/{student}', [UnivRegController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:17')
    ->name('univ_reg.student_form_id');

Route::get('/univ_reg/{student}/{edit}', [UnivRegController::class, 'student_form'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:17')
    ->where('edit', 'edit')
    ->name('univ_reg.student_form.edit');

Route::post('/univ_reg', [UnivRegController::class, 'univ_reg_update'])
    ->middleware('auth')
    ->middleware('role:17')
    ->name('univ_reg.univ_reg.update');

Route::post('/univ_reg3', [UnivRegController::class, 'univ_reg3_update'])
    ->middleware('auth')
    ->middleware('role:17')
    ->name('univ_reg.univ_reg3.update');

// Courses
Route::get('/courses', [CourseController::class, 'index'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:23')
    ->name('courses.index');

Route::get('/courses/{student}', [CourseController::class, 'index'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->middleware('role:23')
    ->name('courses.student_form_id');

Route::post('/courses/reidhall/assignment', [CourseController::class, 'reidhall_assignment'])
    ->middleware('admin')
    ->middleware('role:23')
    ->name('courses.reidhall.assignment');

Route::post('/courses/reidhall/choices', [CourseController::class, 'reidhall_choices'])
    ->name('courses.reidhall.choices');

Route::get('/course/univ/{add}', [CourseController::class, 'univ_edit'])
    ->where('add', 'add')
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:23')
    ->name('courses.univ.add');

Route::get('/course/univ/{id}/{edit}', [CourseController::class, 'univ_edit'])
    ->where('edit', 'edit')
    ->where('id', '[0-9]+')
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:23')
    ->name('courses.univ.edit');

Route::post('/courses/univ/update', [CourseController::class, 'univ_update'])
    ->middleware('role:16')
    ->name('courses.univ.update');

Route::get('/tutoring', [TutoringController::class, 'edit'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:16')
    ->name('tutoring.edit');

Route::post('/tutoring/update', [TutoringController::class, 'update'])
    ->middleware('role:16')
    ->name('courses.tutoring.update');

Route::get('/grades', [GradeController::class, 'edit'])
    ->middleware('admin')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->middleware('semester')
    ->middleware('role:18|19|20')
    ->name('grades.show');

Route::get('/grades/{student}', [GradeController::class, 'edit'])
    ->where('student', '[0-9]+')
    ->middleware('admin')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:18|19|20')
    ->name('grades.edit');

Route::get('/grades/{edit}', [GradeController::class, 'edit'])
    ->where('edit', 'edit')
    ->middleware('admin')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:18|19')
    ->name('grades.edit');

Route::post('/grades/update', [GradeController::class, 'update'])
    ->middleware('admin')
    ->middleware('role:18|19')
    ->name('grades.update');

Route::get('/internship', [InternshipController::class, 'edit'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('role:16')
    ->name('internship.edit');

Route::post('/internship/update', [InternshipController::class, 'update'])
    ->middleware('role:16')
    ->name('internship.update');

// Schedule
Route::get('/schedule', [ScheduleController::class, 'index'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->name('schedule.index');

Route::get('/schedule/{student}', [ScheduleController::class, 'index'])
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('semester')
    ->middleware('student.list')
    ->middleware('this.student')
    ->name('schedule.index.student');

Route::get('/trip', [TripController::class, 'edit'])
    ->middleware('auth')
    ->name('trip.edit');

Route::post('/trip', [TripController::class, 'update'])
    ->middleware('auth')
    ->name('trip.update');

Route::get('/evaluations', [EvaluationController::class, 'index'])
    ->middleware('auth')
    ->middleware('not.admin')
    ->middleware('semester')
    ->name('evaluations.index');

Route::get('/evaluation/{form}/{id?}', [EvaluationController::class, 'form'])
    ->where('id', '[0-9]+')
    ->middleware('auth')
    ->middleware('semester')
    ->name('evaluation.form');

Route::post('/evaluations', [EvaluationController::class, 'update'])
    ->middleware('auth')
    ->middleware('not.admin')
    ->middleware('semester')
    ->name('evaluations.update');

Route::get('/semester', [SemesterController::class, 'index'])
    ->middleware('auth')
    ->middleware('not.admin')
    ->name('semester.index');

Route::post('/semester', [SemesterController::class, 'update'])
    ->middleware('auth')
    ->middleware('not.admin')
    ->name('semester.update');

Route::post('/lock', [LockController::class, 'ajaxLocker'])
    ->middleware('admin')
    ->name('lock');

Route::get('/account', [UserController::class, 'account'])
    ->name('account.index');

Route::post('/password', [UserController::class, 'password'])
    ->name('password.update');

Route::post('/notifications', [UserController::class, 'notifications'])
    ->name('notifications.update');

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
    ->middleware('auth')
    ->middleware('old.session')
    ->middleware('old.student')
    ->middleware('student.list')
    ->name('document.index');

Route::get('/documents/{student}', [DocumentController::class, 'index'])
    ->middleware('admin')
    ->where('student', '[0-9]+')
    ->name('document.index');

Route::get('/documents/add', [DocumentController::class, 'add'])
    ->middleware('auth')
    ->middleware('old.session')
    ->name('document.add');

Route::get('/documents/edit', [DocumentController::class, 'edit'])
    ->middleware('admin')
    ->name('document.edit');

Route::put('/documents', [DocumentController::class, 'store'])
    ->middleware('auth')
    ->middleware('old.session')
    ->name('document.store');

Route::post('/documents', [DocumentController::class, 'update'])
    ->middleware('auth')
    ->middleware('old.session')
    ->name('document.update');

Route::delete('/documents', [DocumentController::class, 'destroy'])
    ->middleware('auth')
    ->where('id', '[0-9]+')
    ->middleware('old.session')
    ->name('document.destroy');

Route::get('/show/{id}', [DocumentController::class, 'show'])
    ->middleware('auth')
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

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/user/{id?}', [UserController::class, 'edit'])
    ->where('id', '[0-9]+')
    ->name('user.edit');

Route::post('/user', [UserController::class, 'update'])
    ->name('user.update');

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

// EXPORT Files : Decrypt and export files for given semester in storage/app/export/
Route::get('/export/{semester}', [DocumentController::class, 'export_all'])
    ->middleware('admin')
    ->name('document.export');

// EXPORT Files and delete originals : Decrypt, export files for given semester in storage/app/export/ and delete originals
Route::get('/export/{semester}/{delete}', [DocumentController::class, 'export_all'])
    ->middleware('admin')
    ->name('document.export_delete');
