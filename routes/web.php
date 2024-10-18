<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
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

    // Project home
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

    // Users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/user/{id?}', [UserController::class, 'edit'])
        ->where('id', '\d+')
        ->name('user.edit');

    Route::post('/user', [UserController::class, 'update'])
        ->name('user.update');

    Route::delete('/user', [UserController::class, 'delete'])
        ->name('user.delete');

    // Account
    Route::get('/account', [UserController::class, 'account'])
        ->name('account.index');

    // Notifications
    Route::post('/notifications', [UserController::class, 'notifications'])
        ->name('notifications.update');

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
