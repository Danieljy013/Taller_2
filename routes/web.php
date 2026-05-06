<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use Illuminate\Http\Request;
use App\Http\Controllers\JuegoController;

Route::get('/', function () {
    return view('index');
})->name('inicio');

// ✅ ESTA ES LA MÁS IMPORTANTE (detalle por ID)
Route::get('/juego/{id}', [JuegoController::class, 'show'])->name('juego.show');

// ✅ Catálogo (si quieres vista general)
Route::get('/juegos', function () {
    return view('juegos');
})->name('juegos');

// OBLIGATORIO: deja solo UNA de /juegos (NO las dos)

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/ofertas', function () {
    return view('ofertas');
})->name('ofertas');

Route::get('/dashboard', function () {
    return redirect()->route('inicio');
})->middleware(['auth'])->name('dashboard');

Route::get('/password.request', function () {
    return view('auth.forgot-password');
})->name('forgotpassword');

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
Route::post('/ofertas', [ContactoController::class, 'storeOferta'])->name('ofertas.store');
Route::get('/admin/postulaciones', [ContactoController::class, 'verPostulaciones'])->name('admin.postulaciones');
Route::get('/admin', [ContactoController::class, 'index'])->name('admin');
require __DIR__.'/auth.php';