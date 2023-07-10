<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakCiptaController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return redirect()->route('home');
});
Route::middleware(['auth:admin,web'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::post('/permohonan-terima/{id}', [App\Http\Controllers\PermohonanController::class, 'permohonan_terima'])->name('permohonan_terima');
        Route::post('/permohonan-tolak/{id}', [App\Http\Controllers\PermohonanController::class, 'permohonan_tolak'])->name('permohonan_tolak');

        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
        Route::post('/admin-update', [App\Http\Controllers\AdminController::class, 'admin_update'])->name('admin-update');
        Route::get('/admin-hapus/{id}', [App\Http\Controllers\AdminController::class, 'admin_delete'])->name('admin-delete');
        Route::post('/admin-tambah', [App\Http\Controllers\AdminController::class, 'admin_tambah'])->name('admin-tambah');

        Route::get('/users', [App\Http\Controllers\PemohonController::class, 'users'])->name('users');
        Route::post('/users-update', [App\Http\Controllers\PemohonController::class, 'users_update'])->name('users-update');
        Route::get('/users-hapus/{id}', [App\Http\Controllers\PemohonController::class, 'users_delete'])->name('users-delete');
        Route::post('/users-tambah', [App\Http\Controllers\PemohonController::class, 'users_tambah'])->name('users-tambah');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/hakcipta-edit/{id}', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_edit'])->name('hakcipta-edit');
    Route::post('/hakcipta-update', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_update'])->name('hakcipta-update');
    Route::get('/hakcipta-terima-admin', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_terima_Admin'])->name('hakcipta-terima-admin');
    Route::get('/hakcipta-tolak-admin', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_tolak_admin'])->name('hakcipta-tolak-admin');
    Route::get('/hakcipta-tolak-pusat', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_tolak_pusat'])->name('hakcipta-tolak-pusat');
    Route::get('/hakcipta', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta'])->name('hakcipta');
    Route::get('/hakcipta-hapus/{id}', [App\Http\Controllers\HakCiptaController::class, 'hak_cipta_hapus'])->name('hakcipta-hapus');

    // Route unutuk eksport PDF
    Route::get('export-pdf', [HakCiptaController::class, 'exportPDF'])->name('export-pdf');

    Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'profil'])->name('profil');
    Route::post('/profil-update', [App\Http\Controllers\ProfilController::class, 'profil_update'])->name('profil-update');


    Route::get('/permohonan', [App\Http\Controllers\PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::get('/permohonan-hapus/{id}', [App\Http\Controllers\PermohonanController::class, 'permohonan_hapus'])->name('permohonan_hapus');
    Route::get('/permohonan-form', [App\Http\Controllers\PermohonanController::class, 'permohonan_form'])->name('permohonan-form');
    Route::post('/permohonan-add', [App\Http\Controllers\PermohonanController::class, 'permohonan_add'])->name('permohonan-add');
});

Auth::routes(['register' => false]);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'view'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
