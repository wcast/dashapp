<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/politica-de-privacidade', [\App\Http\Controllers\HomeController::class, 'politica'])->name('politica');
Route::get('/termos-de-uso', [\App\Http\Controllers\HomeController::class, 'termos'])->name('termos');
Route::get("/obrigado", function () {
    return view(
        "obrigado",
        ["page" => "obrigado", "title" => "Obrigado pelo contato"]
    );
})->name("obrigado");

require __DIR__.'/auth.php';
