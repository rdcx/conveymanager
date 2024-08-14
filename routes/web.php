<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConveyancingCaseController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('properties')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::get('/{property}', [PropertyController::class, 'show'])->name('properties.show');
        Route::post('/', [PropertyController::class, 'store'])->name('properties.store');
    });

    Route::prefix('properties/{property}/cases')->group(function () {
        Route::post('/', [ConveyancingCaseController::class, 'store'])->name('conveyancing-cases.store');
        Route::get('/', [ConveyancingCaseController::class, 'index'])->name('conveyancing-cases.index');
        Route::get('/create', [ConveyancingCaseController::class, 'create'])->name('conveyancing-cases.create');
    });

    Route::get('cases/{conveyancingCase}/edit', [ConveyancingCaseController::class, 'edit'])->name('conveyancing-cases.edit');
    Route::put('cases/{conveyancingCase}', [ConveyancingCaseController::class, 'update'])->name('conveyancing-cases.update');

    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
        Route::post('/', [ClientController::class, 'store'])->name('clients.store');
    });

    Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');
});