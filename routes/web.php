<?php

use Illuminate\Foundation\Application;
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
Auth::routes();
Route::post('resetpasswordemail', [App\Http\Controllers\Auth\ResetPasswordController::class, 'forgotPasswordSendEmail'])->name('resetpasswordemail');
Route::get('reset-password/{token}/{ismobile?}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showPasswordResetForm']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('reset-password');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index']);
Route::redirect('/dashboard', 'admin/dashboard');
Route::get('registration-therapist', [App\Http\Controllers\Admin\TherapistController::class, 'registrationTherapist'])->name('registration-therapist');
Route::post('registration-therapist', [App\Http\Controllers\Admin\TherapistController::class, 'store']);

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
        Route::get('my-profile', [App\Http\Controllers\Admin\HomeController::class, 'showMyProfilePage'])->name('my-profile');
        Route::post('saveprofile', [App\Http\Controllers\Admin\HomeController::class, 'updateMyProfile'])->name('saveprofile');
        Route::get('change-password', [App\Http\Controllers\Admin\HomeController::class, 'showUpdatePassword'])->name('change-password');
        Route::post('update-password', [App\Http\Controllers\Admin\HomeController::class, 'udpatePassword'])->name('update-password');
        //Merchant category
        Route::resource('country', App\Http\Controllers\Admin\CountryController::class);
        Route::resource('states', App\Http\Controllers\Admin\StatesController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServicesController::class);
        Route::resource('therapist', App\Http\Controllers\Admin\TherapistController::class);
        Route::post('therapist/update-data', [App\Http\Controllers\Admin\TherapistController::class, 'updateData'])->name('therapist.update-data');
    });
});

