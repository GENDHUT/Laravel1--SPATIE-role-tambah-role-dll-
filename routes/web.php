<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified','role:admin'])->name('dashboard');
// untuk cek role tambahkan middleware role:admin

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// meja
// Route::get('/dashboard', action: [MejaController::class, 'index'])->name('dashboard');
Route::post('/meja/{id}/reserve', [MejaController::class, 'reserveTable'])->name('meja.reserveTable');
// Route::put('/meja/{id}/updateStatus', action: [MejaController::class, 'updateStatus'])->name('meja.updateStatus');
Route::post('/meja/finish/{id}', [MejaController::class, 'finishTable'])->name('meja.finishTable');
Route::post('/meja/addMultiple', [MejaController::class,'addMultiple'])->name('meja.addMultiple');
Route::post('/meja/addManual', [MejaController::class,'addManual'])->name('meja.addManual');
Route::delete('/meja/hapus/{id}', [MejaController::class,'hapus'])->name('meja.hapus');
Route::get('/meja/{meja}/edit', [MejaController::class,'edit'])->name('meja.edit');
Route::put('/meja/{meja}', [MejaController::class, 'update'])->name('meja.update');

// role edit
// Route::get('/dashboard', [UserController::class, 'showUsers'])->name('users.list');
Route::get('/users/{id}/edit-role', [UserController::class, 'editRole'])->name('users.editRole');
// Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.editRole');
Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');







require __DIR__.'/auth.php';
