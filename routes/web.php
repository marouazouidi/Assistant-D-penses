<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecuController;
use App\Http\Controllers\DepenseController;

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
});



Route::middleware(['auth'])->group(function () {

    // Liste des reçus
    Route::get('/recus', [RecuController::class, 'index'])
        ->name('recus.index');

    // Formulaire création reçu
    Route::get('/recus/create', [RecuController::class, 'create'])
        ->name('recus.create');

    // Enregistrer reçu
    Route::post('/recus', [RecuController::class, 'store'])
        ->name('recus.store');

    // Détail reçu
    Route::get('/recus/{recu}', [RecuController::class, 'show'])
        ->name('recus.show');

    // Formulaire modification reçu
    Route::get('/recus/{recu}/edit', [RecuController::class, 'edit'])
        ->name('recus.edit');

    // Mise à jour reçu
    Route::put('/recus/{recu}', [RecuController::class, 'update'])
        ->name('recus.update');

    // Suppression reçu
    Route::delete('/recus/{recu}', [RecuController::class, 'destroy'])
        ->name('recus.destroy');

    // Liste des dépenses
    Route::get('/depenses', [DepenseController::class, 'index'])
        ->name('depenses.index');

    // Détail dépense 
    Route::get('/depenses/{depense}', [DepenseController::class, 'show'])
        ->name('depenses.show');

});

require __DIR__.'/auth.php';
