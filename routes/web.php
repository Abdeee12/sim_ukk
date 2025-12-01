<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminSiswaController; // Admin CRUD
use App\Http\Controllers\Admin\MentorController; 
use App\Http\Controllers\Siswa\SiswaController; // Siswa App Logic (Di folder Siswa/)
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Mentor\LaporanController as MentorLaporanController;

Route::get('/', function () {
    return view('welcome');
});

// LOGIKA PENGATUR ARAH (REDIRECT)
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } 
    if ($user->role === 'mentor') {
        return redirect()->route('mentor.dashboard');
    } 
    if ($user->role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }

})->middleware(['auth', 'verified'])->name('dashboard');


// JALUR PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- JALUR KHUSUS ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        $siswa = (object) ['user' => (object)[]]; // Fallback untuk mencegah error
        return view('admin.dashboard', compact('siswa')); 
    })->name('dashboard');

    // CRUD SISWA (Menggunakan AdminSiswaController)
    Route::resource('siswa', AdminSiswaController::class);

    // Admin: Form dan aksi untuk menetapkan Mentor ke Siswa
    Route::get('siswa/assign', [AdminSiswaController::class, 'assignMentorForm'])->name('siswa.assign');
    Route::post('siswa/{siswa}/assign-mentor', [AdminSiswaController::class, 'assignMentor'])->name('siswa.assignMentor');
    Route::post('siswa/bulk-assign-mentor', [AdminSiswaController::class, 'bulkAssignMissing'])->name('siswa.bulkAssignMentor');

    // CRUD MENTOR
    Route::resource('mentor', MentorController::class);

    // Admin: Laporan Harian - daftar laporan untuk direview
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::patch('/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    // Allow GET on the status URL to redirect to the detail page to avoid MethodNotAllowed when user visits the URL directly
    Route::get('/laporan/{laporan}/status', function ($laporan) {
        return redirect()->route('admin.laporan.show', $laporan);
    });
    Route::patch('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');

});


// JALUR KHUSUS MENTOR
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Mentor\LaporanController::class, 'dashboard'])->name('dashboard');

    // Mentor: pending laporan (verification) for their assigned students
    // Place explicit pending route BEFORE the resource routes to avoid collision with /laporan/{laporan}
    Route::get('/laporan/pending', [MentorLaporanController::class, 'pending'])->name('laporan.pending');
    // Mentor: rejected and completed lists
    Route::get('/laporan/rejected', [MentorLaporanController::class, 'rejected'])->name('laporan.rejected');
    Route::get('/laporan/completed', [MentorLaporanController::class, 'completed'])->name('laporan.completed');
    // Keep separate status endpoint (PATCH) and a GET redirect to avoid MethodNotAllowed when visited directly
    Route::get('/laporan/{laporan}/status', function ($laporan) {
        return redirect()->route('mentor.laporan.show', $laporan);
    });
    Route::patch('/laporan/{laporan}/status', [MentorLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    // Mentor: Laporan - full CRUD like admin
    Route::resource('laporan', MentorLaporanController::class);

    // Mentor: Students list and assessment
    Route::get('/students', [\App\Http\Controllers\Mentor\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{siswa}/assessment', [\App\Http\Controllers\Mentor\StudentController::class, 'assessmentForm'])->name('students.assessment');
    Route::post('/students/{siswa}/assessment', [\App\Http\Controllers\Mentor\StudentController::class, 'storeAssessment'])->name('students.assessment.store');

    // Mentor: signature upload
    Route::get('/profile/signature', [\App\Http\Controllers\Mentor\ProfileController::class, 'signatureForm'])->name('profile.signature');
    Route::post('/profile/signature', [\App\Http\Controllers\Mentor\ProfileController::class, 'updateSignature'])->name('profile.signature.update');
});


// --- JALUR KHUSUS SISWA (MENGGUNAKAN CONTROLLER DI FOLDER SISWA) ---
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    
    // Dashboard Siswa
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('dashboard');

    // Form Tambah Laporan (PASTI BISA DIAKSES SETELAH INI)
    Route::get('/laporan/create', [SiswaController::class, 'createLaporan'])->name('createLaporan');

    // Simpan Laporan
    Route::post('/laporan/store', [SiswaController::class, 'storeLaporan'])->name('laporan.store');

    // Edit Laporan (Siswa dapat mengubah laporannya sendiri)
    Route::get('/laporan/{laporan}/edit', [SiswaController::class, 'editLaporan'])->name('laporan.edit');
    Route::patch('/laporan/{laporan}', [SiswaController::class, 'updateLaporan'])->name('laporan.update');

});

require __DIR__.'/auth.php';