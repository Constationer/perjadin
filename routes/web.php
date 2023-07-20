<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SpjController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// OPD
Route::get('/opd', [OpdController::class, 'index'])->name('Opd.index');
Route::get('/opd/create', [OpdController::class, 'create'])->name('Opd.create');
Route::get('/opd/getopd', [OpdController::class, 'getOpd'])->name('Opd.getOpd');
Route::post('/opd/store', [OpdController::class, 'store'])->name('Opd.store');
Route::delete('opd/{id}', [OpdController::class, 'destroy'])->name('Opd.delete');
// PEGAWAI
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('Pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('Pegawai.create');
Route::get('/pegawai/getpegawai', [PegawaiController::class, 'getPegawai'])->name('Pegawai.getPegawai');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('Pegawai.store');
Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('Pegawai.delete');
// SPJ
Route::get('/spj', [SpjController::class, 'index'])->name('Spj.index');
Route::get('/spj/create', [SpjController::class, 'create'])->name('Spj.create');
Route::get('/spj/getspj', [SpjController::class, 'getSpj'])->name('Spj.getSpj');
Route::post('/spj/store', [SpjController::class, 'store'])->name('Spj.store');
Route::delete('spj/{id}', [SpjController::class, 'destroy'])->name('Spj.delete');
