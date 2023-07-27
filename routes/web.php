<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Auth\VerificationController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
// Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');

// Route::get('/email/verify/need-verification', [VerificationController::class, 'notice'])->middleware(['auth'])->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
// Route::get('/email/verify/resend-verification', [VerificationController::class, 'send'])->middleware(['auth', 'throttle:6,1',])->name('verification.send');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::middleware(['auth', 'auth.session', 'verified'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::post('/pilih-unit', [DashboardController::class, 'pilihUnit'])->name('pilihUnit');
// });

Route::resource('/user', UserController::class)->middleware('admin');
Route::resource('/editprofile', ProfileController::class)->middleware('auth');

Route::resource('/clients', ClientController::class)->middleware('auth');

Route::resource('/products', ProductController::class)->middleware('auth');

Route::resource('/projects', ProjectController::class)->middleware('auth');
Route::post('/projects/upload', [ProjectController::class, 'upload'])->name('projects.upload')->middleware('auth');

Route::resource('/ticket', TicketController::class)->middleware('auth');
Route::get('/ticket/download/{id}', [TicketController::class, 'download'])->middleware('auth');
Route::get('/ticket/status/{id}', [TicketController::class, 'editStatus'])->middleware('auth');
Route::post('/ticket/status/{id}', [TicketController::class, 'updateStatus'])->middleware('auth');
Route::get('/ticket/open/{id}', [TicketController::class, 'openTicket'])->name('ticket.open')->middleware('auth');
Route::get('/ticket/close/{id}', [TicketController::class, 'closeTicket'])->name('ticket.close')->middleware('auth');


// Route::resource('/ticket/status', StatusController::class)->middleware('auth');
