<?php 

use App\Http\Controllers\Users\IndexController;
use App\Http\Controllers\Users\LockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;

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

Route::get('/kiosk', [HomeController::class, 'kiosk'])->name('kiosk.dashboard');

// User routes
Route::match(['get', 'delete'], '/verwijder/gebruiker/{user}', [IndexController::class, 'destroy'])->name('users.destroy');
Route::get('/gebruikers/zoek', [IndexController::class, 'search'])->name('users.search');
Route::get('/gebruiker/{user}', [IndexController::class, 'show'])->name('users.show');
Route::patch('/gebruikers/{user}', [IndexController::class, 'update'])->name('users.update');
Route::get('/gebruikers/nieuw', [IndexController::class, 'create'])->name('users.create');
Route::post('/gebruikers/nieuw', [IndexController::class, 'store'])->name('users.store');
Route::get('/gebruikers/{filter?}', [IndexController::class, 'index'])->name('users.index');

// User state routes
Route::get('/account/gedeactiveerd', [LockController::class, 'index'])->name('user.blocked');
Route::get('/{userEntity}/deactiveer', [LockController::class, 'create'])->name('users.lock');
Route::get('/{userEntity}/activeer', [LockController::class, 'destroy'])->name('users.unlock');
Route::post('/{userEntity}/deactiveer', [LockController::class, 'store'])->name('users.lock.store');

// Audit routes 
Route::get('/audit', [ActivityController::class, 'index'])->name('audit.overview');
Route::get('/adit/zoeen', [ActivityController::class, 'search'])->name('audit.search');
Route::get('/audit/export/{filter?}', [ActivityController::class, 'export'])->name('audit.export');