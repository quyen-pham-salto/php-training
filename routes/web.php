<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login_exec', [LoginController::class, 'loginExec']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/signup', [LoginController::class, 'signup'])->name('signup');
Route::post('/signup_exec', [LoginController::class, 'signupExec']);

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/user/profile/{userID}/{password}', [HomeController::class, 'profile']);
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/create', [BlogController::class, 'create']);
    Route::post('/blog/create/exec', [BlogController::class, 'createExec']);
    Route::get('/blog/detail/{blogID}', [BlogController::class, 'detail']);
    Route::post('/blog/detail/comment_exec/{blogID}', [BlogController::class, 'commentExec']);
    Route::get('/blog/update/{blogID}', [BlogController::class, 'update']);
    Route::post('/blog/update/exec/{blogID}', [BlogController::class, 'updateExec']);
    Route::get('/blog/delete/exec/{blogID}', [BlogController::class, 'deleteExec']);
});