<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BoekjaarController;
use App\Http\Controllers\ContributieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilieController;
use App\Http\Controllers\FamilielidController;
use App\Http\Controllers\GlobalSettingsController;
use App\Http\Controllers\ProfileController;
use App\Models\Boekjaar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //boekjaren contributies
    Route::get('/boekjaren', [BoekjaarController::class, 'index'])->name('boekjaren.index');
    Route::post('/boekjaren', [BoekjaarController::class, 'store'])->name('boekjaren.store')->middleware('role:penningmeester');
    Route::get('/contributions/{boekjaar}/view', [ContributieController::class, 'viewBoekjaar'])->name('contributions.view');
    Route::get('/contributions/{boekjaar}/edit', [ContributieController::class, 'editBoekjaar'])->name('contributions.edit')->middleware('role:penningmeester');
    Route::put('/contribution/{contributie}/update', [ContributieController::class, 'update'])->name('contributions.update')->middleware('role:penningmeester');

    // Families

    Route::get('/families', [FamilieController::class, 'index'])->name('families.index');
    Route::get('/families/create', [FamilieController::class, 'create'])->name('families.create')->middleware('role:secretaris');
    Route::post('/families', [FamilieController::class, 'store'])->name('families.store')->middleware('role:secretaris');
    Route::get('/families/{familie}', [FamilieController::class, 'show'])->name('families.show');
    Route::get('/families/{familie}/edit', [FamilieController::class, 'edit'])->name('families.edit')->middleware('role:secretaris');
    Route::put('/families/{familie}', [FamilieController::class, 'update'])->name('families.update')->middleware('role:secretaris');
    Route::delete('/families/{familie}', [FamilieController::class, 'destroy'])->name('families.destroy')->middleware('role:secretaris');

    // Familieleden

    Route::get('/families/{familie}/familieleden/create', [FamilielidController::class, 'create'])
        ->name('familieleden.create')->middleware('role:secretaris');
    Route::post('/families/{familie}/familieleden', [FamilielidController::class, 'store'])
        ->name('familieleden.store')->middleware('role:secretaris');
    Route::get('/familielid/{familielid}/edit', [FamilielidController::class, 'edit'])
        ->name('familielid.edit')->middleware('role:secretaris');
    Route::put('/familielid/{familielid}', [FamilielidController::class, 'update'])
        ->name('familielid.update')->middleware('role:secretaris');
    Route::delete('/familielid/{familielid}', [FamilielidController::class, 'destroy'])
        ->name('familielid.destroy')->middleware('role:secretaris');

});

Route::middleware(['auth', 'role:penningmeester'])->group(function () {
    Route::get('/settings', [GlobalSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [GlobalSettingsController::class, 'update'])->name('settings.update');

});

require __DIR__.'/auth.php';
