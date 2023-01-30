<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('/user', UserController::class)->middleware('admin');
Route::resource('/editprofile', ProfileController::class)->middleware('auth');

Route::resource('/clients', ClientController::class)->middleware('auth');

Route::resource('/documents', DocumentsController::class);

Route::resource('/products', ProductController::class)->middleware('auth');

Route::resource('/projects', ProjectController::class)->middleware('auth');
Route::post('/projects/upload', [ProjectController::class, 'upload'])->name('projects.upload')->middleware('auth');
