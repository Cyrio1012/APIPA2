<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuditsChantierController;
use App\Http\Controllers\DemandePcController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/stats/service-envoyeur', [DemandePcController::class, 'serviceEnvoyeurStats'])->name('service-envoyeur');
Route::get('/stats/service-categorie', [DemandePcController::class, 'serviceCategorie'])->name('service-categorie');

Route::get('/demande/create', [DemandePcController::class, 'create'])->name('demande.create');
Route::post('/demande', [DemandePcController::class, 'store'])->name('demande.store');
Route::get('/demande-pc', [DemandePcController::class, 'index'])->name('demande_pc.index');
Route::get('/demande-pc/{d}', [DemandePcController::class, 'show'])->name('demande_pc.show');

