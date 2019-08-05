<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Tenants\TenantController;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\Auth\PasswordSecurityController;
use App\Http\Controllers\Contacts\ContactController;
use App\Http\Controllers\LokalenController;
use App\Http\Controllers\Lokalen\NotesController;

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

// Huurder routes
Route::get('/huurders', [TenantController::class, 'index'])->name('tenants.overview');
Route::get('/huurders/nieuw', [TenantController::class, 'create'])->name('tenants.create');
Route::post('/huurders/nieuw', [TenantController::class, 'store'])->name('tenants.store');
Route::get('/huurders/{huurder}', [TenantController::class, 'show'])->name('tenants.show');

// Notification routes
Route::get('/notificaties/markAll', [NotificationController::class, 'markAll'])->name('notifications.markAll');
Route::get('/notificaties/markOne/{notification}', [NotificationController::class, 'markOne'])->name('notifications.markAsRead');
Route::get('/notificaties/{type?}', [NotificationController::class, 'index'])->name('notifications.index');

// Lokalen Routes
Route::get('/lokalen', [LokalenController::class, 'index'])->name('lokalen.index');
Route::get('/lokalen/nieuw', [LokalenController::class, 'create'])->name('lokalen.create');
Route::post('/lokalen/nieuw', [LokalenController::class, 'store'])->name('lokalen.store');
Route::get('/lokalen/{lokaal}', [LokalenController::class, 'show'])->name('lokalen.show');
Route::patch('/lokalen/{lokaal}', [LokalenController::class, 'update'])->name('lokalen.update');
Route::match(['get', 'delete'], '/lokalen/verwijder/{lokaal}', [LokalenController::class, 'destroy'])->name('lokalen.delete');

// Lokalen opmerkingen routes
Route::get('/lokalen/opmerking/{note}', [NotesController::class, 'show'])->name('lokalen.opmerkingen.show');
Route::get('/lokalen/opmerking/wijzig/{opmerking}', [NotesController::class, 'edit'])->name('lokalen.opmerkingen.wijzig');
Route::patch('/lokalen/opmerking/wijzig/{opmerking}', [NotesController::class, 'update'])->name('lokalen.opmerkingen.update');
Route::get('/lokalen/{lokaal}/opmerkingen', [NotesController::class, 'index'])->name('lokalen.opmerkingen');
Route::get('/lokalen/{lokaal}/opmerking/nieuw', [NotesController::class, 'create'])->name('lokalen.opmerkingen.nieuw');
Route::post('/lokalen/{lokaal}/opmerking/opslaan', [NotesController::class, 'store'])->name('lokalen.opmerkingen.store');
Route::delete('/opmerking/verwijder/{note}', [NotesController::class, 'destroy'])->name('lokaal.opmerking.destroy');

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
