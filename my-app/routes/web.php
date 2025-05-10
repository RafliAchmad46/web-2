<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PegawaiController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);
Route::get('/ruang', [RuangController::class, 'index']);
Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::get('/pegawai', [PegawaiController::class, 'index']);
