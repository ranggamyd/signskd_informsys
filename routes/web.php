<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SKDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SignedSKDController;

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

// Auth
Auth::routes();

// Dashboard
Route::redirect('/', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// Patient
Route::resource('/patient', PatientController::class);
Route::get('/patient/create_skd/{id}', [PatientController::class, 'create_skd']);
// Patient
Route::resource('/partner', PartnerController::class);
// Doctor
Route::resource('/doctor', DoctorController::class);
// SKD
Route::resource('/skd', SKDController::class);
Route::get('/skd/sign_skd/{id}', [SKDController::class, 'sign_skd']);
// SignedSKD
Route::resource('/signed_skd', SignedSKDController::class);
Route::get('/signed_skd/check/{hash}', [SignedSKDController::class, 'check'])->name('signed_skd.check');
Route::get('/signed_skd/failed', [SignedSKDController::class, 'failed'])->name('signed_skd.failed');

// User
Route::resource('/user', UserController::class);
