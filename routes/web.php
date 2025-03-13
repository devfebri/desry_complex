<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermintaanKeseluruhanController;

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
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboardstore');
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::resource('permintaan', PermintaanController::class);
    Route::resource('user', UserController::class);
    // Route::get('/permintaankeseluruhan', [PermintaanKeseluruhanController::class, 'index'])->name('permintaankeseluruhan');
    Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');

    Route::post('/permintaankeseluruhan/submit', [PermintaanKeseluruhanController::class, 'submit'])->name('permintaankeseluruhan_submit');
    Route::get('/draft_disetujui/{id}', [DraftController::class, 'draft_disetujui'])->name('draft_disetujui');
});

Route::prefix('user')->middleware('auth', 'role:user')->name('user_')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboardstore');
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::get('/prosesit/{id}', [DraftController::class, 'prosesit'])->name('prosesit');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');


    // Route::get('/permintaankeseluruhan', [PermintaanKeseluruhanController::class, 'index'])->name('permintaankeseluruhan');
    Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
});

Route::prefix('manager')->middleware('auth', 'role:manager')->name('manager_')->group(function () {
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::get('/permohonan/{id}/disetujui', [DraftController::class, 'disetujui'])->name('permohonan_disetujui');
    Route::get('/permohonan/{id}/tidakdisetujui', [DraftController::class, 'tidakdisetujui'])->name('permohonan_tidak_disetujui');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');
    Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
    Route::post('/permintaankeseluruhan/submit', [PermintaanKeseluruhanController::class, 'submit'])->name('permintaankeseluruhan_submit');
});

Route::prefix('managersenior')->middleware('auth', 'role:managersenior')->name('managersenior_')->group(function () {
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::get('/permohonan/{id}/disetujui', [DraftController::class, 'disetujui'])->name('permohonan_disetujui');
    Route::get('/permohonan/{id}/tidakdisetujui', [DraftController::class, 'tidakdisetujui'])->name('permohonan_tidak_disetujui');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');
         Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
    Route::post('/permintaankeseluruhan/submit', [PermintaanKeseluruhanController::class, 'submit'])->name('permintaankeseluruhan_submit');
});

Route::prefix('managerit')->middleware('auth', 'role:managerit')->name('managerit_')->group(function () {
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');

    // Route::get('/permintaankeseluruhan', [PermintaanKeseluruhanController::class, 'index'])->name('permintaankeseluruhan');
    Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
    Route::post('/permintaankeseluruhan/submit', [PermintaanKeseluruhanController::class, 'submit'])->name('permintaankeseluruhan_submit');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');
    
});
Route::prefix('managerseniorit')->middleware('auth', 'role:managerseniorit')->name('managerseniorit_')->group(function () {
    Route::get('/draft', [DraftController::class, 'index'])->name('draft');
    Route::get('/dashboard/preview-pdf/{id}', [DashboardController::class, 'previewPdf'])->name('preview_pdf');

    // Route::get('/permintaankeseluruhan', [PermintaanKeseluruhanController::class, 'index'])->name('permintaankeseluruhan');
    Route::get('/permintaankeseluruhan/{id}/detail', [PermintaanKeseluruhanController::class, 'detail'])->name('permintaankeseluruhan_detail');
    Route::post('/permintaankeseluruhan/submit', [PermintaanKeseluruhanController::class, 'submit'])->name('permintaankeseluruhan_submit');
});

