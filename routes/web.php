<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CredencialController;

Route::get('/', function () {
    return view('welcome');
    
});
Route::get('/generar-credencial/{id}', [CredencialController::class, 'generarCredencial'])->name('generar-credencial');
