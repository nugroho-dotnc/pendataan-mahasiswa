<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(JurusanController::class)->prefix('/jurusan')->group(
        function(){
            Route::get('/', 'index')->name('jurusan.index');

            Route::get('/create', 'create')->name('jurusan.create');
            Route::post('/', 'store')->name('jurusan.store');

            Route::get('/{id}', 'edit')->name('jurusan.edit');
            Route::put('/{id}', 'update')->name('jurusan.update');

            Route::delete('/{id}', 'destroy')->name('jurusan.delete');
        }
    );

    Route::controller(ProdiController::class)->prefix('/prodi')->group(
        function(){
            Route::get('/', 'index')->name('prodi.index');

            Route::get('/create', 'create')->name('prodi.create');
            Route::post('/', 'store')->name('prodi.store');

            Route::get('/{id}', 'edit')->name('prodi.edit');
            Route::put('/{id}', 'update')->name('prodi.update');

            Route::delete('/{id}', 'destroy')->name('prodi.delete');
        }
    );

    Route::controller(MahasiswaController::class)->prefix('/mahasiswa')->group(
        function(){
            Route::get('/', 'index')->name('mahasiswa.index');

            Route::get('/create', 'create')->name('mahasiswa.create');
            Route::post('/', 'store')->name('mahasiswa.store');

            Route::get('/{id}', 'edit')->name('mahasiswa.edit');
            Route::put('/{id}', 'update')->name('mahasiswa.update');

            Route::delete('/{id}', 'destroy')->name('mahasiswa.delete');
        }
    );
});

require __DIR__.'/auth.php';
