<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\Auth\PasswordSecurityController;
use App\Http\Controllers\Contacts\ContactController;
use App\Http\Controllers\LokalenController;

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
Route::get('/home', 'HomeController@index')->name('home');

// Activity routes
Route::get('{user}/logs', [ActivityController::class, 'show'])->name('users.activity');

// Notification routes
Route::get('/notificaties/markAll', [NotificationController::class, 'markAll'])->name('notifications.markAll');
Route::get('/notificaties/markOne/{notification}', [NotificationController::class, 'markOne'])->name('notifications.markAsRead');
Route::get('/notificaties/{type?}', [NotificationController::class, 'index'])->name('notifications.index');

// Lokalen Routes 
Route::get('/lokalen', [LokalenController::class, 'index'])->name('lokalen.index');
Route::get('/lokalen/nieuw', [LokalenController::class, 'create'])->name('lokalen.create');
Route::post('/lokalen/nieuw', [LokalenController::class, 'store'])->name('lokalen.store');

// Contacts routes
Route::get('/contacten/nieuw', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacten/nieuw', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacten/{filter?}', [ContactController::class, 'index'])->name('contacts.index');
Route::delete('/contacten/{contact}', [ContactController::class, 'destroy'])->name('contacts.delete');

// User Settings routes
Route::get('/account', [AccountController::class, 'index'])->name('account.settings');
Route::get('/account/beveiliging', [AccountController::class, 'indexSecurity'])->name('account.security');
Route::patch('/account/informatie', [AccountController::class, 'updateInformation'])->name('account.settings.info');
Route::patch('/account/beveiliging', [AccountController::class, 'updateSecurity'])->name('account.settings.security');

// 2FA routes
Route::post('/gebruiker/genereer-2fa-token', [PasswordSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
Route::post('/gebruiker/2fa', [PasswordSecurityController::class, 'enable2fa'])->name('enable2fa');
Route::post('/gebruiker/deactiveer-2fa', [PasswordSecurityController::class, 'disable2fa'])->name('disable2fa');

Route::post('/2faVerify', function () {
    return redirect()->route('home');
})->name('2faVerify')->middleware('2fa');
