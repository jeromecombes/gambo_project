<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesRHController;
use App\Http\Controllers\CoursesRH2Controller;
use App\Http\Controllers\DateController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\HousingClosedController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\LockController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SessionController;
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

// Client 
Route::get('/client/{token}', [ClientController::class, 'index'])
    ->name('client.index');

// Client update
Route::post('/client', [ClientController::class, 'update'])
    ->name('client.update');

Route::group(['middleware' => ['auth', '2fa']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Check if session is going to expire
    Route::get('/session', [SessionController::class, 'get'])->name('session.get');

    // Admin home
    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('project.index');

    // Project Edit
    Route::get('/project/{id?}/{edit?}', [ProjectController::class, 'edit'])
        ->where('id', '\d+')
        ->where('edit', 'edit')
        ->name('project.edit');

    // Project Update
    Route::post('/project', [ProjectController::class, 'update'])
        ->name('project.update');

    // Project Destroy
    Route::delete('/project', [ProjectController::class, 'destroy'])
        ->name('project.delete');

    // Set the semester
    Route::post('/admin/semester', [AdminController::class, 'semester'])
        ->name('admin.semester');

    // Set the student list
    Route::post('/admin/students', [AdminController::class, 'students'])
        ->name('admin.students');

    // Student General Info
    Route::get('/student/{student?}/{edit?}', [StudentController::class, 'student_form'])
        ->where('student', '\d+')
        ->where('edit', 'edit')
        ->name('student.student_form');

    Route::post('/student', [StudentController::class, 'student_form_update'])
        ->name('student.student_form.update');

    // Student add
    Route::get('/student/create', [StudentController::class, 'create'])
        ->name('student.create');

    Route::put('/student', [StudentController::class, 'store'])
        ->name('student.store');

    // Student Housing
    Route::get('/housing/{student?}/{edit?}', [HousingController::class, 'student_form'])
        ->where('student', '\d+')
        ->where('edit', 'edit')
        ->name('housing.student_form');

    Route::post('/housing', [HousingController::class, 'student_form_update'])
        ->name('housing.student_form.update');

    Route::post('/housing_assignment', [HousingController::class, 'student_assignment'])
        ->name('housing.student_assignment');

    Route::post('/housing/accept_terms', [HousingController::class, 'accept_terms'])
        ->name('housing.accept_terms');

    // Student Univ registration
    Route::get('/univ_reg/{student?}/{edit?}', [UnivRegController::class, 'student_form'])
        ->where('student', '\d+')
        ->where('edit', 'edit')
        ->name('univ_reg.student_form');

    Route::post('/univ_reg', [UnivRegController::class, 'univ_reg_update'])
        ->name('univ_reg.univ_reg.update');

    Route::post('/univ_reg3', [UnivRegController::class, 'univ_reg3_update'])
        ->name('univ_reg.univ_reg3.update');

    Route::get('/univ_reg/export', [UnivRegController::class, 'export'])
        ->name('univ_reg.export');

    Route::get('/univ_reg/list', [UnivRegController::class, 'list'])
        ->name('univ_reg.list');

    // Courses
    Route::get('/courses/{student?}', [CourseController::class, 'index'])
        ->where('student', '\d+')
        ->name('courses.index');

    Route::post('/courses/reidhall/assignment', [CourseController::class, 'reidhall_assignment'])
        ->name('courses.reidhall.assignment');

    Route::post('/courses/reidhall/choices', [CourseController::class, 'reidhall_choices'])
        ->name('courses.reidhall.choices');

    // Local courses
    Route::get('/course/{id?}', [CourseController::class, 'local_edit'])
        ->where('id', '\d+')
        ->name('course.edit');

    Route::post('/course', [CourseController::class, 'local_update'])
        ->name('course.update');

    Route::delete('/course', [CourseController::class, 'local_destroy'])
        ->name('course.delete');

    Route::get('/course/{id}/students', [CourseController::class, 'local_students'])
        ->where('id', '\d+')
        ->name('course.students');

    Route::get('/courses/export', [CourseController::class, 'export'])
        ->name('courses.export');

    Route::get('/courses/choices/export', [CourseController::class, 'choices_export'])
        ->name('courses.choices.export');

    Route::post('/courses/lock', [CourseController::class, 'local_lock'])
        ->name('courses.lock');

    Route::post('/courses/publish', [CourseController::class, 'local_publish'])
        ->name('courses.publish');

    // University courses
    Route::get('/course/univ/{id?}/{edit?}', [CourseController::class, 'univ_edit'])
        ->where('edit', 'edit')
        ->where('id', '\d+')
        ->name('courses.univ.edit');

    Route::post('/courses/univ', [CourseController::class, 'univ_update'])
        ->name('courses.univ.update');

    Route::delete('/courses/univ', [CourseController::class, 'univ_destroy'])
        ->name('courses.univ.delete');

    Route::get('/courses/univ/export', [CourseController::class, 'univ_export'])
        ->name('courses.univ.export');

    Route::get('/courses/univ/link/{id}', [CourseController::class, 'univ_link'])
        ->where('id', '\d+')
        ->name('courses.univ.link');

    Route::get('/courses/home', [CourseController::class, 'home'])
        ->name('courses.home');

    Route::get('/tutoring', [TutoringController::class, 'edit'])
        ->name('tutoring.edit');

    Route::get('/tutoring/export', [TutoringController::class, 'export'])
        ->name('tutoring.export');

    Route::post('/tutoring/update', [TutoringController::class, 'update'])
        ->middleware('role:16')
        ->name('courses.tutoring.update');

    Route::get('/grades/{student?}/{edit?}', [GradeController::class, 'edit'])
        ->where('student', '\d+')
        ->where('edit', 'edit')
        ->name('grades.edit');

    Route::post('/grades/update', [GradeController::class, 'update'])
        ->name('grades.update');

    Route::get('/grades/home', [GradeController::class, 'home'])
        ->name('grades.home');

    Route::get('/grades/{univ}/{id}/{edit?}', [GradeController::class, 'list'])
        ->where('univ', 'local|univ')
        ->where('id', '\d+')
        ->where('edit', 'edit')
        ->name('grades.list');

    Route::post('/grades/list/update', [GradeController::class, 'list_update'])
        ->name('grades.list_update');

    Route::get('/grades/export', [GradeController::class, 'export'])
        ->name('grades.export');

    Route::get('/internship', [InternshipController::class, 'edit'])
        ->name('internship.edit');

    Route::get('/internship/export', [InternshipController::class, 'export'])
        ->name('internship.export');

    Route::post('/internship/update', [InternshipController::class, 'update'])
        ->name('internship.update');

    // Schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])
        ->middleware('semester')
        ->middleware('student.list')
        ->name('schedule.index');

    Route::get('/schedule/{student}', [ScheduleController::class, 'index'])
        ->middleware('semester')
        ->middleware('student.list')
        ->middleware('this.student')
        ->name('schedule.index.student');

    Route::get('/trip', [TripController::class, 'edit'])
        ->name('trip.edit');

    Route::post('/trip', [TripController::class, 'update'])
        ->name('trip.update');

    Route::get('/evaluations', [EvaluationController::class, 'index'])
        ->name('evaluations.index');

    Route::get('/evaluation/{form}/{id?}', [EvaluationController::class, 'form'])
        ->where('id', '\d+')
        ->name('evaluations.form');

    Route::post('/evaluations', [EvaluationController::class, 'update'])
        ->name('evaluations.update');

    Route::get('/evaluations/home', [EvaluationController::class, 'home'])
        ->name('evaluations.home');

    Route::get('/evaluations/{form}/table', [EvaluationController::class, 'table'])
        ->where('form', 'local|internship|linguistic|method|program|tutoring|univ')
        ->name('evaluations.table');

    Route::get('/evaluations/{form}', [EvaluationController::class, 'list'])
        ->where('form', 'local|internship|linguistic|method|program|tutoring|univ')
        ->name('evaluations.list');

    Route::post('/evaluations/enable', [EvaluationController::class, 'enable'])
        ->name('evaluations.enable');

    Route::get('/evaluations/who', [EvaluationController::class, 'who'])
        ->name('evaluations.who');

    Route::get('/semester', [SemesterController::class, 'index'])
        ->middleware('not.admin')
        ->name('semester.index');

    Route::post('/semester', [SemesterController::class, 'update'])
        ->middleware('not.admin')
        ->name('semester.update');

    Route::post('/lock', [LockController::class, 'ajaxLocker'])
        ->name('lock');

    Route::get('/account', [UserController::class, 'account'])
        ->name('account.index');

    Route::post('/password', [UserController::class, 'password'])
        ->name('password.update');

    Route::post('/notifications', [UserController::class, 'notifications'])
        ->name('notifications.update');

    // Admin Student list
    Route::get('/students', [StudentController::class, 'admin_index'])
        ->name('student.index');

    // Admin Student Delete
    Route::post('/students/delete', [StudentController::class, 'destroy'])
        ->name('student.destroy');

    // Admin students e-mail
    Route::post('/students/email', [StudentController::class, 'email'])
        ->name('student.email');

    // Admin students e-mail
    Route::post('/students/sendmail', [StudentController::class, 'sendmail'])
        ->name('student.sendmail');

    Route::get('/students/export', [StudentController::class, 'export'])
        ->name('student.export');

    // Admin students password
    Route::post('/students/password', [StudentController::class, 'password'])
        ->name('student.password');

    // Documents
    Route::get('/documents', [DocumentController::class, 'index'])
        ->middleware('student.list')
        ->name('document.index');

    Route::get('/documents/{student}', [DocumentController::class, 'index'])
        ->middleware('admin')
        ->where('student', '\d+')
        ->name('document.index');

    Route::get('/documents/add', [DocumentController::class, 'add'])
        ->name('document.add');

    Route::get('/documents/edit', [DocumentController::class, 'edit'])
        ->middleware('admin')
        ->name('document.edit');

    Route::put('/documents', [DocumentController::class, 'store'])
        ->name('document.store');

    Route::post('/documents', [DocumentController::class, 'update'])
        ->name('document.update');

    Route::delete('/documents', [DocumentController::class, 'destroy'])
        ->where('id', '\d+')
        ->name('document.destroy');

    Route::get('/show/{id}', [DocumentController::class, 'show'])
        ->name('document.show');

    // Housing
    Route::get('/housing/home', [HousingController::class, 'home'])
        ->name('housing.home');

    Route::get('/housing/requests', [HousingController::class, 'requests'])
        ->name('housing.requests');

    Route::get('/hosts', [HostController::class, 'index'])
        ->name('hosts.index');

    Route::post('/hosts/email', [HostController::class, 'email'])
        ->name('hosts.email');

    Route::post('/hosts/sendmail', [HostController::class, 'sendmail'])
        ->name('hosts.sendmail');

    Route::get('/hosts/export', [HostController::class, 'export'])
        ->name('hosts.export');

    Route::get('/host/{id}/{edit?}', [HostController::class, 'edit'])
        ->where('id', '\d+')
        ->where('edit', 'edit')
        ->name('host.edit');

    Route::get('/host', [HostController::class, 'create'])
        ->name('host.create');

    Route::post('/host', [HostController::class, 'update'])
        ->name('host.update');

    Route::delete('/host', [HostController::class, 'destroy'])
        ->name('host.delete');

    Route::get('/dates', [DateController::class, 'edit'])
        ->where('edit', 'edit')
        ->name('dates.edit');

    Route::post('/dates', [DateController::class, 'update'])
        ->name('dates.update');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/user/{id?}', [UserController::class, 'edit'])
        ->where('id', '\d+')
        ->name('user.edit');

    Route::post('/user', [UserController::class, 'update'])
        ->name('user.update');

    Route::delete('/user', [UserController::class, 'delete'])
        ->name('user.delete');

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
    Route::post('/housing/lock', [HousingClosedController::class, 'lock'])
        ->middleware('admin')
        ->name('housing.lock');

    // Unlock housing forms
    Route::post('/housing/unlock', [HousingClosedController::class, 'unlock'])
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

    // Tests
    Route::get('/test/form', [App\Http\Controllers\TestController::class, 'form'])
        ->middleware('admin')
        ->name('test.form');
});

// Auth routes
Auth::routes(['login' => false, 'register' => false]);

// Two Factor Authentication
Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');
