<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\File;

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

// Define the 'users.index' route outside the group
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/dashboard', AdminController::class)->name('admin.dashboard');

    Route::get('/user/dashboard', function(){
        $files = File::all();
        return view('user.dashboard', compact('files'));
    })->name('user.dashboard');

    // User management routes
    Route::resource('users', UserController::class)->except([
        'store', 'update' // Exclude the default store and update routes
    ]);
	Route::get('/user-management', [UserController::class, 'index'])->name('user.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/search', [SoftwareController::class, 'search'])->name('search');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);

    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');
    
    Route::resource('/file', FileController::class);
    Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy');
    Route::post('/file/{id}', [FileController::class, 'update'])->name('file.update');

    Route::post('/upload-document', [FileController::class, 'uploadDocument'])->name('upload-document');
    Route::get('/download/{id}', [FileController::class, 'download'])->name('download');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

    Route::get('/login', function () {
        return view('session/login-session');
    })->name('login');
});
