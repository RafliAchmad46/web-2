<?php
use App\Livewire\Counter;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// ruang
use App\Livewire\Ruang\ListRuang;
use App\Livewire\Ruang\CreateRuang;
use App\Livewire\Ruang\EditRuang;

// pegawai
use App\Livewire\Pegawai\ListPegawai;
use App\Livewire\Pegawai\CreatePegawai;
use App\Livewire\Pegawai\EditPegawai;

// unit kerja
use App\Livewire\UnitKerja\ListUnitKerja;
use App\Livewire\UnitKerja\CreateUnitKerja;
use App\Livewire\UnitKerja\EditUnitKerja;

// peminjaman
use App\Livewire\Peminjaman\ListPeminjaman;
use App\Livewire\Peminjaman\CreatePeminjaman;
use App\Livewire\Peminjaman\EditPeminjaman;





Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/counter', Counter::class);

// ruang
Route::get('/ruang', ListRuang::class)->name('ruang.index');
Route::get('/ruang/create', CreateRuang::class)->name('ruang.create');
Route::get('/ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit');

// pegawai
Route::get('/pegawai', ListPegawai::class)->name('pegawai.index');
Route::get('/pegawai/create', CreatePegawai::class)->name('pegawai.create');
Route::get('/pegawai/edit/{pegawai}', EditPegawai::class)->name('pegawai.edit');

// unit kerja
Route::get('/unit-kerja', ListUnitKerja::class)->name('unit-kerja.index');
Route::get('/unit-kerja/create', CreateUnitKerja::class)->name('unit-kerja.create');
Route::get('/unit-kerja/edit/{unitKerja}', EditUnitKerja::class)->name('unit-kerja.edit');

// peminjaman
Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
    Route::get('/', ListPeminjaman::class)->name('index');
    Route::get('/create', CreatePeminjaman::class)->name('create');
    Route::get('/edit/{peminjaman}', EditPeminjaman::class)->name('edit');
});

require __DIR__.'/auth.php';
