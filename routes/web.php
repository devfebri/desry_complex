<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware('auth', 'role:admin')->name('admin_')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboardstore');
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::resource('permintaan', PermintaanController::class);
Route::resource('user', UserController::class);
});
Route::prefix('user')->middleware('auth', 'role:user')->name('user_')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
Route::prefix('manager')->middleware('auth', 'role:manager')->name('manager_')->group(function () {

   Route::get('/draft', [DraftController::class, 'index'])->name('draft');

});

