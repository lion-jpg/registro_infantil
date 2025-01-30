<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CredencialController;

Route::get('/', function () {
    return redirect('/admin');
    
});
Route::get('/generar-credencial/{id}', [CredencialController::class, 'generarCredencial'])->name('generar-credencial');
