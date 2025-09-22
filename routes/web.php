<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuditsChantierController;
use App\Http\Controllers\DemandePcController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\conv;
use App\Http\Controllers\RemblaisController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/stats/service-envoyeur', [DemandePcController::class, 'serviceEnvoyeurStats'])->name('service-envoyeur');
Route::get('/stats/service-categorie', [DemandePcController::class, 'serviceCategorie'])->name('service-categorie');

Route::get('/demande/create', [DemandePcController::class, 'create'])->name('demande.create');
Route::post('/demande', [DemandePcController::class, 'store'])->name('demande.store');
Route::get('/demande-pc', [DemandePcController::class, 'index'])->name('demande_pc.index');
Route::get('/demande-pc/{d}', [DemandePcController::class, 'show'])->name('demande_pc.show');

Route::get('/rembconv', [conv::class, 'updateMiss']);

Route::get('/map', [ActionController::class, 'map'])->name('actions.map');

// Route::get('/actions/geom', function () {
//     $actions = \App\Models\Action::whereNotNull('geom')->get();
    
//     $features = $actions->map(function ($action) {
//         $geom = is_string($action->geom) ? json_decode($action->geom, true) : $action->geom;

//         return [
//             'type' => 'Feature',
//             'geometry' => $geom,
//             'properties' => [
//                 'numero_pv' => $action->numero_pv,
//                 'proprietaire' => $action->proprietaire,
//                 'commune' => $action->commune,
//                 'surface' => $action->superficie_m2,
//                 'amende' => $action->montant_amende
//                 ]
//             ];
//     });
    
//     return response()->json([
//         'type' => 'FeatureCollection',
//         'features' => $features->filter()->values()
//     ]);
// });


Route::get('/actions/geojson', [ActionController::class, 'geojson'])->name('actions.geojson');

Route::resource('actions', ActionController::class);
Route::get('/side', function () {
    return view('layouts.side');
});

Route::get('/remblais/geojson', [RemblaisController::class, 'geojson'])->name('remblais.geojson');
Route::get('/remblais/map', [RemblaisController::class, 'map'])->name('remblais.map');
