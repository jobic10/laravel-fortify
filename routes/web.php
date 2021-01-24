<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/home', function () {
return view('home');
})->middleware(['auth','verified']);

Route::group(['middleware' => 'auth'], function(){
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student'], function(){
        Route::resource('lessons', App\Http\Controllers\Students\LessonController::class);
    });
    Route::group(['middleware' => 'role:staff', 'prefix' => 'staff', 'as' => 'staff'], function(){
        Route::resource('courses', App\Http\Controllers\Staff\CourseController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin'], function(){
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });
});

Route::get('/login/github', [LoginController::class, 'github'])->name('github.login');
Route::get('/login/github/redirect', [LoginController::class, 'githubRedirect'])->name('github.redirect');
